<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Plantilla.php';
header('Content-Type: application/json; charset=utf-8');

$pl = new Plantilla();

$id          = isset($_POST['id'])          ? limpiarCadena($_POST['id'])          : '';
$codigo      = isset($_POST['codigo'])      ? limpiarCadena($_POST['codigo'])      : '';
$marca_id    = isset($_POST['marca_id'])    ? limpiarCadena($_POST['marca_id'])    : '';
$modelo_id   = isset($_POST['modelo_id'])   ? limpiarCadena($_POST['modelo_id'])   : '';
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $pl->insertar($codigo, $marca_id, $modelo_id, $descripcion);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Plantilla creada correctamente' : 'Error al crear plantilla']);
        break;

    case 'editar':
        $rspta = $pl->editar($id, $codigo, $marca_id, $modelo_id, $descripcion);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Plantilla actualizada correctamente' : 'Error al actualizar plantilla']);
        break;

    case 'mostrar':
        $rspta = $pl->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $pl->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->codigo),
                htmlspecialchars($reg->marca),
                htmlspecialchars($reg->modelo)
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $pl->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">{$reg->codigo} - {$reg->marca} {$reg->modelo}</option>";
        }
        break;
}
