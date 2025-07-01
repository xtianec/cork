<?php
require_once __DIR__ . '/../config/Conexion.php';

class PedidoVenta
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO pedido_venta (cliente_id, fecha, monto_total, estado_id, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, NOW(), NOW(), 1)";
        $params = [
            limpiarCadena($data['cliente_id']),
            limpiarCadena($data['fecha']),
            limpiarCadena($data['monto_total']),
            limpiarCadena($data['estado_id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data)
    {
        $sql = "UPDATE pedido_venta SET
                    cliente_id  = ?,
                    fecha       = ?,
                    monto_total = ?,
                    estado_id   = ?,
                    updated_at  = NOW()
                WHERE id = ?";
        $params = [
            limpiarCadena($data['cliente_id']),
            limpiarCadena($data['fecha']),
            limpiarCadena($data['monto_total']),
            limpiarCadena($data['estado_id']),
            limpiarCadena($data['id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE pedido_venta SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE pedido_venta SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM pedido_venta WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT p.id, cl.razon_social AS cliente, p.fecha, p.monto_total,
                       ed.descripcion AS estado, p.is_active
                  FROM pedido_venta p
                  JOIN cliente cl ON cl.id = p.cliente_id
                  JOIN estado_documento ed ON ed.id = p.estado_id
                 ORDER BY p.id DESC";
        return ejecutarConsulta($sql);
    }
}
