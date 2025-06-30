<?php
require_once __DIR__.'/../config/Conexion.php';

class Dashboard
{
    public function resumen(): array
    {
        $tablas = [
            'clientes'    => 'cliente',
            'proveedores' => 'proveedor',
            'articulos'   => 'articulo',
            'usuarios'    => 'usuario'
        ];

        $data = [];
        foreach ($tablas as $key => $tbl) {
            $row = ejecutarConsultaSimpleFila("SELECT COUNT(*) AS total FROM $tbl");
            $data[$key] = (int)($row['total'] ?? 0);
        }
        return $data;
    }

    /**
     * Devuelve el conteo de registros para las tablas indicadas.
     * @param array $tablas Arreglo asociativo nombre=>tabla
     */
    public function resumenPorTablas(array $tablas): array
    {
        $data = [];
        foreach ($tablas as $key => $tbl) {
            $row = ejecutarConsultaSimpleFila("SELECT COUNT(*) AS total FROM $tbl");
            $data[$key] = (int)($row['total'] ?? 0);
        }
        return $data;
    }

    /**
     * Cantidad de usuarios asignados a cada rol
     */
    public function usuariosPorRol(): array
    {
        $sql = "SELECT r.nombre AS rol, COUNT(u.id) AS total
                  FROM rol r
             LEFT JOIN usuario_rol ur ON ur.rol_id=r.id
             LEFT JOIN usuario u ON u.id=ur.usuario_id
              GROUP BY r.id
              ORDER BY r.nombre";
        return ejecutarConsultaArray($sql) ?: [];
    }
}
