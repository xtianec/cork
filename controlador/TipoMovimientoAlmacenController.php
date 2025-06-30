<?php
// controlador/TipoMovimientoAlmacenController.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/TipoMovimientoAlmacen.php';

$tm = new TipoMovimientoAlmacen();
$op = $_REQUEST['op'] ?? '';

switch ($op) {
    case 'listar':
        $out = ['data' => []];
        $res = $tm->listar();
        while ($r = $res->fetch_assoc()) {
            $r['acciones'] =
                '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $r['id'] . '">✎</button> '
                . '<button class="btn btn-sm btn-danger btn-delete" data-id="' . $r['id'] . '">🗑</button>';
            $out['data'][] = $r;
        }
        echo json_encode($out);
        break;

    case 'mostrar':
        $id = (int)($_POST['id'] ?? 0);
        echo json_encode($tm->mostrar($id));
        break;

    case 'guardar':
        $nombre = $_POST['nombre'] ?? '';
        $ok     = $tm->insertar($nombre);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Registrado' : 'Error al registrar'
        ]);
        break;

    case 'editar':
        $id     = (int)($_POST['id'] ?? 0);
        $nombre = $_POST['nombre'] ?? '';
        $ok     = $tm->editar($id, $nombre);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Actualizado' : 'Error al actualizar'
        ]);
        break;

    case 'eliminar':
        $id = (int)($_POST['id'] ?? 0);
        $ok = $tm->eliminar($id);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Eliminado' : 'Error al eliminar'
        ]);
        break;

    default:
        echo json_encode(['status' => 'error', 'msg' => 'Operación inválida']);
        break;
}