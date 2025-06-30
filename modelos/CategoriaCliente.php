<?php
require_once __DIR__ . '/../config/Conexion.php';

class CategoriaCliente
{
    public function insertar($nombre)
    {
        $sql = "INSERT INTO categoria_cliente 
                   (nombre, created_at, updated_at, is_active)
                VALUES (?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [limpiarCadena($nombre)]);
    }

    public function editar($id, $nombre)
    {
        $sql = "UPDATE categoria_cliente
                   SET nombre     = ?,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($id)
        ]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE categoria_cliente
                   SET is_active  = 0,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE categoria_cliente
                   SET is_active  = 1,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT id, nombre, is_active 
                  FROM categoria_cliente 
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
                  FROM categoria_cliente
                 ORDER BY id DESC";
        return ejecutarConsulta($sql);
    }

}
