<?php
require_once __DIR__ . '/../config/Conexion.php';

class GuiaRemMotivo
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO guia_rem_motivotraslado (descripcion) VALUES (?)";
        return ejecutarConsulta($sql, [$descripcion]);
    }

    public function editar($id, $descripcion)
    {
        $id          = limpiarCadena($id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE guia_rem_motivotraslado SET descripcion = ? WHERE motivo_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $id]);
    }

    public function mostrar($id)
    {
        $id  = limpiarCadena($id);
        $sql = "SELECT * FROM guia_rem_motivotraslado WHERE motivo_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM guia_rem_motivotraslado ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT motivo_id AS id, descripcion FROM guia_rem_motivotraslado ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE guia_rem_motivotraslado SET is_active = 0 WHERE motivo_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $sql = "UPDATE guia_rem_motivotraslado SET is_active = 1 WHERE motivo_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }
}
