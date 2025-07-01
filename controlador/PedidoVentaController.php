<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PedidoVenta.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new PedidoVenta();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok  = $mc->insertar($_POST);
        $msg = $ok ? 'Pedido registrado correctamente' : 'Error al registrar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'editar':
        $ok  = $mc->editar($_POST);
        $msg = $ok ? 'Pedido actualizado' : 'Error al actualizar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'desactivar':
        $ok  = $mc->desactivar((int)($_POST['id'] ?? 0));
        $msg = $ok ? 'Pedido desactivado' : 'Error al desactivar';
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $msg]);
        break;

    case 'activar':
        $ok  = $mc->activar((int)($_POST['id'] ?? 0));
        $msg = $ok ? 'Pedido activado' : 'Error al activar';
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
                ? '<button class="btn btn-sm btn-primary btn-edit" data-id="'.$r->id.'">✎</button> '
                  .'<button class="btn btn-sm btn-danger btn-deactivate" data-id="'.$r->id.'">✖</button>'
                : '<button class="btn btn-sm btn-success btn-activate" data-id="'.$r->id.'">✔</button>';
            $data[] = [
                $r->id,
                htmlspecialchars($r->cliente),
                $r->fecha,
                '$ ' . number_format($r->monto_total, 2),
                htmlspecialchars($r->estado),
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
