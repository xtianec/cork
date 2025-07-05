<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlanesPreciosServicios
{
    public function insertar($data)
    {
        $sql = "INSERT INTO planes_precios_servicios (
            modelo_equipo_id, plana_manoobra, plana_materiales, plana_terceros,
            planb_manoobra, planb_materiales, planb_terceros,
            planc_manoobra, planc_materiales, planc_terceros,
            pland_manoobra, pland_materiales, pland_terceros,
            plan_semestral_manoobra, plan_semestral_materiales, plan_semestral_terceros,
            plan_anual_manoobra, plan_anual_materiales, plan_anual_terceros
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $params = array_map('limpiarCadena', $data);
        return ejecutarConsulta($sql, $params);
    }

    public function editar($modelo_equipo_id, $data)
    {
        $sql = "UPDATE planes_precios_servicios SET
            plana_manoobra=?, plana_materiales=?, plana_terceros=?,
            planb_manoobra=?, planb_materiales=?, planb_terceros=?,
            planc_manoobra=?, planc_materiales=?, planc_terceros=?,
            pland_manoobra=?, pland_materiales=?, pland_terceros=?,
            plan_semestral_manoobra=?, plan_semestral_materiales=?, plan_semestral_terceros=?,
            plan_anual_manoobra=?, plan_anual_materiales=?, plan_anual_terceros=?
            WHERE modelo_equipo_id=?";
        $params = array_map('limpiarCadena', $data);
        $params[] = limpiarCadena($modelo_equipo_id);
        return ejecutarConsulta($sql, $params);
    }

    public function eliminar($modelo_equipo_id)
    {
        $sql = "DELETE FROM planes_precios_servicios WHERE modelo_equipo_id=?";
        return ejecutarConsulta($sql, [limpiarCadena($modelo_equipo_id)]);
    }

    public function mostrar($modelo_equipo_id)
    {
        $sql = "SELECT * FROM planes_precios_servicios WHERE modelo_equipo_id=?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($modelo_equipo_id)]);
    }

    public function listar()
    {
        $sql = "SELECT modelo_equipo_id, plana_manoobra, planb_manoobra, planc_manoobra, pland_manoobra FROM planes_precios_servicios";
        return ejecutarConsulta($sql);
    }
}
?>
