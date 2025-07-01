<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/EvaluacionProveedor.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new EvaluacionProveedor();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok  = $mc->insertar($_POST);
        $msg = $ok ? 'Evaluación registrada correctamente' : 'Error al registrar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'editar':
        $ok  = $mc->editar($_POST);
        $msg = $ok ? 'Evaluación actualizada' : 'Error al actualizar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'desactivar':
        $ok  = $mc->desactivar((int)($_POST['id'] ?? 0));
        $msg = $ok ? 'Registro desactivado' : 'Error al desactivar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'activar':
        $ok  = $mc->activar((int)($_POST['id'] ?? 0));
        $msg = $ok ? 'Registro activado' : 'Error al activar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'mostrar':
        echo json_encode($mc->mostrar((int)($_POST['id'] ?? 0)));
        break;

    case 'listar':
        $rs   = $mc->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $estado = $r->is_active
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';
            $botones = $r->is_active
                ? '<button class="btn btn-sm btn-primary btn-edit" data-id="'.$r->id.'"><i class="fa fa-edit"></i></button> '
                  .'<button class="btn btn-sm btn-danger btn-deactivate" data-id="'.$r->id.'"><i class="fa fa-trash"></i></button>'
                : '<button class="btn btn-sm btn-success btn-activate" data-id="'.$r->id.'"><i class="fa fa-check"></i></button>';
            $data[] = [
                $r->id,
                htmlspecialchars($r->proveedor),
                $r->fecha,
                $r->calificacion,
                htmlspecialchars($r->comentarios),
                $estado,
                $botones
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    default:
        echo json_encode(['data' => []]);
        break;
}
