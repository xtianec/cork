<?php
require_once __DIR__ . '/../config/Conexion.php';

class RecepcionMercancia
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO recepcion_mercancia (orden_compra_id, fecha, observaciones, created_at, updated_at, is_active)
                VALUES (?, ?, ?, NOW(), NOW(), 1)";
        $params = [
            limpiarCadena($data['orden_compra_id'] ?? 0),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['observaciones'] ?? '')
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data)
    {
        $sql = "UPDATE recepcion_mercancia SET
                    orden_compra_id = ?,
                    fecha           = ?,
                    observaciones   = ?,
                    updated_at      = NOW()
                WHERE id = ?";
        $params = [
            limpiarCadena($data['orden_compra_id'] ?? 0),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['observaciones'] ?? ''),
            limpiarCadena($data['id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE recepcion_mercancia SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE recepcion_mercancia SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM recepcion_mercancia WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT rm.id, oc.id AS orden,
                       rm.fecha, rm.observaciones, rm.is_active
                  FROM recepcion_mercancia rm
                  JOIN orden_compra oc ON oc.id = rm.orden_compra_id
                 ORDER BY rm.id DESC";
        return ejecutarConsulta($sql);
    }
}
