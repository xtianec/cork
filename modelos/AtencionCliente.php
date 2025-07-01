<?php
require_once __DIR__ . '/../config/Conexion.php';

class AtencionCliente
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO atencion_cliente (cliente_id, asunto, descripcion, estado, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, NOW(), NOW(), 1)";
        $params = [
            limpiarCadena($data['cliente_id']),
            limpiarCadena($data['asunto']),
            limpiarCadena($data['descripcion']),
            limpiarCadena($data['estado'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data)
    {
        $sql = "UPDATE atencion_cliente SET
                    cliente_id = ?,
                    asunto      = ?,
                    descripcion = ?,
                    estado      = ?,
                    updated_at  = NOW()
                WHERE id = ?";
        $params = [
            limpiarCadena($data['cliente_id']),
            limpiarCadena($data['asunto']),
            limpiarCadena($data['descripcion']),
            limpiarCadena($data['estado']),
            limpiarCadena($data['id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE atencion_cliente SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE atencion_cliente SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM atencion_cliente WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT a.id, cl.razon_social AS cliente, a.asunto, a.estado, a.is_active,
                       DATE_FORMAT(a.created_at, '%Y-%m-%d') AS fecha
                  FROM atencion_cliente a
                  JOIN cliente cl ON cl.id = a.cliente_id
                 ORDER BY a.id DESC";
        return ejecutarConsulta($sql);
    }
}
