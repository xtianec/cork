<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Equipo.php';
header('Content-Type: application/json; charset=utf-8');

$equ = new Equipo();

$id                = isset($_POST['id'])               ? limpiarCadena($_POST['id'])               : '';
$cliente_local_id  = isset($_POST['cliente_local_id']) ? limpiarCadena($_POST['cliente_local_id']) : '';
$tipo_id           = isset($_POST['tipo_id'])          ? limpiarCadena($_POST['tipo_id'])          : '';
$marca_id          = isset($_POST['marca_id'])         ? limpiarCadena($_POST['marca_id'])         : '';
$modelo_id         = isset($_POST['modelo_id'])        ? limpiarCadena($_POST['modelo_id'])        : '';
$serie             = isset($_POST['serie'])            ? limpiarCadena($_POST['serie'])            : '';
$referencia        = isset($_POST['referencia'])       ? limpiarCadena($_POST['referencia'])       : '';
$ubicacion         = isset($_POST['ubicacion'])        ? limpiarCadena($_POST['ubicacion'])        : '';
$fecha_adquisicion = isset($_POST['fecha_adquisicion'])? limpiarCadena($_POST['fecha_adquisicion']): null;
$estado_id         = isset($_POST['estado_id'])        ? limpiarCadena($_POST['estado_id'])        : '';
$horometro_actual  = isset($_POST['horometro_actual']) ? limpiarCadena($_POST['horometro_actual']) : 0;

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $equ->insertar(
            $cliente_local_id, $tipo_id, $marca_id,
            $modelo_id, $serie, $referencia,
            $ubicacion, $fecha_adquisicion,
            $estado_id, $horometro_actual
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Equipo registrado correctamente' : 'Error al registrar equipo']);
        break;

    case 'editar':
        $rspta = $equ->editar(
            $id,
            $cliente_local_id, $tipo_id, $marca_id,
            $modelo_id, $serie, $referencia,
            $ubicacion, $fecha_adquisicion,
            $estado_id, $horometro_actual
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Equipo actualizado correctamente' : 'Error al actualizar equipo']);
        break;

    case 'mostrar':
        $rspta = $equ->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $equ->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->serie),
                htmlspecialchars($reg->marca),
                htmlspecialchars($reg->modelo),
                htmlspecialchars($reg->ubicacion),
                $reg->estado_descripcion
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $equ->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">{$reg->serie} - {$reg->marca} {$reg->modelo}</option>";
        }
        break;
}
