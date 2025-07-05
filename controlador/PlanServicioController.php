<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PlanServicio.php';

header('Content-Type: application/json; charset=utf-8');

$plan = new PlanServicio();
$op   = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $plan->insertar($_POST['plan_desc'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Plan registrado correctamente' : 'Error al registrar plan'
        ]);
        break;

    case 'editar':
        $ok = $plan->editar($_POST['id'] ?? '', $_POST['plan_desc'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Plan actualizado correctamente' : 'Error al actualizar plan'
        ]);
        break;

    case 'eliminar':
        $ok = $plan->eliminar($_POST['id'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Plan eliminado' : 'Error al eliminar plan'
        ]);
        break;

    case 'mostrar':
        echo json_encode($plan->mostrar($_POST['id'] ?? ''));
        break;

    case 'combo':
        echo json_encode($plan->listarCombo());
        break;

    case 'listar':
        $rs   = $plan->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $data[] = [
                $r->plan_id,
                htmlspecialchars($r->plan_desc),
                '<button class="btn btn-sm btn-primary btn-edit" data-id="'.$r->plan_id.'"><i class="fa fa-edit"></i></button> '
                .'<button class="btn btn-sm btn-danger btn-delete" data-id="'.$r->plan_id.'"><i class="fa fa-trash"></i></button>'
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    default:
        echo json_encode(['data' => []]);
        break;
}
?>
