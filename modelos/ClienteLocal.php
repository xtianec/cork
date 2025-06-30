<?php
require_once __DIR__ . '/../config/Conexion.php';

class ClienteLocal
{
    public function insertar($cliente_id, $nombre,
                             $direccion, $ciudad, $departamento)
    {
        $cliente_id   = limpiarCadena($cliente_id);
        $nombre       = limpiarCadena($nombre);
        $direccion    = limpiarCadena($direccion);
        $ciudad       = limpiarCadena($ciudad);
        $departamento = limpiarCadena($departamento);

        $sql = "INSERT INTO cliente_local
                (cliente_id, nombre, direccion, ciudad, departamento)
                VALUES (?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            $cliente_id, $nombre, $direccion, $ciudad, $departamento
        ]);
    }

    public function editar($id, $cliente_id, $nombre,
                           $direccion, $ciudad, $departamento)
    {
        $id           = limpiarCadena($id);
        $cliente_id   = limpiarCadena($cliente_id);
        $nombre       = limpiarCadena($nombre);
        $direccion    = limpiarCadena($direccion);
        $ciudad       = limpiarCadena($ciudad);
        $departamento = limpiarCadena($departamento);

        $sql = "UPDATE cliente_local SET
                    cliente_id   = ?,
                    nombre       = ?,
                    direccion    = ?,
                    ciudad       = ?,
                    departamento = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $cliente_id, $nombre, $direccion, $ciudad, $departamento, $id
        ]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE cliente_local SET is_active = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE cliente_local SET is_active = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM cliente_local WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT cl.*, c.razon_social
                  FROM cliente_local cl
             INNER JOIN cliente c ON cl.cliente_id = c.id
             ORDER BY cl.nombre";
        return ejecutarConsulta($sql);
    }

    public function select($cliente_id = null)
    {
        if ($cliente_id) {
            $cliente_id = limpiarCadena($cliente_id);
            $sql = "SELECT id, nombre FROM cliente_local
                     WHERE is_active = 1 AND cliente_id = ?
                     ORDER BY nombre";
            return ejecutarConsulta($sql, [$cliente_id]);
        } else {
            $sql = "SELECT id, nombre FROM cliente_local
                     WHERE is_active = 1
                     ORDER BY nombre";
            return ejecutarConsulta($sql);
        }
    }
}
