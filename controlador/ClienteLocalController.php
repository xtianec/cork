<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/ClienteLocal.php';
header('Content-Type: application/json; charset=utf-8');

$cl = new ClienteLocal();

$id          = isset($_POST['id'])           ? limpiarCadena($_POST['id'])           : '';
$cliente_id  = isset($_POST['cliente_id'])   ? limpiarCadena($_POST['cliente_id'])   : '';
$nombre      = isset($_POST['nombre'])       ? limpiarCadena($_POST['nombre'])       : '';
$direccion   = isset($_POST['direccion'])    ? limpiarCadena($_POST['direccion'])    : '';
$ciudad      = isset($_POST['ciudad'])       ? limpiarCadena($_POST['ciudad'])       : '';
$departamento= isset($_POST['departamento']) ? limpiarCadena($_POST['departamento']) : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $cl->insertar($cliente_id, $nombre, $direccion, $ciudad, $departamento);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Planta registrada correctamente' : 'Error al registrar planta']);
        break;

    case 'editar':
        $rspta = $cl->editar($id, $cliente_id, $nombre, $direccion, $ciudad, $departamento);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Planta actualizada correctamente' : 'Error al actualizar planta']);
        break;

    case 'mostrar':
        $rspta = $cl->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $cl->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->cliente_name),
                htmlspecialchars($reg->nombre),
                htmlspecialchars($reg->ciudad),
                htmlspecialchars($reg->departamento)
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $cl->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">{$reg->nombre}</option>";
        }
        break;
}
