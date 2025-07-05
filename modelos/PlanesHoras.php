<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlanesHoras
{
    public function insertar($plan_id, $horas_plan, $plan_desc)
    {
        $plan_id    = limpiarCadena($plan_id);
        $horas_plan = limpiarCadena($horas_plan);
        $plan_desc  = limpiarCadena($plan_desc);
        $sql = "INSERT INTO planes_horas (plan_id, horas_plan, plan_desc) VALUES (?, ?, ?)";
        return ejecutarConsulta($sql, [$plan_id, $horas_plan, $plan_desc]);
    }

    public function editar($plan_id, $horas_plan, $plan_desc)
    {
        $plan_id    = limpiarCadena($plan_id);
        $horas_plan = limpiarCadena($horas_plan);
        $plan_desc  = limpiarCadena($plan_desc);
        $sql = "UPDATE planes_horas SET horas_plan = ?, plan_desc = ? WHERE plan_id = ?";
        return ejecutarConsulta($sql, [$horas_plan, $plan_desc, $plan_id]);
    }

    public function eliminar($plan_id)
    {
        $plan_id = limpiarCadena($plan_id);
        $sql = "DELETE FROM planes_horas WHERE plan_id = ?";
        return ejecutarConsulta($sql, [$plan_id]);
    }

    public function mostrar($plan_id)
    {
        $plan_id = limpiarCadena($plan_id);
        $sql = "SELECT plan_id, horas_plan, plan_desc FROM planes_horas WHERE plan_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$plan_id]);
    }

    public function listar()
    {
        $sql = "SELECT plan_id, horas_plan, plan_desc FROM planes_horas ORDER BY plan_id";
        return ejecutarConsulta($sql);
    }
}
?>
