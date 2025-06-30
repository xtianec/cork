<?php
require_once __DIR__ . '/../config/Conexion.php';

class GuiaRemModalidad
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO guia_rem_modalidad (descripcion) VALUES (?)";
        return ejecutarConsulta($sql, [$descripcion]);
    }

    public function editar($id, $descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE guia_rem_modalidad SET descripcion = ? WHERE modalidad_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $id]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE guia_rem_modalidad SET is_active = 0 WHERE modalidad_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $sql = "UPDATE guia_rem_modalidad SET is_active = 1 WHERE modalidad_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT modalidad_id AS id, descripcion, is_active FROM guia_rem_modalidad WHERE modalidad_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT modalidad_id AS id, descripcion, is_active FROM guia_rem_modalidad";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT modalidad_id AS id, descripcion FROM guia_rem_modalidad WHERE is_active = 1";
        return ejecutarConsulta($sql);
    }

}
