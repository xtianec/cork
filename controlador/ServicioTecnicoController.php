<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/ServicioTecnico.php';
header('Content-Type: application/json; charset=utf-8');

$st = new ServicioTecnico();

$id               = isset($_POST['id'])            ? limpiarCadena($_POST['id'])            : '';
$equipo_id        = isset($_POST['equipo_id'])     ? limpiarCadena($_POST['equipo_id'])     : '';
$programacion_id  = isset($_POST['programacion_id'])? limpiarCadena($_POST['programacion_id']): null;
$fecha_servicio   = isset($_POST['fecha_servicio'])? limpiarCadena($_POST['fecha_servicio']): '';
$horometro        = isset($_POST['horometro'])     ? limpiarCadena($_POST['horometro'])     : '';
$horas_trabajadas = isset($_POST['horas_trabajadas'])? limpiarCadena($_POST['horas_trabajadas']): '';
$notas            = isset($_POST['notas'])         ? limpiarCadena($_POST['notas'])         : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $st->insertar(
            $equipo_id, $programacion_id,
            $fecha_servicio, $horometro,
            $horas_trabajadas, $notas
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Servicio registrado correctamente' : 'Error al registrar servicio']);
        break;

    case 'mostrar':
        $rspta = $st->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $st->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->equipo_code),
                $reg->fecha_servicio,
                $reg->horas_trabajadas,
                htmlspecialchars($reg->notas)
            ];
        }
        echo json_encode(["data" => $data]);
        break;
}
