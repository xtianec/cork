<?php
require_once __DIR__ . '/../config/Conexion.php';
// Corregimos la ruta al modelo (el archivo real es PlantillaRepuestos.php)
require_once __DIR__ . '/../modelos/PlantillaRepuestos.php';
header('Content-Type: application/json; charset=utf-8');

$pr = new PlantillaRepuesto();

$id               = isset($_POST['id'])               ? limpiarCadena($_POST['id'])               : '';
$plantilla_id     = isset($_POST['plantilla_id'])     ? limpiarCadena($_POST['plantilla_id'])     : '';
$articulo_id      = isset($_POST['articulo_id'])      ? limpiarCadena($_POST['articulo_id'])      : '';
$cantidad         = isset($_POST['cantidad'])         ? limpiarCadena($_POST['cantidad'])         : '';
$stock_actual     = isset($_POST['stock_actual'])     ? limpiarCadena($_POST['stock_actual'])     : '';
$orden            = isset($_POST['orden'])            ? limpiarCadena($_POST['orden'])            : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $pr->insertar($plantilla_id, $articulo_id, $cantidad, $stock_actual, $orden);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Repuesto asignado a plantilla' : 'Error al asignar repuesto']);
        break;

    case 'mostrar':
        $rspta = $pr->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $pr->listar($plantilla_id);
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->articulo_name),
                $reg->cantidad,
                $reg->stock_actual,
                $reg->orden
            ];
        }
        echo json_encode(["data" => $data]);
        break;
}
