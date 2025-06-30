<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/ClienteContacto.php';
header('Content-Type: application/json; charset=utf-8');

$cc = new ClienteContacto();

$cliente_id  = isset($_POST['cliente_id'])  ? limpiarCadena($_POST['cliente_id'])  : '';
$contacto_id = isset($_POST['contacto_id']) ? limpiarCadena($_POST['contacto_id']) : '';

switch ($_GET['op']) {
    case 'asignar':
        $rspta = $cc->asignar($cliente_id, $contacto_id);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Contacto asignado al cliente' : 'Error al asignar contacto']);
        break;

    case 'desasignar':
        $rspta = $cc->desasignar($cliente_id, $contacto_id);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Contacto desasignado del cliente' : 'Error al desasignar contacto']);
        break;

    case 'listar':
        $rspta = $cc->listarPorCliente($cliente_id);
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->contacto_id,
                htmlspecialchars($reg->nombre),
                htmlspecialchars($reg->telefono),
                '<button class="btn btn-danger btn-xs" onclick="desasignarContacto('
                  . $cliente_id . ',' . $reg->contacto_id
                  . ')"><i class="fa fa-trash"></i></button>'
            ];
        }
        echo json_encode(["data" => $data]);
        break;
}
