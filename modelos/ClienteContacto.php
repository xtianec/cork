<?php
require_once __DIR__ . '/../config/Conexion.php';

class ClienteContacto
{
    public function asignar($cliente_id, $contacto_id)
    {
        $cliente_id  = limpiarCadena($cliente_id);
        $contacto_id = limpiarCadena($contacto_id);
        $sql = "INSERT INTO cliente_contacto (cliente_id, contacto_id) VALUES (?, ?)";
        return ejecutarConsulta($sql, [$cliente_id, $contacto_id]);
    }

    public function desasignar($cliente_id, $contacto_id)
    {
        $cliente_id  = limpiarCadena($cliente_id);
        $contacto_id = limpiarCadena($contacto_id);
        $sql = "DELETE FROM cliente_contacto WHERE cliente_id = ? AND contacto_id = ?";
        return ejecutarConsulta($sql, [$cliente_id, $contacto_id]);
    }

    public function listarPorCliente($cliente_id)
    {
        $cliente_id = limpiarCadena($cliente_id);
        $sql = "SELECT cc.contacto_id, c.nombre, c.telefono, c.email
                  FROM cliente_contacto cc
             LEFT JOIN contacto c ON cc.contacto_id = c.id
                 WHERE cc.cliente_id = ?";
        return ejecutarConsulta($sql, [$cliente_id]);
    }

    public function listarPorContacto($contacto_id)
    {
        $contacto_id = limpiarCadena($contacto_id);
        $sql = "SELECT cc.cliente_id, cl.razon_social
                  FROM cliente_contacto cc
             LEFT JOIN cliente cl ON cc.cliente_id = cl.id
                 WHERE cc.contacto_id = ?";
        return ejecutarConsulta($sql, [$contacto_id]);
    }
}
