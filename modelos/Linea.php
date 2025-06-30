<?php
require_once __DIR__ . '/../config/Conexion.php';

class Linea
{
    public function insertar($nombre)
    {
        $nombre = limpiarCadena($nombre);
        $sql = "INSERT INTO linea (nombre, created_at, updated_at, is_active)
                VALUES (?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [$nombre]);
    }

    public function editar($id, $nombre)
    {
        $id     = limpiarCadena($id);
        $nombre = limpiarCadena($nombre);
        $sql = "UPDATE linea
                   SET nombre     = ?,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$nombre, $id]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE linea
                   SET is_active  = 0,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE linea
                   SET is_active  = 1,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT id, nombre, is_active
                  FROM linea
                 WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT
                    id,
                    nombre,
                    DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') AS created_at,
                    DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                    is_active
                  FROM linea
                 ORDER BY nombre";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, nombre
                  FROM linea
                 WHERE is_active = 1
              ORDER BY nombre";
        return ejecutarConsulta($sql);
    }
}
