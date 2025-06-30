<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../modelos/Usuario.php';
$usr = new Usuario();

/* CSRF */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
    http_response_code(419);
    exit(json_encode(['status' => 'error']));
  }
}

$op = $_GET['op'] ?? '';

switch ($op) {

  case 'listar':
    echo json_encode(['data' => $usr->listar()]);
    break;

  case 'mostrar':
    $u = $usr->mostrar($id);
    $u['accesos'] = ejecutarConsultaArray(
      "SELECT umr.modulo_id,m.nombre AS modulo,umr.rol_id,r.nombre AS rol
     FROM usuario_modulo_rol umr
     JOIN modulo m ON m.id=umr.modulo_id
     JOIN rol r    ON r.id=umr.rol_id
    WHERE umr.usuario_id=?",
      [$id]
    );
    echo json_encode($u);
    break;

  case 'guardar':
  case 'editar':
    $data = $_POST;
    $data['accesos'] = json_decode($_POST['accesos_json'] ?? '[]', true);
    $ok = $op === 'guardar' ? $usr->insertar($data) : $usr->editar($id, $data);
    $roles = array_map('intval', $_POST['roles'] ?? []);
    $d = [
      'username' => trim($_POST['username'] ?? ''),
      'email'   => trim($_POST['email'] ?? ''),
      'password' => $_POST['password'] ?? '',
      'estado'  => (int)$_POST['estado'],
      'roles'   => $roles
    ];
    if ($d['username'] === '' || empty($roles)) {
      exit(json_encode(['status' => 'error', 'msg' => 'Datos inválidos']));
    }
    if ($op === 'guardar' && strlen($d['password']) < 6) {
      exit(json_encode(['status' => 'error', 'msg' => 'Password corto']));
    }
    $ok = $op === 'guardar'
      ? $usr->insertar($d)
      : $usr->editar((int)$_POST['id'], $d);

    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg' => $ok ? 'Guardado' : 'Error'
    ]);
    break;

  case 'cambiarEstado':
    echo json_encode(['status' => $usr->cambiarEstado(
      (int)$_POST['id'],
      (int)$_POST['estado']
    )
      ? 'success' : 'error']);
    break;

  case 'trash':
    echo json_encode(['status' => $usr->trash((int)$_POST['id'])
      ? 'success' : 'error']);
    break;

  case 'restore':
    echo json_encode(['status' => $usr->restore((int)$_POST['id'])
      ? 'success' : 'error']);
    break;

  default:
    http_response_code(400);
}
