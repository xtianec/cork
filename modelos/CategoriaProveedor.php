<?php
require_once __DIR__ . '/../config/Conexion.php';

class CategoriaProveedor
{
    public function insertar($nombre)
    {
        $sql = "INSERT INTO categoria_proveedor
                   (nombre, created_at, updated_at, is_active)
                VALUES (?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [limpiarCadena($nombre)]);
    }

    public function editar($id, $nombre)
    {
        $sql = "UPDATE categoria_proveedor
                   SET nombre     = ?,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($id)
        ]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT id, nombre, is_active
                  FROM categoria_proveedor
                 WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($id)]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE categoria_proveedor
                   SET is_active  = 0,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE categoria_proveedor
                   SET is_active  = 1,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function listar()
    {
        $sql = "SELECT
                    id,
                    nombre,
                    DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') AS created_at,
                    DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                    is_active
                  FROM categoria_proveedor
                 ORDER BY id DESC";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, nombre FROM categoria_proveedor WHERE is_active = 1 ORDER BY nombre";
        return ejecutarConsulta($sql);
    }
}
