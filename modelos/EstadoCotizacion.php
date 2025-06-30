<?php
require_once __DIR__ . '/../config/Conexion.php';

class EstadoCotizacion
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO estado_cotizacion 
                   (descripcion, created_at, updated_at, is_active)
                VALUES (?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [$descripcion]);
    }

    public function editar($id, $descripcion)
    {
        $id          = limpiarCadena($id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE estado_cotizacion
                   SET descripcion = ?,
                       updated_at  = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$descripcion, $id]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE estado_cotizacion
                   SET is_active  = 0,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE estado_cotizacion
                   SET is_active  = 1,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT id, descripcion, is_active
                  FROM estado_cotizacion
                 WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT
                    id,
                    descripcion,
                    DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') AS created_at,
                    DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                    is_active
                  FROM estado_cotizacion
                 ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }
}
