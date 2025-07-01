<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Proyecto.php';
header('Content-Type: application/json; charset=utf-8');

$proy = new Proyecto();
$op   = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok  = $proy->insertar(
            $_POST['nombre'] ?? '',
            $_POST['descripcion'] ?? '',
            $_POST['fecha_inicio'] ?? null,
            $_POST['fecha_fin'] ?? null
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Proyecto registrado' : 'Error al registrar']);
        break;

    case 'editar':
        $ok  = $proy->editar(
            $_POST['id'] ?? 0,
            $_POST['nombre'] ?? '',
            $_POST['descripcion'] ?? '',
            $_POST['fecha_inicio'] ?? null,
            $_POST['fecha_fin'] ?? null
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Proyecto actualizado' : 'Error al actualizar']);
        break;

    case 'desactivar':
        $ok = $proy->desactivar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'activar':
        $ok = $proy->activar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'mostrar':
        echo json_encode($proy->mostrar($_POST['id'] ?? 0));
        break;

    case 'listar':
        $rs   = $proy->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $estado = $r->is_active
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';
            $botones = $r->is_active
                ? '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $r->id . '"><i class="fa fa-edit"></i></button> '
                  . '<button class="btn btn-sm btn-danger btn-deactivate" data-id="' . $r->id . '"><i class="fa fa-trash"></i></button>'
                : '<button class="btn btn-sm btn-success btn-activate" data-id="' . $r->id . '"><i class="fa fa-check"></i></button>';
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
        $rs = $proy->select();
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->nombre) . '</option>';
        }
        exit;

    default:
        echo json_encode(['data' => []]);
        break;
}
