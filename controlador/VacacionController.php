<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Vacacion.php';
require_once __DIR__ . '/../modelos/Empleado.php';
header('Content-Type: application/json; charset=utf-8');

$vac = new Vacacion();
$empleado = new Empleado();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $vac->insertar(
            $_POST['empleado_id'] ?? 0,
            $_POST['fecha_inicio'] ?? '',
            $_POST['fecha_fin'] ?? '',
            $_POST['dias'] ?? 0
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Registro guardado' : 'Error al guardar']);
        break;

    case 'editar':
        $ok = $vac->editar(
            $_POST['id'] ?? 0,
            $_POST['empleado_id'] ?? 0,
            $_POST['fecha_inicio'] ?? '',
            $_POST['fecha_fin'] ?? '',
            $_POST['dias'] ?? 0
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Registro actualizado' : 'Error al actualizar']);
        break;

    case 'desactivar':
        $ok = $vac->desactivar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'activar':
        $ok = $vac->activar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'mostrar':
        echo json_encode($vac->mostrar($_POST['id'] ?? 0));
        break;

    case 'listar':
        $rs   = $vac->listar();
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
                htmlspecialchars($r->empleado),
                $r->fecha_inicio,
                $r->fecha_fin,
                $r->dias,
                $r->created_at,
                $r->updated_at,
                $estado,
                $botones
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    case 'selectEmpleado':
        header('Content-Type: text/html; charset=utf-8');
        $rs = $empleado->select();
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->nombre) . '</option>';
        }
        exit;

    default:
        echo json_encode(['data' => []]);
        break;
}
?>
