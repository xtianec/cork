<?php
require_once __DIR__ . '/../config/Conexion.php';

class OrdenCompra
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO orden_compra (proveedor_id, solicitud_id, fecha, total, estado_id, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, ?, NOW(), NOW(), 1)";
        $params = [
            limpiarCadena($data['proveedor_id'] ?? 0),
            limpiarCadena($data['solicitud_id'] ?? null),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['total'] ?? 0),
            limpiarCadena($data['estado_id'] ?? 1)
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data)
    {
        $sql = "UPDATE orden_compra SET
                    proveedor_id = ?,
                    solicitud_id = ?,
                    fecha        = ?,
                    total        = ?,
                    estado_id    = ?,
                    updated_at   = NOW()
                WHERE id = ?";
        $params = [
            limpiarCadena($data['proveedor_id'] ?? 0),
            limpiarCadena($data['solicitud_id'] ?? null),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['total'] ?? 0),
            limpiarCadena($data['estado_id'] ?? 1),
            limpiarCadena($data['id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE orden_compra SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE orden_compra SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM orden_compra WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT oc.id, p.razon_social AS proveedor,
                       oc.fecha, oc.total,
                       eo.descripcion AS estado, oc.is_active
                  FROM orden_compra oc
                  JOIN proveedor p ON p.id = oc.proveedor_id
                  JOIN estado_orden_compra eo ON eo.id = oc.estado_id
                 ORDER BY oc.id DESC";
        return ejecutarConsulta($sql);
    }
}
