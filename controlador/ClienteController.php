<?php
// controlador/ClienteController.php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelos/Cliente.php';
require_once __DIR__ . '/../config/Conexion.php'; // ejecutarConsulta

$mc = new Cliente();
$op = $_REQUEST['op'] ?? '';

if ($op === 'select') {
    header('Content-Type: text/html; charset=utf-8');
    $rs = ejecutarConsulta(
        "SELECT id, nombre FROM categoria_cliente WHERE is_active=1 ORDER BY nombre"
    );
    if ($rs) {
        while ($r = $rs->fetch_assoc()) {
            printf(
                '<option value="%d">%s</option>',
                $r['id'],
                htmlspecialchars($r['nombre'], ENT_QUOTES, 'UTF-8')
            );
        }
    }
    exit;
}

switch ($op) {

    // Listado principal
    case 'listar':
        $data = [];
        $rs = $mc->listar();
        if ($rs) {
            while ($r = $rs->fetch_assoc()) {
                $r['estado_label'] = $r['estado']
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';
                $r['acciones']  = '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $r['id'] . '">✎</button> ';
                $r['acciones'] .= $r['estado']
                    ? '<button class="btn btn-sm btn-danger btn-deactivate" data-id="' . $r['id'] . '">✖</button>'
                    : '<button class="btn btn-sm btn-success btn-activate" data-id="' . $r['id'] . '">✔</button>';
                $data[] = $r;
            }
        }
        echo json_encode(['data' => $data], JSON_UNESCAPED_UNICODE);
        break;

    // Mostrar un registro
    case 'mostrar':
        $id  = (int)($_POST['id'] ?? 0);
        $row = $mc->mostrar($id);
        echo json_encode($row ?: [], JSON_UNESCAPED_UNICODE);
        break;

    // Crear nuevo
    case 'guardar':
        $ok = $mc->insertar($_POST);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Cliente creado correctamente' : 'Error al crear cliente'
        ], JSON_UNESCAPED_UNICODE);
        break;

    // Actualizar existente
    case 'editar':
        $ok = $mc->editar($_POST);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Cliente actualizado correctamente' : 'Error al actualizar cliente'
        ], JSON_UNESCAPED_UNICODE);
        break;

    // Cambiar estado
    case 'desactivar':
        $ok = $mc->desactivar((int)($_POST['id'] ?? 0));
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Cliente desactivado' : 'Error al desactivar cliente'
        ], JSON_UNESCAPED_UNICODE);
        break;

    case 'activar':
        $ok = $mc->activar((int)($_POST['id'] ?? 0));
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Cliente activado' : 'Error al activar cliente'
        ], JSON_UNESCAPED_UNICODE);
        break;

    default:
        echo json_encode(['status' => 'error', 'msg' => 'Operación inválida'], JSON_UNESCAPED_UNICODE);
}
