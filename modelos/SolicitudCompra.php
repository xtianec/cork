<?php
require_once __DIR__ . '/../config/Conexion.php';

class SolicitudCompra
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO solicitud_compra (codigo, fecha, descripcion, estado_id, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, NOW(), NOW(), 1)";
        $params = [
            limpiarCadena($data['codigo'] ?? ''),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['descripcion'] ?? ''),
            limpiarCadena($data['estado_id'] ?? 1)
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data)
    {
        $sql = "UPDATE solicitud_compra SET
                    codigo       = ?,
                    fecha        = ?,
                    descripcion  = ?,
                    estado_id    = ?,
                    updated_at   = NOW()
                WHERE id = ?";
        $params = [
            limpiarCadena($data['codigo'] ?? ''),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['descripcion'] ?? ''),
            limpiarCadena($data['estado_id'] ?? 1),
            limpiarCadena($data['id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE solicitud_compra SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE solicitud_compra SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM solicitud_compra WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT sc.id, sc.codigo, sc.fecha, sc.descripcion,
                       eo.descripcion AS estado, sc.is_active
                  FROM solicitud_compra sc
                  JOIN estado_orden_compra eo ON eo.id = sc.estado_id
                 ORDER BY sc.id DESC";
        return ejecutarConsulta($sql);
    }
}
