<?php
require_once __DIR__ . '/../modelos/EquipoTipo.php';
header('Content-Type: application/json; charset=utf-8');

$tip = new EquipoTipo();
$id     = isset($_POST['id'])     ? limpiarCadena($_POST['id'])     : '';
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : '';

switch ($_GET['op']) {
    case 'guardar':
        if (empty($id)) {
            $ok  = $tip->insertar($nombre);
            $msg = $ok ? 'Tipo de equipo registrado correctamente' : 'Error al registrar tipo de equipo';
        } else {
            $ok  = $tip->editar($id, $nombre);
            $msg = $ok ? 'Tipo de equipo actualizado correctamente' : 'Error al actualizar tipo de equipo';
        }
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'desactivar':
        $ok  = $tip->desactivar($id);
        $msg = $ok ? 'Tipo de equipo desactivado' : 'Error al desactivar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'activar':
        $ok  = $tip->activar($id);
        $msg = $ok ? 'Tipo de equipo activado' : 'Error al activar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'mostrar':
        echo json_encode($tip->mostrar($id));
        break;

    case 'listar':
        $rspta = $tip->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $acciones = '<button class="btn btn-sm btn-primary editar" data-id="'.$reg->id.'">
                             <i class="fa fa-edit"></i>
                         </button> ';
            if ($reg->is_active) {
                $acciones .= '<button class="btn btn-sm btn-warning desactivar" data-id="'.$reg->id.'">
                                  <i class="fa fa-times-circle"></i>
                              </button>';
                $estado = '<span class="badge badge-success">Activo</span>';
            } else {
                $acciones .= '<button class="btn btn-sm btn-success activar" data-id="'.$reg->id.'">
                                  <i class="fa fa-check-circle"></i>
                              </button>';
                $estado = '<span class="badge badge-secondary">Inactivo</span>';
            }
            $data[] = [
                "0" => $reg->id,
                "1" => htmlspecialchars($reg->nombre),
                "2" => $estado,
                "3" => $acciones
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $tip->select();
        echo '<option value="">-- Seleccione tipo --</option>';
        while ($reg = $rspta->fetch_object()) {
            echo '<option value="'.$reg->id.'">'.$reg->nombre.'</option>';
        }
        break;
}
