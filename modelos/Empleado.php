<?php
require_once __DIR__ . '/../config/Conexion.php';

class Empleado
{
    public function insertar($nombre, $apellido, $dni, $email, $telefono, $cargo_id, $fecha_ingreso)
    {
        $sql = "INSERT INTO empleado
                    (nombre, apellido, dni, email, telefono, cargo_id, fecha_ingreso, created_at, updated_at, is_active)
                VALUES (?,?,?,?,?,?,?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($apellido),
            limpiarCadena($dni),
            limpiarCadena($email),
            limpiarCadena($telefono),
            limpiarCadena($cargo_id),
            limpiarCadena($fecha_ingreso)
        ]);
    }

    public function editar($id, $nombre, $apellido, $dni, $email, $telefono, $cargo_id, $fecha_ingreso)
    {
        $sql = "UPDATE empleado SET
                    nombre = ?,
                    apellido = ?,
                    dni = ?,
                    email = ?,
                    telefono = ?,
                    cargo_id = ?,
                    fecha_ingreso = ?,
                    updated_at = NOW()
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($nombre),
            limpiarCadena($apellido),
            limpiarCadena($dni),
            limpiarCadena($email),
            limpiarCadena($telefono),
            limpiarCadena($cargo_id),
            limpiarCadena($fecha_ingreso),
            limpiarCadena($id)
        ]);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE empleado SET is_active = 0, updated_at = NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function activar($id)
    {
        $sql = "UPDATE empleado SET is_active = 1, updated_at = NOW() WHERE id = ?";
        return ejecutarConsulta($sql, [limpiarCadena($id)]);
    }

    public function mostrar($id)
    {
        $sql = "SELECT * FROM empleado WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [limpiarCadena($id)]);
    }

    public function listar()
    {
        $sql = "SELECT e.id,
                       e.nombre,
                       e.apellido,
                       e.dni,
                       e.email,
                       e.telefono,
                       c.nombre AS cargo,
                       DATE_FORMAT(e.created_at, '%Y-%m-%d %H:%i') AS created_at,
                       DATE_FORMAT(e.updated_at, '%Y-%m-%d %H:%i') AS updated_at,
                       e.is_active
                  FROM empleado e
             LEFT JOIN cargo c ON c.id = e.cargo_id
              ORDER BY e.nombre";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombre
                  FROM empleado
                 WHERE is_active = 1
              ORDER BY nombre";
        return ejecutarConsulta($sql);
    }
}
