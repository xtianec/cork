<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlanesPrecios
{
    public function insertar($modelo_equipo_id, $plan_id, $mano, $mat, $terc)
    {
        $sql = "INSERT INTO planes_precios (modelo_equipo_id, plan_id, precio_manoobra, precio_materiales, terceros) VALUES (?, ?, ?, ?, ?)";
        return ejecutarConsulta($sql, [
            limpiarCadena($modelo_equipo_id),
            limpiarCadena($plan_id),
            limpiarCadena($mano),
            limpiarCadena($mat),
            limpiarCadena($terc)
        ]);
    }

    public function editar($modelo_equipo_id, $plan_id, $mano, $mat, $terc)
    {
        $sql = "UPDATE planes_precios SET precio_manoobra=?, precio_materiales=?, terceros=? WHERE modelo_equipo_id=? AND plan_id=?";
        return ejecutarConsulta($sql, [
            limpiarCadena($mano),
            limpiarCadena($mat),
            limpiarCadena($terc),
            limpiarCadena($modelo_equipo_id),
            limpiarCadena($plan_id)
        ]);
    }

    public function eliminar($modelo_equipo_id, $plan_id)
    {
        $sql = "DELETE FROM planes_precios WHERE modelo_equipo_id=? AND plan_id=?";
        return ejecutarConsulta($sql, [
            limpiarCadena($modelo_equipo_id),
            limpiarCadena($plan_id)
        ]);
    }

    public function mostrar($modelo_equipo_id, $plan_id)
    {
        $sql = "SELECT * FROM planes_precios WHERE modelo_equipo_id=? AND plan_id=?";
        return ejecutarConsultaSimpleFila($sql, [
            limpiarCadena($modelo_equipo_id),
            limpiarCadena($plan_id)
        ]);
    }

    public function listar()
    {
        $sql = "SELECT modelo_equipo_id, plan_id, precio_manoobra, precio_materiales, terceros FROM planes_precios";
        return ejecutarConsulta($sql);
    }
}
?>
