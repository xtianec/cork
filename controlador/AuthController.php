<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../modelos/Usuario.php';
$usr = new Usuario();
$op = $_GET['op'] ?? '';

switch ($op) {
  case 'login':
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    $data = $usr->login($u, $p);
    if ($data) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['full_name'] = $data['username'];
        $_SESSION['user_role'] = $data['roles'][0] ?? '';
        $_SESSION['user_type'] = 'user';
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Credenciales inválidas']);
    }
    break;

  case 'logout':
    session_destroy();
    echo json_encode(['status' => 'success']);
    break;

  default:
    http_response_code(400);
}
