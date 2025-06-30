<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Sublinea.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new Sublinea();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok  = $mc->insertar($_POST['linea_id'] ?? 0, $_POST['descripcion'] ?? $_POST['nombre'] ?? '');
        $msg = $ok ? 'Sub-línea registrada correctamente' : 'Error al registrar sub-línea';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'editar':
        $ok  = $mc->editar(
            $_POST['id'] ?? 0,
            $_POST['linea_id'] ?? 0,
            $_POST['descripcion'] ?? $_POST['nombre'] ?? ''
        );
        $msg = $ok ? 'Sub-línea actualizada correctamente' : 'Error al actualizar sub-línea';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'desactivar':
        $ok  = $mc->desactivar($_POST['id'] ?? 0);
        $msg = $ok ? 'Sub-línea desactivada' : 'Error al desactivar sub-línea';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'activar':
        $ok  = $mc->activar($_POST['id'] ?? 0);
        $msg = $ok ? 'Sub-línea activada' : 'Error al activar sub-línea';
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
                htmlspecialchars($r->linea_nombre),
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
        // opcionalmente filtras por línea_id si viene por GET
        if (!empty($_GET['linea_id'])) {
            $rs = $mc->select($_GET['linea_id']);
        } else {
            $rs = $mc->select();
        }
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->nombre) . '</option>';
        }
        exit;

    default:
        echo json_encode(['data' => []]);
        break;
}
