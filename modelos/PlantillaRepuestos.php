<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlantillaRepuesto
{
    public function insertar($plantilla_id, $articulo_id,
                             $cantidad, $stock_actual, $orden)
    {
        $plantilla_id = limpiarCadena($plantilla_id);
        $articulo_id  = limpiarCadena($articulo_id);
        $cantidad     = limpiarCadena($cantidad);
        $stock_actual = limpiarCadena($stock_actual);
        $orden        = limpiarCadena($orden);

        $sql = "INSERT INTO plantilla_repuesto
                (plantilla_id, articulo_id, cantidad, stock_actual, orden)
                VALUES (?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            $plantilla_id, $articulo_id,
            $cantidad, $stock_actual, $orden
        ]);
    }

    public function editar($id, $plantilla_id, $articulo_id,
                           $cantidad, $stock_actual, $orden)
    {
        $id           = limpiarCadena($id);
        $plantilla_id = limpiarCadena($plantilla_id);
        $articulo_id  = limpiarCadena($articulo_id);
        $cantidad     = limpiarCadena($cantidad);
        $stock_actual = limpiarCadena($stock_actual);
        $orden        = limpiarCadena($orden);

        $sql = "UPDATE plantilla_repuesto SET
                    plantilla_id = ?,
                    articulo_id  = ?,
                    cantidad     = ?,
                    stock_actual = ?,
                    orden        = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $plantilla_id, $articulo_id,
            $cantidad, $stock_actual, $orden,
            $id
        ]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM plantilla_repuesto WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT pr.*, a.nombre AS articulo
                  FROM plantilla_repuesto pr
             LEFT JOIN articulo a ON pr.articulo_id = a.id
             ORDER BY pr.orden";
        return ejecutarConsulta($sql);
    }

    public function select($plantilla_id = null)
    {
        if ($plantilla_id) {
            $plantilla_id = limpiarCadena($plantilla_id);
            $sql = "SELECT id, articulo_id, cantidad
                     FROM plantilla_repuesto
                    WHERE plantilla_id = ?
                    ORDER BY orden";
            return ejecutarConsulta($sql, [$plantilla_id]);
        } else {
            $sql = "SELECT id, articulo_id, cantidad
                      FROM plantilla_repuesto
                     ORDER BY orden";
            return ejecutarConsulta($sql);
        }
    }
}
