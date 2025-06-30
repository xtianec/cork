<?php
require_once __DIR__ . '/../config/Conexion.php';

class ReporteInventario
{
    public function listar()
    {
        $sql = "SELECT
                COALESCE(l.nombre ,'-') AS linea,
                COALESCE(sl.nombre,'-') AS sublinea,
                COALESCE(m.nombre ,'-') AS marca,
                CONCAT(a.codigo,' - ',a.nombre) AS articulo,
                a.stock_actual
            FROM articulo a
            LEFT JOIN linea     l  ON l.id  = a.linea_id
            LEFT JOIN sublinea  sl ON sl.id = a.sublinea_id
            LEFT JOIN marca     m  ON m.id  = a.marca_id
            ORDER BY l.nombre, sl.nombre, m.nombre, a.nombre";

        return ejecutarConsulta($sql);
    }
}

