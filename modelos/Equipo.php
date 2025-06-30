<?php
require_once __DIR__ . '/../config/Conexion.php';

class Equipo
{
    public function insertar($cliente_local_id, $tipo_id, $marca_id,
                             $modelo_id, $serie, $referencia,
                             $ubicacion, $fecha_adquisicion, $estado_id,
                             $horometro_actual)
    {
        $cliente_local_id   = limpiarCadena($cliente_local_id);
        $tipo_id            = limpiarCadena($tipo_id);
        $marca_id           = limpiarCadena($marca_id);
        $modelo_id          = limpiarCadena($modelo_id);
        $serie              = limpiarCadena($serie);
        $referencia         = limpiarCadena($referencia);
        $ubicacion          = limpiarCadena($ubicacion);
        $fecha_adquisicion  = limpiarCadena($fecha_adquisicion);
        $estado_id          = limpiarCadena($estado_id);
        $horometro_actual   = limpiarCadena($horometro_actual);

        $sql = "INSERT INTO equipo
                (cliente_local_id, tipo_id, marca_id, modelo_id,
                 serie, referencia, ubicacion, fecha_adquisicion,
                 estado_id, horometro_actual)
                VALUES (?,?,?,?,?,?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            $cliente_local_id, $tipo_id, $marca_id, $modelo_id,
            $serie, $referencia, $ubicacion, $fecha_adquisicion,
            $estado_id, $horometro_actual
        ]);
    }

    public function editar($id, $cliente_local_id, $tipo_id, $marca_id,
                           $modelo_id, $serie, $referencia,
                           $ubicacion, $fecha_adquisicion, $estado_id,
                           $horometro_actual)
    {
        $id                 = limpiarCadena($id);
        $cliente_local_id   = limpiarCadena($cliente_local_id);
        $tipo_id            = limpiarCadena($tipo_id);
        $marca_id           = limpiarCadena($marca_id);
        $modelo_id          = limpiarCadena($modelo_id);
        $serie              = limpiarCadena($serie);
        $referencia         = limpiarCadena($referencia);
        $ubicacion          = limpiarCadena($ubicacion);
        $fecha_adquisicion  = limpiarCadena($fecha_adquisicion);
        $estado_id          = limpiarCadena($estado_id);
        $horometro_actual   = limpiarCadena($horometro_actual);

        $sql = "UPDATE equipo SET
                    cliente_local_id  = ?,
                    tipo_id           = ?,
                    marca_id          = ?,
                    modelo_id         = ?,
                    serie             = ?,
                    referencia        = ?,
                    ubicacion         = ?,
                    fecha_adquisicion = ?,
                    estado_id         = ?,
                    horometro_actual  = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $cliente_local_id, $tipo_id, $marca_id, $modelo_id,
            $serie, $referencia, $ubicacion, $fecha_adquisicion,
            $estado_id, $horometro_actual,
            $id
        ]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE equipo SET is_active = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE equipo SET is_active = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM equipo WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT e.*, cl.nombre AS planta, et.descripcion AS estado
                  FROM equipo e
             LEFT JOIN cliente_local cl ON e.cliente_local_id = cl.id
             LEFT JOIN estado_equipos et ON e.estado_id = et.id
             ORDER BY e.id DESC";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, serie FROM equipo WHERE is_active = 1";
        return ejecutarConsulta($sql);
    }
}
