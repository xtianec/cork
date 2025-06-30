<?php
require_once __DIR__ . '/../config/Conexion.php';

class CondicionPago
{
    public function insertar($descripcion, $dias_credito)
    {
        $descripcion  = limpiarCadena($descripcion);
        $dias_credito = limpiarCadena($dias_credito);
        $sql = "INSERT INTO condicion_pago (descripcion, dias_credito) VALUES (?, ?)";
        return ejecutarConsulta($sql, [$descripcion, $dias_credito]);
    }

    public function editar($id, $descripcion, $dias_credito)
    {
        $id           = limpiarCadena($id);
        $descripcion  = limpiarCadena($descripcion);
        $dias_credito = limpiarCadena($dias_credito);
        $sql = "UPDATE condicion_pago SET descripcion = ?, dias_credito = ? WHERE condicion_pago_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $dias_credito, $id]);
    }

    public function mostrar($id)
    {
        $id  = limpiarCadena($id);
        $sql = "SELECT * FROM condicion_pago WHERE condicion_pago_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM condicion_pago ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT condicion_pago_id AS id, descripcion FROM condicion_pago ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }
}
