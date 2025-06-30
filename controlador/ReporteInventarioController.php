<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelos/ReporteInventario.php';
$rep = new ReporteInventario();

$op = $_GET['op'] ?? '';

switch ($op) {
    case 'listar':
        $rs = $rep->listar();
        if ($rs === false || !($rs instanceof mysqli_result)) {
            logError('Error al listar inventario');
            http_response_code(500);
            echo json_encode(['data' => []]);
            break;
        }
        $data = [];
        while ($row = $rs->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode(['data' => $data]);
        break;
    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'msg' => 'Operación desconocida']);
}

