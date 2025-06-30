<?php
require_once __DIR__ . '/../config/Conexion.php';

class Sublinea
{
    public function insertar($linea_id, $nombre)
    {
        $linea_id = limpiarCadena($linea_id);
        $nombre   = limpiarCadena($nombre);
        $sql = "INSERT INTO sublinea
                   (linea_id, nombre, created_at, updated_at, is_active)
                VALUES (?, ?, NOW(), NOW(), 1)";
        return ejecutarConsulta($sql, [$linea_id, $nombre]);
    }

    public function editar($id, $linea_id, $nombre)
    {
        $id       = limpiarCadena($id);
        $linea_id = limpiarCadena($linea_id);
        $nombre   = limpiarCadena($nombre);
        $sql = "UPDATE sublinea
                   SET linea_id   = ?,
                       nombre      = ?,
                       updated_at  = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$linea_id, $nombre, $id]);
    }

    public function desactivar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE sublinea
                   SET is_active  = 0,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function activar($id)
    {
        $id = limpiarCadena($id);
        $sql = "UPDATE sublinea
                   SET is_active  = 1,
                       updated_at = NOW()
                 WHERE id = ?";
        return ejecutarConsulta($sql, [$id]);
    }

    public function mostrar($id)
    {
        $id = limpiarCadena($id);
        $sql = "SELECT id, linea_id, nombre, is_active
                  FROM sublinea WHERE id = ?";
        return ejecutarConsultaSimpleFila($sql, [$id]);
    }

    public function listar()
    {
        $sql = "SELECT
                    s.id,
                    s.nombre,
                    l.nombre AS linea_nombre,
                    DATE_FORMAT(s.created_at,'%Y-%m-%d %H:%i') AS created_at,
                    DATE_FORMAT(s.updated_at,'%Y-%m-%d %H:%i') AS updated_at,
                    s.is_active
                  FROM sublinea s
             INNER JOIN linea    l ON l.id = s.linea_id
                 ORDER BY l.nombre, s.nombre";
        return ejecutarConsulta($sql);
    }

    public function select($linea_id = null)
    {
        if ($linea_id) {
            $sql = "SELECT id, nombre
                FROM sublinea
               WHERE linea_id  = ? 
                 AND is_active = 1
            ORDER BY nombre";
            return ejecutarConsulta($sql, [limpiarCadena($linea_id)]);
        }
        $sql = "SELECT id, nombre
              FROM sublinea
             WHERE is_active = 1
          ORDER BY nombre";
        return ejecutarConsulta($sql);
    }
}
