<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../modelos/GuiaRemisionElectronica.php';

$guia = new GuiaRemisionElectronica();
$op = $_REQUEST['op'] ?? '';

switch ($op) {
  case 'listar':
    echo json_encode(['data' => $guia->listar()]);
    break;

  case 'guardar':
    $id = $guia->insertar($_POST);
    echo json_encode(['status' => $id ? 'success' : 'error', 'msg' => $id ? 'Guía registrada exitosamente.' : 'Error al registrar guía.']);
    break;

  case 'mostrar':
    echo json_encode($guia->mostrar((int)$_POST['id']));
    break;

  case 'eliminar':
    $ok = $guia->eliminar((int)$_POST['id']);
    echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Guía eliminada.' : 'Error al eliminar guía.']);
    break;

  default:
    echo json_encode(['status' => 'error', 'msg' => 'Operación inválida.']);
}
