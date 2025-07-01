<?php
require_once __DIR__ . '/../config/Conexion.php';

class Proyecto
{
    public function insertar($nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        $sql = "INSERT INTO proyecto
                    (nombre, descripcion, fecha_inicio, fecha_fin, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($descripcion),
            limpiarCadena($fecha_inicio),
            limpiarCadena($fecha_fin)
        ]);
    }

    public function editar($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        $sql = "UPDATE proyecto SET
                    nombre = ?,
                    descripcion = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?,
                    updated_at = NOW()
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($descripcion),
            limpiarCadena($fecha_inicio),
            limpiarCadena($fecha_fin),
            limpiarCadena($id)
        ]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE proyecto SET is_active=0, updated_at=NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE proyecto SET is_active=1, updated_at=NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT * FROM proyecto WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($id)]);
    }

    public function listar()
    {
        $sql = "SELECT id,
                       nombre,
                       DATE_FORMAT(created_at,'%Y-%m-%d %H:%i') AS created_at,
                       DATE_FORMAT(updated_at,'%Y-%m-%d %H:%i') AS updated_at,
                       is_active
                  FROM proyecto
                 ORDER BY nombre";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, nombre FROM proyecto WHERE is_active = 1 ORDER BY nombre";
        return ejecutarConsulta($sql);
    }
}
