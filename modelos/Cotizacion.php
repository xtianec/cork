<?php
require_once __DIR__ . '/../config/Conexion.php';

class Cotizacion
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO cotizacion (cliente_id, fecha, monto_total, estado_id, created_at, updated_at, is_active)
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
        $sql = "UPDATE cotizacion SET
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
            "UPDATE cotizacion SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE cotizacion SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM cotizacion WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT c.id, cl.razon_social AS cliente, c.fecha, c.monto_total,
                       ec.descripcion AS estado, c.is_active
                  FROM cotizacion c
                  JOIN cliente cl ON cl.id = c.cliente_id
                  JOIN estado_cotizacion ec ON ec.id = c.estado_id
                 ORDER BY c.id DESC";
        return ejecutarConsulta($sql);
    }
}
