<?php
require_once __DIR__ . '/../config/Conexion.php';

class FormaPago
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO forma_pago (descripcion) VALUES (?)";
        return ejecutarConsulta($sql, [$descripcion]);
    }

    public function editar($id, $descripcion)
    {
        $id          = limpiarCadena($id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE forma_pago SET descripcion = ? WHERE forma_pago_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $id]);
    }

    public function mostrar($id)
    {
        $id  = limpiarCadena($id);
        $sql = "SELECT * FROM forma_pago WHERE forma_pago_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM forma_pago ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT forma_pago_id AS id, descripcion FROM forma_pago ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    
    public function desactivar($id)
    {
        $sql = "UPDATE forma_pago SET is_active = 0 WHERE forma_pago_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $sql = "UPDATE forma_pago SET is_active = 1 WHERE forma_pago_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }
}
