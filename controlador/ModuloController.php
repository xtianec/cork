<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelos/Modulo.php';
$mod = new Modulo();

/* ——— CSRF ——— */
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $hdr = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if ($hdr !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(419);
        exit(json_encode(['status'=>'error','msg'=>'CSRF token inválido']));
    }
}

$op = $_GET['op'] ?? '';

switch ($op) {

/* ——— READ ——— */
case 'listar':
    echo json_encode(['data'=>$mod->listar()]); break;

case 'mostrar':
    echo json_encode($mod->mostrar((int)$_POST['id']) ?: []); break;

/* ——— WRITE ——— */
case 'guardar':
case 'editar':
    $d = [
      'nombre'=> trim($_POST['nombre'] ?? ''),
      'ruta'  => trim($_POST['ruta']   ?? ''),
      'estado'=> (int)($_POST['estado'] ?? 1)
    ];
    if ($d['nombre']==='') {
        exit(json_encode(['status'=>'error','msg'=>'Nombre requerido']));
    }
    $ok = $op==='guardar'
        ? $mod->insertar($d)
        : $mod->editar((int)$_POST['id'],$d);

    echo json_encode(['status'=>$ok?'success':'error',
                      'msg'   =>$ok? 'Guardado':'Error']);
    break;

/* ——— activar/desactivar ——— */
case 'cambiarEstado':
    $ok = $mod->cambiarEstado((int)$_POST['id'], (int)$_POST['estado']);
    echo json_encode(['status'=>$ok?'success':'error']); break;

/* ——— DELETE físico ——— */
case 'eliminar':
    echo json_encode(['status'=>$mod->eliminar((int)$_POST['id'])
                                ?'success':'error']); break;

default:
    http_response_code(400);
    echo json_encode(['status'=>'error','msg'=>'Operación desconocida']);
}
