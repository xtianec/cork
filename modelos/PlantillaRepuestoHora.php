<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlantillaRepuestoHora
{
    public function insertar($plantilla_repuesto_id, $horas_id)
    {
        $plantilla_repuesto_id = limpiarCadena($plantilla_repuesto_id);
        $horas_id              = limpiarCadena($horas_id);

        $sql = "INSERT INTO plantilla_repuesto_hora
                (plantilla_repuesto_id, horas_id)
                VALUES (?,?)";
        return ejecutarConsulta($sql, [
            $plantilla_repuesto_id, $horas_id
        ]);
    }

    public function eliminar($id)
    {
        $id = limpiarCadena($id);
        $sql = "DELETE FROM plantilla_repuesto_hora WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function listarPorRepuesto($plantilla_repuesto_id)
    {
        $plantilla_repuesto_id = limpiarCadena($plantilla_repuesto_id);
        $sql = "SELECT prh.id, ph.horas
                  FROM plantilla_repuesto_hora prh
             LEFT JOIN plantilla_horas ph ON prh.horas_id = ph.id
                 WHERE prh.plantilla_repuesto_id = ?";
        return ejecutarConsulta($sql, [$plantilla_repuesto_id]);
    }
}
