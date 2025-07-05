<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PlanesHoras.php';

header('Content-Type: application/json; charset=utf-8');

$ph = new PlanesHoras();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $ph->insertar($_POST['plan_id'] ?? '', $_POST['horas_plan'] ?? '', $_POST['plan_desc'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro creado' : 'Error al guardar'
        ]);
        break;
    case 'editar':
        $ok = $ph->editar($_POST['id'] ?? '', $_POST['horas_plan'] ?? '', $_POST['plan_desc'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro actualizado' : 'Error al actualizar'
        ]);
        break;
    case 'eliminar':
        $ok = $ph->eliminar($_POST['id'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro eliminado' : 'Error al eliminar'
        ]);
        break;
    case 'mostrar':
        echo json_encode($ph->mostrar($_POST['id'] ?? ''));
        break;
    case 'listar':
        $rs   = $ph->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $data[] = [
                $r->plan_id,
                $r->horas_plan,
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
