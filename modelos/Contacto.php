<?php
require_once __DIR__ . '/../config/Conexion.php';

class Contacto
{
    public function insertar($nombre, $cargo, $telefono, $email)
    {
        $nombre   = limpiarCadena($nombre);
        $cargo    = limpiarCadena($cargo);
        $telefono = limpiarCadena($telefono);
        $email    = limpiarCadena($email);

        $sql = "INSERT INTO contacto (nombre, cargo, telefono, email)
                VALUES (?,?,?,?)";
        return ejecutarConsulta($sql, [
            $nombre, $cargo, $telefono, $email
        ]);
    }

    public function editar($id, $nombre, $cargo, $telefono, $email)
    {
        $id       = limpiarCadena($id);
        $nombre   = limpiarCadena($nombre);
        $cargo    = limpiarCadena($cargo);
        $telefono = limpiarCadena($telefono);
        $email    = limpiarCadena($email);

        $sql = "UPDATE contacto SET
                    nombre   = ?,
                    cargo    = ?,
                    telefono = ?,
                    email    = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $nombre, $cargo, $telefono, $email, $id
        ]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE contacto SET is_active = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE contacto SET is_active = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM contacto WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM contacto ORDER BY nombre";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, nombre FROM contacto WHERE is_active = 1";
        return ejecutarConsulta($sql);
    }
}
