<?php
require_once __DIR__ . '/../config/Conexion.php';

class EquipoModelo
{
    public function insertar($nombre)
    {
        $nombre = limpiarCadena($nombre);
        $sql = "INSERT INTO equipo_modelo 
                   (nombre, created_at, updated_at, is_active)
                VALUES (?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [$nombre]);
    }

    public function editar($id, $nombre)
    {
        $id     = limpiarCadena($id);
        $nombre = limpiarCadena($nombre);
        $sql = "UPDATE equipo_modelo
                   SET nombre     = ?,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$nombre, $id]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE equipo_modelo
                   SET is_active  = 0,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE equipo_modelo
                   SET is_active  = 1,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT id, nombre, is_active
                  FROM equipo_modelo
                 WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($id)]);
    }

    public function listar()
    {
        $sql = "SELECT 
                    id,
                    nombre,
                    DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') AS created_at,
                    DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                    is_active
                  FROM equipo_modelo
                 ORDER BY id DESC";
        return ejecutarConsulta($sql);
    }

    public function listarCombo()
    {
        $sql = "SELECT id, nombre FROM equipo_modelo WHERE is_active = 1 ORDER BY nombre";
        return ejecutarConsultaArray($sql);
    }
}
