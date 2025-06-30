<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once '../modelos/Dashboard.php';
$dash = new Dashboard();

$op = $_GET['op'] ?? '';

switch ($op) {
    case 'resumen':
        echo json_encode($dash->resumen());
        break;
    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'msg' => 'Operación desconocida']);
}
