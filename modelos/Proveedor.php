<?php
require_once __DIR__ . '/../config/Conexion.php';

class Proveedor
{
    public function insertar($ruc, $razon_social, $categoria_id,
                             $direccion, $departamento,
                             $provincia, $distrito,
                             $telefono_fijo, $telefono_movil,
                             $email, $web,
                             $contacto_responsable, $cargo_contacto,
                             $telefono_contacto, $email_contacto)
    {
        $ruc                   = limpiarCadena($ruc);
        $razon_social          = limpiarCadena($razon_social);
        $categoria_id          = limpiarCadena($categoria_id);
        $direccion             = limpiarCadena($direccion);
        $departamento          = limpiarCadena($departamento);
        $provincia             = limpiarCadena($provincia);
        $distrito              = limpiarCadena($distrito);
        $telefono_fijo         = limpiarCadena($telefono_fijo);
        $telefono_movil        = limpiarCadena($telefono_movil);
        $email                 = limpiarCadena($email);
        $web                   = limpiarCadena($web);
        $contacto_responsable  = limpiarCadena($contacto_responsable);
        $cargo_contacto        = limpiarCadena($cargo_contacto);
        $telefono_contacto     = limpiarCadena($telefono_contacto);
        $email_contacto        = limpiarCadena($email_contacto);

        $sql = "INSERT INTO proveedor
                (ruc, razon_social, categoria_id,
                 direccion, departamento,
                 provincia, distrito,
                 telefono_fijo, telefono_movil,
                 email, web,
                 contacto_responsable, cargo_contacto,
                 telefono_contacto, email_contacto)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            $ruc, $razon_social, $categoria_id,
            $direccion, $departamento,
            $provincia, $distrito,
            $telefono_fijo, $telefono_movil,
            $email, $web,
            $contacto_responsable, $cargo_contacto,
            $telefono_contacto, $email_contacto
        ]);
    }

    public function editar($id, $ruc, $razon_social, $categoria_id,
                           $direccion, $departamento,
                           $provincia, $distrito,
                           $telefono_fijo, $telefono_movil,
                           $email, $web,
                           $contacto_responsable, $cargo_contacto,
                           $telefono_contacto, $email_contacto)
    {
        $id                    = limpiarCadena($id);
        $ruc                   = limpiarCadena($ruc);
        $razon_social          = limpiarCadena($razon_social);
        $categoria_id          = limpiarCadena($categoria_id);
        $direccion             = limpiarCadena($direccion);
        $departamento          = limpiarCadena($departamento);
        $provincia             = limpiarCadena($provincia);
        $distrito              = limpiarCadena($distrito);
        $telefono_fijo         = limpiarCadena($telefono_fijo);
        $telefono_movil        = limpiarCadena($telefono_movil);
        $email                 = limpiarCadena($email);
        $web                   = limpiarCadena($web);
        $contacto_responsable  = limpiarCadena($contacto_responsable);
        $cargo_contacto        = limpiarCadena($cargo_contacto);
        $telefono_contacto     = limpiarCadena($telefono_contacto);
        $email_contacto        = limpiarCadena($email_contacto);

        $sql = "UPDATE proveedor SET
                    ruc                   = ?,
                    razon_social          = ?,
                    categoria_id          = ?,
                    direccion             = ?,
                    departamento          = ?,
                    provincia             = ?,
                    distrito              = ?,
                    telefono_fijo         = ?,
                    telefono_movil        = ?,
                    email                 = ?,
                    web                   = ?,
                    contacto_responsable  = ?,
                    cargo_contacto        = ?,
                    telefono_contacto     = ?,
                    email_contacto        = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            $ruc, $razon_social, $categoria_id,
            $direccion, $departamento,
            $provincia, $distrito,
            $telefono_fijo, $telefono_movil,
            $email, $web,
            $contacto_responsable, $cargo_contacto,
            $telefono_contacto, $email_contacto,
            $id
        ]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE proveedor SET estado = 0 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE proveedor SET estado = 1 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT * FROM proveedor WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT * FROM proveedor ORDER BY razon_social";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql = "SELECT id, razon_social FROM proveedor WHERE estado = 1";
        return ejecutarConsulta($sql);
    }
}
