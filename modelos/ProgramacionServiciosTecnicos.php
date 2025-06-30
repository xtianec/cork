<?php
require_once __DIR__ . '/../config/Conexion.php';

class ProgramacionServiciosTecnicos
{
    public function insertar($equipo_id, $tipo_servicio_id,
                             $frecuencia_horas, $fecha_ultimo,
                             $horas_ultimo, $fecha_proximo,
                             $horas_proximo, $notificar)
    {
        $equipo_id          = limpiarCadena($equipo_id);
        $tipo_servicio_id   = limpiarCadena($tipo_servicio_id);
        $frecuencia_horas   = limpiarCadena($frecuencia_horas);
        $fecha_ultimo       = limpiarCadena($fecha_ultimo);
        $horas_ultimo       = limpiarCadena($horas_ultimo);
        $fecha_proximo      = limpiarCadena($fecha_proximo);
        $horas_proximo      = limpiarCadena($horas_proximo);
        $notificar          = limpiarCadena($notificar);

        $sql = "INSERT INTO programacion_servicios_tecnicos
                (equipo_id, tipo_servicio_id, frecuencia_horas,
                 fecha_ultimo, horas_ultimo, fecha_proximo,
                 horas_proximo, notificar)
                VALUES (?,?,?,?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            $equipo_id, $tipo_servicio_id, $frecuencia_horas,
            $fecha_ultimo, $horas_ultimo, $fecha_proximo,
            $horas_proximo, $notificar
        ]);
    }

    public function editar($id, $equipo_id, $tipo_servicio_id,
                           $frecuencia_horas, $fecha_ultimo,
                           $horas_ultimo, $fecha_proximo,
                           $horas_proximo, $notificar)
    {
        $id                 = limpiarCadena($id);
        $equipo_id          = limpiarCadena($equipo_id);
        $tipo_servicio_id   = limpiarCadena($tipo_servicio_id);
        $frecuencia_horas   = limpiarCadena($frecuencia_horas);
        $fecha_ultimo       = limpiarCadena($fecha_ultimo);
        $horas_ultimo       = limpiarCadena($horas_ultimo);
        $fecha_proximo      = limpiarCadena($fecha_proximo);
        $horas_proximo      = limpiarCadena($horas_proximo);
        $notificar          = limpiarCadena($notificar);

        $sql = "UPDATE programacion_servicios_tecnicos SET
                    equipo_id          = ?,
                    tipo_servicio_id   = ?,
                    frecuencia_horas   = ?,
                    fecha_ultimo       = ?,
                    horas_ultimo       = ?,
                    fecha_proximo      = ?,
                    horas_proximo      = ?,
                    notificar          = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $equipo_id, $tipo_servicio_id, $frecuencia_horas,
            $fecha_ultimo, $horas_ultimo, $fecha_proximo,
            $horas_proximo, $notificar, $id
        ]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM programacion_servicios_tecnicos WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT pst.*, e.serie, ts.nombre AS servicio
                  FROM programacion_servicios_tecnicos pst
             LEFT JOIN equipo e ON pst.equipo_id = e.id
             LEFT JOIN tipo_servicio ts ON pst.tipo_servicio_id = ts.id
             ORDER BY pst.id DESC";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, frecuencia_horas FROM programacion_servicios_tecnicos";
        return ejecutarConsulta($sql);
    }
}
