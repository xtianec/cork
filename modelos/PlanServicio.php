<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlanServicio
{
    public function insertar($plan_id, $descripcion)
    {
        $plan_id     = limpiarCadena($plan_id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "INSERT INTO planes_servicio (plan_id, plan_desc) VALUES (?, ?)";
        return ejecutarConsulta($sql, [$plan_id, $descripcion]);
    }

    public function editar($plan_id, $descripcion)
    {
        $plan_id     = limpiarCadena($plan_id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE planes_servicio SET plan_desc = ? WHERE plan_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $plan_id]);
    }

    public function eliminar($plan_id)
    {
        $plan_id = limpiarCadena($plan_id);
        $sql = "DELETE FROM planes_servicio WHERE plan_id = ?";
        return ejecutarConsulta($sql, [$plan_id]);
    }

    public function mostrar($plan_id)
    {
        $plan_id = limpiarCadena($plan_id);
        $sql = "SELECT plan_id, plan_desc FROM planes_servicio WHERE plan_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$plan_id]);
    }

    public function listar()
    {
        $sql = "SELECT plan_id, plan_desc FROM planes_servicio ORDER BY plan_id";
        return ejecutarConsulta($sql);
    }
}
?>
