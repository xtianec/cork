<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PlanesPreciosServicios.php';

header('Content-Type: application/json; charset=utf-8');

$pps = new PlanesPreciosServicios();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $data = [
            $_POST['modelo_equipo_id'] ?? '',
            $_POST['plana_manoobra'] ?? 0,
            $_POST['plana_materiales'] ?? 0,
            $_POST['plana_terceros'] ?? 0,
            $_POST['planb_manoobra'] ?? 0,
            $_POST['planb_materiales'] ?? 0,
            $_POST['planb_terceros'] ?? 0,
            $_POST['planc_manoobra'] ?? 0,
            $_POST['planc_materiales'] ?? 0,
            $_POST['planc_terceros'] ?? 0,
            $_POST['pland_manoobra'] ?? 0,
            $_POST['pland_materiales'] ?? 0,
            $_POST['pland_terceros'] ?? 0,
            $_POST['plan_semestral_manoobra'] ?? 0,
            $_POST['plan_semestral_materiales'] ?? 0,
            $_POST['plan_semestral_terceros'] ?? 0,
            $_POST['plan_anual_manoobra'] ?? 0,
            $_POST['plan_anual_materiales'] ?? 0,
            $_POST['plan_anual_terceros'] ?? 0
        ];
        $ok = $pps->insertar($data);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro creado' : 'Error al guardar'
        ]);
        break;
    case 'editar':
        $id   = $_POST['id'] ?? '';
        $data = [
            $_POST['plana_manoobra'] ?? 0,
            $_POST['plana_materiales'] ?? 0,
            $_POST['plana_terceros'] ?? 0,
            $_POST['planb_manoobra'] ?? 0,
            $_POST['planb_materiales'] ?? 0,
            $_POST['planb_terceros'] ?? 0,
            $_POST['planc_manoobra'] ?? 0,
            $_POST['planc_materiales'] ?? 0,
            $_POST['planc_terceros'] ?? 0,
            $_POST['pland_manoobra'] ?? 0,
            $_POST['pland_materiales'] ?? 0,
            $_POST['pland_terceros'] ?? 0,
            $_POST['plan_semestral_manoobra'] ?? 0,
            $_POST['plan_semestral_materiales'] ?? 0,
            $_POST['plan_semestral_terceros'] ?? 0,
            $_POST['plan_anual_manoobra'] ?? 0,
            $_POST['plan_anual_materiales'] ?? 0,
            $_POST['plan_anual_terceros'] ?? 0
        ];
        $ok = $pps->editar($id, $data);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro actualizado' : 'Error al actualizar'
        ]);
        break;
    case 'eliminar':
        $ok = $pps->eliminar($_POST['id'] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro eliminado' : 'Error al eliminar'
        ]);
        break;
    case 'mostrar':
        echo json_encode($pps->mostrar($_POST['id'] ?? ''));
        break;
    case 'listar':
        $rs   = $pps->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $data[] = [
                $r->modelo_equipo_id,
                $r->plana_manoobra,
                $r->planb_manoobra,
                $r->planc_manoobra,
                $r->pland_manoobra,
                '<button class="btn btn-sm btn-primary btn-edit" data-id="'.$r->modelo_equipo_id.'"><i class="fa fa-edit"></i></button> '
                .'<button class="btn btn-sm btn-danger btn-delete" data-id="'.$r->modelo_equipo_id.'"><i class="fa fa-trash"></i></button>'
            ];
        }
        echo json_encode(['data' => $data]);
        break;
    default:
        echo json_encode(['data' => []]);
        break;
}
?>
