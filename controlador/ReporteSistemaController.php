<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelos/ReporteSistema.php';
$rep = new ReporteSistema();

$op = $_GET['op'] ?? '';

switch ($op) {
    case 'estadisticas':
        $mod = $_GET['mod']    ?? '';
        $ini = $_GET['inicio'] ?? '';
        $fin = $_GET['fin']    ?? '';
        if ($mod === '' || $ini === '' || $fin === '') {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'msg' => 'Par\u00e1metros incompletos']);
            break;
        }
        $data = $rep->estadisticas($mod, $ini, $fin);
        if ($data === false) {
            logError('Error al obtener estad\u00edsticas de ' . $mod);
            http_response_code(500);
            echo json_encode(['status' => 'error']);
            break;
        }
        echo json_encode(['data' => $data]);
        break;
    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'msg' => 'Operaci\u00f3n desconocida']);
}
