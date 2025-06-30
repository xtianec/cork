<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlantillaHoras
{
    public function insertar($horas, $descripcion = null)
    {
        $horas       = limpiarCadena($horas);
        $descripcion = limpiarCadena($descripcion);

        $sql = "INSERT INTO plantilla_horas (horas, descripcion)
                VALUES (?, ?)";
        return ejecutarConsulta($sql, [$horas, $descripcion]);
    }

    public function editar($id, $horas, $descripcion = null)
    {
        $id          = limpiarCadena($id);
        $horas       = limpiarCadena($horas);
        $descripcion = limpiarCadena($descripcion);

        $sql = "UPDATE plantilla_horas SET
                    horas       = ?,
                    descripcion = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [$horas, $descripcion, $id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM plantilla_horas WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM plantilla_horas ORDER BY horas";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, horas FROM plantilla_horas";
        return ejecutarConsulta($sql);
    }
}
