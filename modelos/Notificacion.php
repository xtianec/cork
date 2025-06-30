<?php
require_once __DIR__ . '/../config/Conexion.php';

class Notificacion
{
    public function insertar($programacion_id, $enviado_at,
                             $medio, $resultado)
    {
        $programacion_id = limpiarCadena($programacion_id);
        $enviado_at      = limpiarCadena($enviado_at);
        $medio           = limpiarCadena($medio);
        $resultado       = limpiarCadena($resultado);

        $sql = "INSERT INTO notificacion
                (programacion_id, enviado_at, medio, resultado)
                VALUES (?,?,?,?)";
        return ejecutarConsulta($sql, [
            $programacion_id, $enviado_at, $medio, $resultado
        ]);
    }

    public function editar($id, $programacion_id, $enviado_at,
                           $medio, $resultado)
    {
        $id              = limpiarCadena($id);
        $programacion_id = limpiarCadena($programacion_id);
        $enviado_at      = limpiarCadena($enviado_at);
        $medio           = limpiarCadena($medio);
        $resultado       = limpiarCadena($resultado);

        $sql = "UPDATE notificacion SET
                    programacion_id = ?,
                    enviado_at      = ?,
                    medio           = ?,
                    resultado       = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $programacion_id, $enviado_at, $medio, $resultado, $id
        ]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE notificacion SET is_active = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE notificacion SET is_active = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM notificacion WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT n.*, p.frecuencia_horas
                  FROM notificacion n
             LEFT JOIN programacion_servicios_tecnicos p
               ON n.programacion_id = p.id
             ORDER BY n.enviado_at DESC";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, medio FROM notificacion WHERE is_active = 1";
        return ejecutarConsulta($sql);
    }
}
