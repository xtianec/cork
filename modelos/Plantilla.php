<?php
require_once __DIR__ . '/../config/Conexion.php';

class Plantilla
{
    public function insertar($codigo, $marca_id, $modelo_id, $descripcion)
    {
        $codigo      = limpiarCadena($codigo);
        $marca_id    = limpiarCadena($marca_id);
        $modelo_id   = limpiarCadena($modelo_id);
        $descripcion = limpiarCadena($descripcion);

        $sql = "INSERT INTO plantilla
                (codigo, marca_id, modelo_id, descripcion)
                VALUES (?,?,?,?)";
        return ejecutarConsulta($sql, [
            $codigo, $marca_id, $modelo_id, $descripcion
        ]);
    }

    public function editar($id, $codigo, $marca_id, $modelo_id, $descripcion)
    {
        $id          = limpiarCadena($id);
        $codigo      = limpiarCadena($codigo);
        $marca_id    = limpiarCadena($marca_id);
        $modelo_id   = limpiarCadena($modelo_id);
        $descripcion = limpiarCadena($descripcion);

        $sql = "UPDATE plantilla SET
                    codigo      = ?,
                    marca_id    = ?,
                    modelo_id   = ?,
                    descripcion = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $codigo, $marca_id, $modelo_id, $descripcion, $id
        ]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE plantilla SET is_active = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE plantilla SET is_active = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM plantilla WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT pl.*, m.nombre AS marca, mo.nombre AS modelo
                  FROM plantilla pl
             LEFT JOIN marca m ON pl.marca_id = m.id
             LEFT JOIN equipo_modelo mo ON pl.modelo_id = mo.id
             ORDER BY pl.codigo";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, codigo FROM plantilla WHERE is_active = 1";
        return ejecutarConsulta($sql);
    }
}
