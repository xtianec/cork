<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id'])) $_SESSION['user_id'] = 1;   // <-- AÑADIR
header('Content-Type: application/json; charset=utf-8');


require_once __DIR__ . '/../modelos/AlmacenMovimiento.php';

$alm = new AlmacenMovimiento();
$op = $_REQUEST['op'] ?? '';

switch ($op) {
  case 'listar':
    $data = [];
    $res = $alm->listar();
    while ($r = $res->fetch_assoc()) {
      $r['acciones'] =
        '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $r['id'] . '">✎</button>
                <button class="btn btn-sm btn-danger btn-delete" data-id="' . $r['id'] . '">🗑️</button>';
      $data[] = $r;
    }
    echo json_encode(['data' => $data]);
    break;

  case 'guardar':

    $data = $_POST;
    $data['usuario_id'] = $_SESSION['user_id'] ?? 1;

    /* ⇢ Si es Salida (2) validar stock */
    if ((int)$data['tipo_movimiento_id'] === 2) {
      $chk = $alm->validarSalida(
        (int)$data['articulo_id'],
        (float)$data['cantidad']
      );
      if (!$chk['ok']) {
        echo json_encode(['status' => 'error', 'msg' => $chk['msg']]);
        break;
      }
    }

    $ok = $alm->insertar($data);

    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'    => $ok ? 'Guardado correctamente.' : 'No se pudo guardar'
    ]);
    break;

  case 'mostrar':
    echo json_encode($alm->mostrar((int)$_POST['id']));
    break;

  case 'editar':
    $id = (int)$_POST['id'];
    echo json_encode([
      'status' => $alm->editar($id, $_POST) ? 'success' : 'error',
      'msg' => 'Actualizado correctamente.'
    ]);
    break;

  case 'eliminar':
    $id = (int)$_POST['id'];
    echo json_encode([
      'status' => $alm->eliminar($id) ? 'success' : 'error',
      'msg' => 'Eliminado correctamente.'
    ]);
    break;
  /* ---------------- KARDEX ---------------- */
  case 'kardex':
    header('Content-Type: application/json; charset=utf-8');

    $articuloId = isset($_GET['articulo_id']) ? (int)$_GET['articulo_id'] : 0;
    $rows = [];

    if ($articuloId > 0) {
      $rs = $alm->kardex($articuloId);
      while ($row = $rs->fetch_assoc()) {
        // casteamos números para evitar que DataTables los lea como texto
        $row['entrada'] = (float) $row['entrada'];
        $row['salida']  = (float) $row['salida'];
        $row['saldo']   = (float) $row['saldo'];
        $rows[] = $row;
      }
    }

    echo json_encode(['data' => $rows], JSON_UNESCAPED_UNICODE);
    exit;               // ← evita que el script siga y mezcle la respuesta
  case 'info':
    echo json_encode($mc->info((int)$_POST['id']));
    break;
  case 'getStock':
    $id = (int)$_POST['id'];
    echo json_encode(ejecutarConsultaSimpleFila("SELECT stock_actual FROM articulo WHERE id=?", [$id]));
    break;
  case 'inventario':
    $rs = $alm->inventario();
    if ($rs === false || !($rs instanceof mysqli_result)) {
      http_response_code(500);
      echo json_encode([
        'data'  => [],
        'error' => 'MySQL: ' . mysqli_error($GLOBALS['conexion'])
      ]);
      break;
    }

    $rows = [];
    while ($row = $rs->fetch_assoc()) $rows[] = $row;
    echo json_encode(['data' => $rows]);
    break;

  default:
    http_response_code(400);
    echo json_encode(['status' => 'error', 'msg' => 'Operación inválida']);
    break;
}
