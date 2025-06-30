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
}
