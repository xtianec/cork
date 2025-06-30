<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/CondicionPago.php';
header('Content-Type: application/json; charset=utf-8');

$cp = new CondicionPago();

$id            = isset($_POST['id'])            ? limpiarCadena($_POST['id'])            : '';
$descripcion   = isset($_POST['descripcion'])   ? limpiarCadena($_POST['descripcion'])   : '';
$dias_credito  = isset($_POST['dias_credito'])  ? limpiarCadena($_POST['dias_credito'])  : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $cp->insertar($descripcion, $dias_credito);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Condición de pago registrada correctamente' : 'Error al registrar condición de pago']);
        break;

    case 'editar':
        $rspta = $cp->editar($id, $descripcion, $dias_credito);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Condición de pago actualizada correctamente' : 'Error al actualizar condición de pago']);
        break;

    case 'mostrar':
        $rspta = $cp->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $cp->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => $reg->condicion_pago_id,
                "1" => htmlspecialchars($reg->descripcion),
                "2" => $reg->dias_credito
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $cp->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">{$reg->descripcion}</option>";
        }
        break;
}
