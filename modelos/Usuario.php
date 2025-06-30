<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once 'Audit.php';

class Usuario
{
    /* ───────── helpers unicidad ───────── */
    private function usernameExists(string $u, int $ignore = 0): bool
    {
        return (bool) ejecutarConsultaSimpleFila(
            "SELECT id FROM usuario WHERE username=? AND id<>? AND deleted_at IS NULL",
            [$u, $ignore]
        );
    }
    private function emailExists(string $e, int $ignore = 0): bool
    {
        return (bool) ejecutarConsultaSimpleFila(
            "SELECT id FROM usuario WHERE email=? AND id<>? AND deleted_at IS NULL",
            [$e, $ignore]
        );
    }

    /* ───────── list / show ───────── */
    public function listar(): array
    {
        return ejecutarConsultaArray(
            "SELECT u.id,u.username,u.email,
                  COALESCE(u.estado,0) estado,
                  IFNULL(GROUP_CONCAT(r.nombre SEPARATOR ', '),'–') roles
             FROM usuario u
        LEFT JOIN usuario_rol ur ON ur.usuario_id=u.id
        LEFT JOIN rol r ON r.id=ur.rol_id AND r.deleted_at IS NULL
            WHERE u.deleted_at IS NULL
         GROUP BY u.id"
        );
    }

    public function mostrar(int $id): ?array
    {
        $user = ejecutarConsultaSimpleFila(
            "SELECT id,username,email,estado
             FROM usuario
            WHERE id=? AND deleted_at IS NULL",
            [$id]
        );
        if (!$user) return null;

        $user['roles'] = array_map(
            'intval',
            ejecutarConsultaArray(
                "SELECT rol_id FROM usuario_rol WHERE usuario_id=?",
                [$id]
            )
        );
        return $user;
    }

    /* ───────── CRUD con roles ───────── */
    public function insertar(array $d): bool
    {
        global $conexion;
        if ($this->usernameExists($d['username']) || $this->emailExists($d['email']))
            return false;

        $conexion->begin_transaction();
        try {
            ejecutarConsulta(
                "INSERT INTO usuario(username,email,password,estado,created_at)
               VALUES (?,?,?,?,NOW())",
                [
                    $d['username'],
                    $d['email'],
                    password_hash($d['password'], PASSWORD_BCRYPT),
                    $d['estado']
                ]
            );
            $uid = $conexion->insert_id;

            $stmt = $conexion->prepare(
                "INSERT INTO usuario_rol(usuario_id,rol_id) VALUES (?,?)"
            );
            foreach ($d['roles'] as $rid) {
                $stmt->bind_param('ii', $uid, $rid);
                $stmt->execute();
            }
            $conexion->commit();
            Audit::log('usuario', $uid, 'CREATE', ['username' => $d['username']]);
            return true;
        } catch (Exception $e) {
            $conexion->rollback();
            return false;
        }
    }

    public function editar(int $id, array $d): bool
    {
        global $conexion;
        if (
            $this->usernameExists($d['username'], $id) ||
            $this->emailExists($d['email'], $id)
        ) return false;

        $conexion->begin_transaction();
        try {
            $q = "UPDATE usuario SET username=?,email=?,estado=?,updated_at=NOW()";
            $params = [$d['username'], $d['email'], $d['estado']];
            if (!empty($d['password'])) {
                $q .= ", password=?";
                $params[] = password_hash($d['password'], PASSWORD_BCRYPT);
            }
            $q .= " WHERE id=?";
            $params[] = $id;
            ejecutarConsulta($q, $params);

            /* roles */
            ejecutarConsulta("DELETE FROM usuario_rol WHERE usuario_id=?", [$id]);
            $stmt = $conexion->prepare("INSERT INTO usuario_rol(usuario_id,rol_id) VALUES (?,?)");
            foreach ($d['roles'] as $rid) {
                $stmt->bind_param('ii', $id, $rid);
                $stmt->execute();
            }
            $conexion->commit();
            Audit::log('usuario', $id, 'UPDATE', $d);
            return true;
        } catch (Exception $e) {
            $conexion->rollback();
            return false;
        }
    }

    /* soft-delete */
    public function trash(int $id): bool
    {
        $ok = ejecutarConsulta("UPDATE usuario SET deleted_at=NOW() WHERE id=?", [$id]);
        if ($ok) Audit::log('usuario', $id, 'DELETE');
        return $ok;
    }
    public function restore(int $id): bool
    {
        $ok = ejecutarConsulta("UPDATE usuario SET deleted_at=NULL WHERE id=?", [$id]);
        if ($ok) Audit::log('usuario', $id, 'RESTORE');
        return $ok;
    }

    /* activar / desactivar */
    public function cambiarEstado(int $id, int $estado): bool
    {
        $ok = ejecutarConsulta("UPDATE usuario SET estado=?,updated_at=NOW() WHERE id=?", [$estado, $id]);
        if ($ok) Audit::log('usuario', $id, 'UPDATE', ['estado' => $estado]);
        return $ok;
    }
    private function saveAccesos(int $uid, array $acc): void
    {
        ejecutarConsulta("DELETE FROM usuario_modulo_rol WHERE usuario_id=?", [$uid]);
        $stmt = $GLOBALS['conexion']->prepare(
            "INSERT INTO usuario_modulo_rol(usuario_id,modulo_id,rol_id) VALUES (?,?,?)"
        );
        foreach ($acc as $a) {
            $stmt->bind_param('iii', $uid, $a['modulo_id'], $a['rol_id']);
            $stmt->execute();
        }
    }
}
