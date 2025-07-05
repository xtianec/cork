<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PlanesPrecios.php';

header('Content-Type: application/json; charset=utf-8');

$pp = new PlanesPrecios();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $pp->insertar(
            $_POST['modelo_equipo_id'] ?? '',
            $_POST['plan_id'] ?? '',
            $_POST['precio_manoobra'] ?? 0,
            $_POST['precio_materiales'] ?? 0,
            $_POST['terceros'] ?? 0
        );
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro creado' : 'Error al guardar'
        ]);
        break;
    case 'editar':
        $ids = explode('|', $_POST['id'] ?? '');
        $ok = $pp->editar(
            $ids[0] ?? '',
            $ids[1] ?? '',
            $_POST['precio_manoobra'] ?? 0,
            $_POST['precio_materiales'] ?? 0,
            $_POST['terceros'] ?? 0
        );
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro actualizado' : 'Error al actualizar'
        ]);
        break;
    case 'eliminar':
        $ids = explode('|', $_POST['id'] ?? '');
        $ok  = $pp->eliminar($ids[0] ?? '', $ids[1] ?? '');
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registro eliminado' : 'Error al eliminar'
        ]);
        break;
    case 'mostrar':
        $ids = explode('|', $_POST['id'] ?? '');
        echo json_encode($pp->mostrar($ids[0] ?? '', $ids[1] ?? ''));
        break;
    case 'listar':
        $rs   = $pp->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $id = $r->modelo_equipo_id.'|'.$r->plan_id;
            $data[] = [
                $r->modelo_equipo_id,
                $r->plan_id,
                $r->precio_manoobra,
                $r->precio_materiales,
                $r->terceros,
                '<button class="btn btn-sm btn-primary btn-edit" data-id="'.$id.'"><i class="fa fa-edit"></i></button> '
                .'<button class="btn btn-sm btn-danger btn-delete" data-id="'.$id.'"><i class="fa fa-trash"></i></button>'
            ];
        }
        echo json_encode(['data' => $data]);
        break;
    default:
        echo json_encode(['data' => []]);
        break;
}
?>
