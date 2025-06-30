<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Notificacion.php';
header('Content-Type: application/json; charset=utf-8');

$not = new Notificacion();

$id             = isset($_POST['id'])            ? limpiarCadena($_POST['id'])            : '';
$programacion_id= isset($_POST['programacion_id'])? limpiarCadena($_POST['programacion_id']): '';
$enviado_at     = isset($_POST['enviado_at'])    ? limpiarCadena($_POST['enviado_at'])    : '';
$medio          = isset($_POST['medio'])         ? limpiarCadena($_POST['medio'])         : '';
$resultado      = isset($_POST['resultado'])     ? limpiarCadena($_POST['resultado'])     : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $not->insertar($programacion_id, $enviado_at, $medio, $resultado);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Notificación registrada correctamente' : 'Error al registrar notificación']);
        break;

    case 'listar':
        $rspta = $not->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->equipo_code),
                $reg->enviado_at,
                htmlspecialchars($reg->medio),
                htmlspecialchars($reg->resultado)
            ];
        }
        echo json_encode(["data" => $data]);
        break;
}
