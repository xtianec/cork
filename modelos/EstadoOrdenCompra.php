<?php
require_once __DIR__ . '/../config/Conexion.php';

class EstadoOrdenCompra
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO estado_orden_compra (descripcion) VALUES (?)";
        return ejecutarConsulta($sql, [$descripcion]);
    }

    public function editar($id, $descripcion)
    {
        $id          = limpiarCadena($id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE estado_orden_compra SET descripcion = ? WHERE id = ?";
        return ejecutarConsulta($sql, [$descripcion, $id]);
    }

    public function mostrar($id)
    {
        $id  = limpiarCadena($id);
        $sql = "SELECT * FROM estado_orden_compra WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM estado_orden_compra ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, descripcion FROM estado_orden_compra ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }
             public function desactivar($id)
    {
        $sql = "UPDATE estado_orden_compra SET is_active = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $sql = "UPDATE estado_orden_compra SET is_active = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }
}
