<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PlantillaRepuestoHora.php';
header('Content-Type: application/json; charset=utf-8');

$prh = new PlantillaRepuestoHora();

$id                    = isset($_POST['id'])                    ? limpiarCadena($_POST['id'])                    : '';
$plantilla_repuesto_id = isset($_POST['plantilla_repuesto_id']) ? limpiarCadena($_POST['plantilla_repuesto_id']) : '';
$horas_id              = isset($_POST['horas_id'])              ? limpiarCadena($_POST['horas_id'])              : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $prh->insertar($plantilla_repuesto_id, $horas_id);
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Hora asignada al repuesto' : 'Error al asignar hora']);
        break;

    case 'listar':
        // Usamos el método existente listarPorRepuesto
        $rspta = $prh->listarPorRepuesto($plantilla_repuesto_id);
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                $reg->horas
            ];
        }
        echo json_encode(["data" => $data]);
        break;
}
