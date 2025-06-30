<?php
require_once __DIR__ . '/../config/Conexion.php';

class EstadoDocumento
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO estado_documento (descripcion) VALUES (?)";
        return ejecutarConsulta($sql, [$descripcion]);
    }

    public function editar($id, $descripcion)
    {
        $id          = limpiarCadena($id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE estado_documento SET descripcion = ? WHERE estado_doc_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $id]);
    }

    public function mostrar($id)
    {
        $id  = limpiarCadena($id);
        $sql = "SELECT * FROM estado_documento WHERE estado_doc_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM estado_documento ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT estado_doc_id AS id, descripcion FROM estado_documento ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }

     public function desactivar($id)
    {
        $sql = "UPDATE estado_documento SET is_active = 0 WHERE estado_doc_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $sql = "UPDATE estado_documento SET is_active = 1 WHERE estado_doc_id = ?";
        return ejecutarConsulta($sql, [$id]);
    }
}
