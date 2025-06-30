<?php
require_once __DIR__ . '/../config/Conexion.php';
class RolPermiso
{
    public function asignar(int $rol, int $perm): bool
    {
        return ejecutarConsulta(
            "INSERT IGNORE rol_permiso(rol_id,permiso_id) VALUES (?,?)",
            [$rol, $perm]
        );
    }
    public function quitar(int $rol, int $perm): bool
    {
        return ejecutarConsulta(
            "DELETE FROM rol_permiso WHERE rol_id=? AND permiso_id=?",
            [$rol, $perm]
        );
    }
    public function listar(int $rol): array
    {
        return ejecutarConsultaArray(
            "SELECT rp.permiso_id, CONCAT(m.nombre,' / ',p.accion) permiso
             FROM rol_permiso rp
             JOIN permiso p ON p.id=rp.permiso_id
             JOIN modulo  m ON m.id=p.modulo_id
            WHERE rp.rol_id=?",
            [$rol]
        );
    }
}
