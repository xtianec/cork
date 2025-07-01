<?php
require_once __DIR__ . '/../config/Conexion.php';

class EvaluacionProveedor
{
    public function insertar(array $data)
    {
        $sql = "INSERT INTO evaluacion_proveedor (proveedor_id, fecha, calificacion, comentarios, created_at, updated_at, is_active)
                VALUES (?, ?, ?, ?, NOW(), NOW(), 1)";
        $params = [
            limpiarCadena($data['proveedor_id'] ?? 0),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['calificacion'] ?? 0),
            limpiarCadena($data['comentarios'] ?? '')
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data)
    {
        $sql = "UPDATE evaluacion_proveedor SET
                    proveedor_id = ?,
                    fecha        = ?,
                    calificacion = ?,
                    comentarios  = ?,
                    updated_at   = NOW()
                WHERE id = ?";
        $params = [
            limpiarCadena($data['proveedor_id'] ?? 0),
            limpiarCadena($data['fecha'] ?? ''),
            limpiarCadena($data['calificacion'] ?? 0),
            limpiarCadena($data['comentarios'] ?? ''),
            limpiarCadena($data['id'])
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE evaluacion_proveedor SET is_active=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE evaluacion_proveedor SET is_active=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM evaluacion_proveedor WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = "SELECT ep.id, p.razon_social AS proveedor,
                       ep.fecha, ep.calificacion, ep.comentarios, ep.is_active
                  FROM evaluacion_proveedor ep
                  JOIN proveedor p ON p.id = ep.proveedor_id
                 ORDER BY ep.id DESC";
        return ejecutarConsulta($sql);
    }
}
