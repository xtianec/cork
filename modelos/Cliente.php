<?php
// modelos/Cliente.php
require_once __DIR__ . '/../config/Conexion.php';

class Cliente
{
    public function insertar(array $d)
    {
        $sql = "INSERT INTO cliente (
                    ruc, razon_social, categoria_id, estado,
                    direccion_fiscal, direccion_planta,
                    departamento, provincia, distrito,
                    telefono_fijo, telefono_movil,
                    email, web,
                    contacto_responsable, cargo_contacto,
                    telefono_contacto, email_contacto
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return ejecutarConsulta($sql, [
            limpiarCadena($d['ruc']),
            limpiarCadena($d['razon_social']),
            limpiarCadena($d['categoria_id']),
            1,
            limpiarCadena($d['direccion_fiscal']     ?? ''),
            limpiarCadena($d['direccion_planta']     ?? ''),
            limpiarCadena($d['departamento']         ?? ''),
            limpiarCadena($d['provincia']            ?? ''),
            limpiarCadena($d['distrito']             ?? ''),
            limpiarCadena($d['telefono_fijo']        ?? ''),
            limpiarCadena($d['telefono_movil']       ?? ''),
            limpiarCadena($d['email']                ?? ''),
            limpiarCadena($d['web']                  ?? ''),
            limpiarCadena($d['contacto_responsable'] ?? ''),
            limpiarCadena($d['cargo_contacto']       ?? ''),
            limpiarCadena($d['telefono_contacto']    ?? ''),
            limpiarCadena($d['email_contacto']       ?? '')
        ]);
    }

    public function editar(array $d)
    {
        $sql = "UPDATE cliente SET
                    ruc                 = ?,
                    razon_social        = ?,
                    categoria_id        = ?,
                    estado              = ?,
                    direccion_fiscal    = ?,
                    direccion_planta    = ?,
                    departamento        = ?,
                    provincia           = ?,
                    distrito            = ?,
                    telefono_fijo       = ?,
                    telefono_movil      = ?,
                    email               = ?,
                    web                 = ?,
                    contacto_responsable= ?,
                    cargo_contacto      = ?,
                    telefono_contacto   = ?,
                    email_contacto      = ?
                WHERE id = ?";
        return ejecutarConsulta($sql, [
            limpiarCadena($d['ruc']),
            limpiarCadena($d['razon_social']),
            limpiarCadena($d['categoria_id']),
            limpiarCadena($d['estado']),
            limpiarCadena($d['direccion_fiscal']     ?? ''),
            limpiarCadena($d['direccion_planta']     ?? ''),
            limpiarCadena($d['departamento']         ?? ''),
            limpiarCadena($d['provincia']            ?? ''),
            limpiarCadena($d['distrito']             ?? ''),
            limpiarCadena($d['telefono_fijo']        ?? ''),
            limpiarCadena($d['telefono_movil']       ?? ''),
            limpiarCadena($d['email']                ?? ''),
            limpiarCadena($d['web']                  ?? ''),
            limpiarCadena($d['contacto_responsable'] ?? ''),
            limpiarCadena($d['cargo_contacto']       ?? ''),
            limpiarCadena($d['telefono_contacto']    ?? ''),
            limpiarCadena($d['email_contacto']       ?? ''),
            limpiarCadena($d['id'])
        ]);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta("UPDATE cliente SET estado=0 WHERE id=?", [$id]);
    }

    public function activar(int $id)
    {
        return ejecutarConsulta("UPDATE cliente SET estado=1 WHERE id=?", [$id]);
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila("SELECT * FROM cliente WHERE id=?", [$id]);
    }

    public function listar()
    {
        $sql = "
            SELECT
              c.id,
              c.ruc,
              c.razon_social,
              (SELECT nombre FROM categoria_cliente 
                 WHERE id=c.categoria_id AND is_active=1 LIMIT 1
              ) AS categoria,
              c.estado,
              DATE_FORMAT(c.fecha_registro,'%Y-%m-%d') AS fecha_registro
            FROM cliente c
            ORDER BY c.id DESC
        ";
        return ejecutarConsulta($sql, []);
    }
}
