<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Cargo.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new Cargo();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok  = $mc->insertar($_POST['nombre'] ?? '');
        $msg = $ok ? 'Cargo registrado correctamente' : 'Error al registrar cargo';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'editar':
        $ok  = $mc->editar($_POST['id'] ?? 0, $_POST['nombre'] ?? '');
        $msg = $ok ? 'Cargo actualizado correctamente' : 'Error al actualizar cargo';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'desactivar':
        $ok  = $mc->desactivar($_POST['id'] ?? 0);
        $msg = $ok ? 'Cargo desactivado' : 'Error al desactivar cargo';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'activar':
        $ok  = $mc->activar($_POST['id'] ?? 0);
        $msg = $ok ? 'Cargo activado' : 'Error al activar cargo';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'mostrar':
        echo json_encode($mc->mostrar($_POST['id'] ?? 0));
        break;

    case 'listar':
        $rs   = $mc->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $estado = $r->is_active
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';
            $botones = $r->is_active
                ? '<button class="btn btn-sm btn-primary btn-edit"      data-id="' . $r->id . '"><i class="fa fa-edit"></i></button> '
                . '<button class="btn btn-sm btn-danger  btn-deactivate" data-id="' . $r->id . '"><i class="fa fa-trash"></i></button>'
                : '<button class="btn btn-sm btn-success btn-activate"  data-id="' . $r->id . '"><i class="fa fa-check"></i></button>';
            $data[] = [
                $r->id,
                htmlspecialchars($r->nombre),
                $r->created_at,
                $r->updated_at,
                $estado,
                $botones
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    case 'select':
        header('Content-Type: text/html; charset=utf-8');
        $rs = $mc->select();
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->nombre) . '</option>';
        }
        exit;

    default:
        echo json_encode(['data' => []]);
        break;
}
