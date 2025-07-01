<?php
require_once __DIR__ . '/../config/Conexion.php';

class OrdenTrabajo
{
    public function insertar($proyecto_id, $codigo, $descripcion, $estado_id, $fecha_inicio, $fecha_fin)
    {
        $sql = "INSERT INTO orden_trabajo
                    (proyecto_id, codigo, descripcion, estado_id, fecha_inicio, fecha_fin, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [
            limpiarCadena($proyecto_id),
            limpiarCadena($codigo),
            limpiarCadena($descripcion),
            limpiarCadena($estado_id),
            limpiarCadena($fecha_inicio),
            limpiarCadena($fecha_fin)
        ]);
    }

    public function editar($id, $proyecto_id, $codigo, $descripcion, $estado_id, $fecha_inicio, $fecha_fin)
    {
        $sql = "UPDATE orden_trabajo SET
                    proyecto_id = ?,
                    codigo = ?,
                    descripcion = ?,
                    estado_id = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?,
                    updated_at = NOW()
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($proyecto_id),
            limpiarCadena($codigo),
            limpiarCadena($descripcion),
            limpiarCadena($estado_id),
            limpiarCadena($fecha_inicio),
            limpiarCadena($fecha_fin),
            limpiarCadena($id)
        ]);
    }

    public function desactivar($id)
    {
        return ejecutarConsulta(
            "UPDATE orden_trabajo SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar($id)
    {
        return ejecutarConsulta(
            "UPDATE orden_trabajo SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar($id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM orden_trabajo WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT ot.id,
                       p.nombre AS proyecto,
                       ot.codigo,
                       ot.fecha_inicio,
                       ot.fecha_fin,
                       eot.descripcion AS estado,
                       DATE_FORMAT(ot.created_at,'%Y-%m-%d %H:%i') AS created_at,
                       DATE_FORMAT(ot.updated_at,'%Y-%m-%d %H:%i') AS updated_at,
                       ot.is_active
                  FROM orden_trabajo ot
             LEFT JOIN proyecto p ON p.id = ot.proyecto_id
             LEFT JOIN estado_orden_trabajo eot ON eot.id = ot.estado_id
                 ORDER BY ot.id DESC";
        return ejecutarConsulta($sql);
    }

    public function selectProyecto()
    {
        $sql = "SELECT id, nombre FROM proyecto WHERE is_active=1 ORDER BY nombre";
        return ejecutarConsulta($sql);
    }

    public function selectEstado()
    {
        $sql = "SELECT id, descripcion FROM estado_orden_trabajo WHERE is_active=1 ORDER BY descripcion";
        return ejecutarConsulta($sql);
    }
}
