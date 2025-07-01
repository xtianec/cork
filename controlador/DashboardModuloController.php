<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelos/Dashboard.php';
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

    case 'articulos_marca':
        echo json_encode($dash->articulosPorMarca());
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'msg' => 'Operación desconocida']);
}
