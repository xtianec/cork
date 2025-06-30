<?php
require_once __DIR__ . '/../config/Conexion.php';

class Moneda
{
    public function insertar($codigo, $descripcion)
    {
        $codigo      = limpiarCadena($codigo);
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO monedas (codigo, descripcion) VALUES (?, ?)";
        return ejecutarConsulta($sql, [$codigo, $descripcion]);
    }

    public function editar($id, $codigo, $descripcion)
    {
        $id          = limpiarCadena($id);
        $codigo      = limpiarCadena($codigo);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE monedas SET codigo = ?, descripcion = ? WHERE moneda_id = ?";
        return ejecutarConsulta($sql, [$codigo, $descripcion, $id]);
    }

    public function mostrar($id)
    {
        $id  = limpiarCadena($id);
        $sql = "SELECT * FROM monedas WHERE moneda_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM monedas ORDER BY codigo";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT moneda_id AS id, CONCAT(codigo,' - ',descripcion) AS nombre FROM monedas ORDER BY codigo";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE monedas SET is_active = 0 WHERE moneda_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $sql = "UPDATE monedas SET is_active = 1 WHERE moneda_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }
}
