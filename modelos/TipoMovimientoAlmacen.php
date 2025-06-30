<?php
// models/TipoMovimientoAlmacen.php
require_once __DIR__ . '/../config/Conexion.php';

class TipoMovimientoAlmacen
{
    public function insertar(string $nombre)
    {
        $sql = "INSERT INTO tipo_movimiento_almacen
                    (nombre, created_at, updated_at)
                 VALUES (?, NOW(), NOW())";
        return ejecutarConsulta($sql, [limpiarCadena($nombre)]);
    }

    public function editar(int $id, string $nombre)
    {
        $sql = "UPDATE tipo_movimiento_almacen
                   SET nombre = ?, updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($id)
        ]);
    }

    public function eliminar(int $id)
    {
        return ejecutarConsulta(
            "DELETE FROM tipo_movimiento_almacen WHERE id = ?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM tipo_movimiento_almacen WHERE id = ?",
            [$id]
        );
    }

    public function listar()
    {
        return ejecutarConsulta(
            "SELECT *
               FROM tipo_movimiento_almacen
           ORDER BY id ASC",
            []
        );
    }
}