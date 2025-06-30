<?php
require_once __DIR__ . '/../config/Conexion.php';

class UsuarioRol
{
    public function insertar(int $uid, int $rid): bool
    {
        return ejecutarConsulta(
            "INSERT IGNORE usuario_rol(usuario_id,rol_id) VALUES (?,?)",
            [$uid, $rid]
        );
    }
    public function eliminar(int $uid, int $rid): bool
    {
        return ejecutarConsulta(
            "DELETE FROM usuario_rol WHERE usuario_id=? AND rol_id=?",
            [$uid, $rid]
        );
    }
    /** Listar los roles asignados a un usuario **/
    public function listarPorUsuario(int $uid): array {
        return ejecutarConsultaArray(
          "SELECT ur.rol_id,r.nombre rol_nombre
             FROM usuario_rol ur
             JOIN rol r ON r.id=ur.rol_id
            WHERE ur.usuario_id=?",[$uid]);
    }

    /** Opcional: listado completo de asignaciones **/
    public function listar()
    {
        $sql = "SELECT usuario_id, rol_id FROM usuario_rol";
        return ejecutarConsulta($sql);
    }

    /** Para el select de usuario-roles disponibles **/
    public function select()
    {
        $sql = "SELECT id, nombre FROM rol";
        return ejecutarConsulta($sql);
    }
}
