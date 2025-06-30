<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/ProgramacionServiciosTecnicos.php';
header('Content-Type: application/json; charset=utf-8');

$pst = new ProgramacionServiciosTecnicos();

$id               = isset($_POST['id'])               ? limpiarCadena($_POST['id'])               : '';
$equipo_id        = isset($_POST['equipo_id'])        ? limpiarCadena($_POST['equipo_id'])        : '';
$tipo_servicio_id = isset($_POST['tipo_servicio_id']) ? limpiarCadena($_POST['tipo_servicio_id']) : '';
$frecuencia_horas = isset($_POST['frecuencia_horas']) ? limpiarCadena($_POST['frecuencia_horas']) : '';
$fecha_ultimo     = isset($_POST['fecha_ultimo'])     ? limpiarCadena($_POST['fecha_ultimo'])     : null;
$horas_ultimo     = isset($_POST['horas_ultimo'])     ? limpiarCadena($_POST['horas_ultimo'])     : null;
$fecha_proximo    = isset($_POST['fecha_proximo'])    ? limpiarCadena($_POST['fecha_proximo'])    : null;
$horas_proximo    = isset($_POST['horas_proximo'])    ? limpiarCadena($_POST['horas_proximo'])    : null;
$notificar        = isset($_POST['notificar'])        ? limpiarCadena($_POST['notificar'])        : 0;

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $pst->insertar(
            $equipo_id, $tipo_servicio_id,
            $frecuencia_horas, $fecha_ultimo,
            $horas_ultimo, $fecha_proximo,
            $horas_proximo, $notificar
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Programación registrada correctamente' : 'Error al registrar programación']);
        break;

    case 'editar':
        $rspta = $pst->editar(
            $id,
            $equipo_id, $tipo_servicio_id,
            $frecuencia_horas, $fecha_ultimo,
            $horas_ultimo, $fecha_proximo,
            $horas_proximo, $notificar
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Programación actualizada correctamente' : 'Error al actualizar programación']);
        break;

    case 'mostrar':
        $rspta = $pst->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $pst->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->equipo_code),
                htmlspecialchars($reg->servicio_name),
                $reg->frecuencia_horas,
                $reg->fecha_ultimo,
                $reg->fecha_proximo,
                $reg->notificar ? 'Sí' : 'No'
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $pst->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">{$reg->equipo_code} - {$reg->servicio_name}</option>";
        }
        break;
}
