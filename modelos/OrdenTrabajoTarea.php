<?php
require_once __DIR__ . '/../config/Conexion.php';

class OrdenTrabajoTarea
{
    public function insertar($orden_id, $descripcion, $empleado_id, $horas, $costo_hora)
    {
        $costo_total = (float)$horas * (float)$costo_hora;
        $sql = "INSERT INTO orden_trabajo_tarea
                    (orden_trabajo_id, descripcion, empleado_id, horas, costo_hora, costo_total, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        return ejecutarConsulta($sql, [
            limpiarCadena($orden_id),
            limpiarCadena($descripcion),
            limpiarCadena($empleado_id),
            limpiarCadena($horas),
            limpiarCadena($costo_hora),
            $costo_total
        ]);
    }

    public function listarPorOrden($orden_id)
    {
        $sql = "SELECT ott.id,
                       ott.descripcion,
                       CONCAT(e.nombre,' ',e.apellido) AS empleado,
                       ott.horas,
                       ott.costo_hora,
                       ott.costo_total
                  FROM orden_trabajo_tarea ott
             LEFT JOIN empleado e ON e.id = ott.empleado_id
                 WHERE ott.orden_trabajo_id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($orden_id)]);
    }

    public function costoPorProyecto($proyecto_id)
    {
        $sql = "SELECT SUM(ott.costo_total) AS total
                  FROM orden_trabajo_tarea ott
                  JOIN orden_trabajo ot ON ot.id = ott.orden_trabajo_id
                 WHERE ot.proyecto_id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($proyecto_id)]);
    }
}
