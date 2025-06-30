<?php
require_once __DIR__ . '/../config/Conexion.php';

class ServicioTecnico
{
    public function insertar($equipo_id, $programacion_id,
                             $fecha_servicio, $horometro,
                             $horas_trabajadas, $notas)
    {
        $equipo_id         = limpiarCadena($equipo_id);
        $programacion_id   = limpiarCadena($programacion_id);
        $fecha_servicio    = limpiarCadena($fecha_servicio);
        $horometro         = limpiarCadena($horometro);
        $horas_trabajadas  = limpiarCadena($horas_trabajadas);
        $notas             = limpiarCadena($notas);

        $sql = "INSERT INTO servicio_tecnico
                (equipo_id, programacion_id, fecha_servicio,
                 horometro, horas_trabajadas, notas)
                VALUES (?,?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            $equipo_id, $programacion_id, $fecha_servicio,
            $horometro, $horas_trabajadas, $notas
        ]);
    }

    public function editar($id, $equipo_id, $programacion_id,
                           $fecha_servicio, $horometro,
                           $horas_trabajadas, $notas)
    {
        $id                 = limpiarCadena($id);
        $equipo_id          = limpiarCadena($equipo_id);
        $programacion_id    = limpiarCadena($programacion_id);
        $fecha_servicio     = limpiarCadena($fecha_servicio);
        $horometro          = limpiarCadena($horometro);
        $horas_trabajadas   = limpiarCadena($horas_trabajadas);
        $notas              = limpiarCadena($notas);

        $sql = "UPDATE servicio_tecnico SET
                    equipo_id         = ?,
                    programacion_id   = ?,
                    fecha_servicio    = ?,
                    horometro         = ?,
                    horas_trabajadas  = ?,
                    notas             = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $equipo_id, $programacion_id, $fecha_servicio,
            $horometro, $horas_trabajadas, $notas,
            $id
        ]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM servicio_tecnico WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT st.*, e.serie, pst.frecuencia_horas
                  FROM servicio_tecnico st
             LEFT JOIN equipo e  ON st.equipo_id       = e.id
             LEFT JOIN programacion_servicios_tecnicos pst
                    ON st.programacion_id = pst.id
             ORDER BY st.fecha_servicio DESC";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, fecha_servicio FROM servicio_tecnico";
        return ejecutarConsulta($sql);
    }
}
