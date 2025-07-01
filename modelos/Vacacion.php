<?php
require_once __DIR__ . '/../config/Conexion.php';

class Vacacion
{
    public function insertar($empleado_id, $fecha_inicio, $fecha_fin, $dias)
    {
        $sql = "INSERT INTO vacacion (empleado_id, fecha_inicio, fecha_fin, dias, created_at, updated_at, is_active)
                VALUES (?,?,?,?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [
            limpiarCadena($empleado_id),
            limpiarCadena($fecha_inicio),
            limpiarCadena($fecha_fin),
            limpiarCadena($dias)
        ]);
    }

    public function editar($id, $empleado_id, $fecha_inicio, $fecha_fin, $dias)
    {
        $sql = "UPDATE vacacion SET
                    empleado_id = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?,
                    dias = ?,
                    updated_at = NOW()
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($empleado_id),
            limpiarCadena($fecha_inicio),
            limpiarCadena($fecha_fin),
            limpiarCadena($dias),
            limpiarCadena($id)
        ]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE vacacion SET is_active = 0, updated_at = NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE vacacion SET is_active = 1, updated_at = NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT * FROM vacacion WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($id)]);
    }

    public function listar()
    {
        $sql = "SELECT v.id,
                       CONCAT(e.nombre, ' ', e.apellido) AS empleado,
                       v.fecha_inicio,
                       v.fecha_fin,
                       v.dias,
                       DATE_FORMAT(v.created_at, '%Y-%m-%d %H:%i') AS created_at,
                       DATE_FORMAT(v.updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                       v.is_active
                  FROM vacacion v
             JOIN empleado e ON e.id = v.empleado_id
              ORDER BY v.fecha_inicio DESC";
        return ejecutarConsulta($sql);
    }
}
?>
