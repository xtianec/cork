<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Empleado.php';
require_once __DIR__ . '/../modelos/Cargo.php';
header('Content-Type: application/json; charset=utf-8');

$emple = new Empleado();
$cargo = new Cargo();
$op    = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok  = $emple->insertar(
            $_POST['nombre'] ?? '',
            $_POST['apellido'] ?? '',
            $_POST['dni'] ?? '',
            $_POST['email'] ?? '',
            $_POST['telefono'] ?? '',
            $_POST['cargo_id'] ?? null,
            $_POST['fecha_ingreso'] ?? null
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Empleado registrado' : 'Error al registrar']);
        break;

    case 'editar':
        $ok  = $emple->editar(
            $_POST['id'] ?? 0,
            $_POST['nombre'] ?? '',
            $_POST['apellido'] ?? '',
            $_POST['dni'] ?? '',
            $_POST['email'] ?? '',
            $_POST['telefono'] ?? '',
            $_POST['cargo_id'] ?? null,
            $_POST['fecha_ingreso'] ?? null
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Empleado actualizado' : 'Error al actualizar']);
        break;

    case 'desactivar':
        $ok = $emple->desactivar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'activar':
        $ok = $emple->activar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'mostrar':
        echo json_encode($emple->mostrar($_POST['id'] ?? 0));
        break;

    case 'listar':
        $rs   = $emple->listar();
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
                htmlspecialchars($r->nombre . ' ' . $r->apellido),
                htmlspecialchars($r->dni),
                htmlspecialchars($r->cargo ?? ''),
                $r->created_at,
                $r->updated_at,
                $estado,
                $botones
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    case 'selectCargo':
        header('Content-Type: text/html; charset=utf-8');
        $rs = $cargo->select();
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->nombre) . '</option>';
        }
        exit;

    default:
        echo json_encode(['data' => []]);
        break;
}
