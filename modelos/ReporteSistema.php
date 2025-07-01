<?php
require_once __DIR__ . '/../config/Conexion.php';

class ReporteSistema
{
    private $map = [
        'cliente'    => ['tabla' => 'cliente', 'columna' => 'fecha_registro'],
        'proveedor'  => ['tabla' => 'proveedor', 'columna' => 'fecha_registro'],
        'articulo'   => ['tabla' => 'articulo', 'columna' => 'created_at'],
        'movimiento' => ['tabla' => 'almacen_movimiento', 'columna' => 'fecha'],
        'usuario'    => ['tabla' => 'usuario', 'columna' => 'created_at'],
    ];

    /**
     * Obtiene el conteo diario de registros para un módulo.
     * @return array|false
     */
    public function estadisticas(string $modulo, string $inicio, string $fin)
    {
        if (!isset($this->map[$modulo])) {
            return [];
        }
        $tabla = $this->map[$modulo]['tabla'];
        $col   = $this->map[$modulo]['columna'];
        $sql = "SELECT DATE($col) AS fecha, COUNT(*) AS total
                  FROM $tabla
                 WHERE $col BETWEEN ? AND ?
              GROUP BY DATE($col)
              ORDER BY DATE($col)";
        return ejecutarConsultaArray($sql, ["$inicio 00:00:00", "$fin 23:59:59"]);
    }
}
