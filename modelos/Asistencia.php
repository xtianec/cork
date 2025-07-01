<?php
require_once __DIR__ . '/../config/Conexion.php';

class Asistencia
{
    public function insertar($empleado_id, $fecha, $hora_entrada, $hora_salida)
    {
        $sql = "INSERT INTO asistencia (empleado_id, fecha, hora_entrada, hora_salida, created_at, updated_at, is_active)
                VALUES (?,?,?,?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [
            limpiarCadena($empleado_id),
            limpiarCadena($fecha),
            limpiarCadena($hora_entrada),
            limpiarCadena($hora_salida)
        ]);
    }

    public function editar($id, $empleado_id, $fecha, $hora_entrada, $hora_salida)
    {
        $sql = "UPDATE asistencia SET
                    empleado_id = ?,
                    fecha = ?,
                    hora_entrada = ?,
                    hora_salida = ?,
                    updated_at = NOW()
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($empleado_id),
            limpiarCadena($fecha),
            limpiarCadena($hora_entrada),
            limpiarCadena($hora_salida),
            limpiarCadena($id)
        ]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE asistencia SET is_active = 0, updated_at = NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE asistencia SET is_active = 1, updated_at = NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT * FROM asistencia WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($id)]);
    }

    public function listar()
    {
        $sql = "SELECT a.id,
                       CONCAT(e.nombre, ' ', e.apellido) AS empleado,
                       a.fecha,
                       a.hora_entrada,
                       a.hora_salida,
                       DATE_FORMAT(a.created_at, '%Y-%m-%d %H:%i') AS created_at,
                       DATE_FORMAT(a.updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                       a.is_active
                  FROM asistencia a
             JOIN empleado e ON e.id = a.empleado_id
              ORDER BY a.fecha DESC";
        return ejecutarConsulta($sql);
    }
}
?>
