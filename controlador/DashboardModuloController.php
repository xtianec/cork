<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once '../modelos/Dashboard.php';
$dash = new Dashboard();

$op = $_GET['op'] ?? '';

switch ($op) {
    case 'inventario':
        $tablas = [
            'articulos'   => 'articulo',
            'movimientos' => 'almacen_movimiento',
            'marcas'      => 'marca',
            'lineas'      => 'linea'
        ];
        echo json_encode($dash->resumenPorTablas($tablas));
        break;

    case 'seguridad':
        $tablas = [
            'usuarios' => 'usuario',
            'roles'    => 'rol',
            'permisos' => 'permiso',
            'modulos'  => 'modulo'
        ];
        echo json_encode($dash->resumenPorTablas($tablas));
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'msg' => 'Operación desconocida']);
}
