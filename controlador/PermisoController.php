<?php
if (session_status() === PHP_SESSION_NONE) session_start(); header('Content-Type: application/json');
require_once __DIR__ . '/../modelos/Permiso.php';
$per = new Permiso();

/* CSRF */
if ($_SERVER['REQUEST_METHOD']==='POST'){
    if (($_SERVER['HTTP_X_CSRF_TOKEN']??'')!==($_SESSION['csrf_token']??'')){
        http_response_code(419); exit(json_encode(['status'=>'error']));
    }
}

$op = $_GET['op'] ?? '';

switch ($op) {

case 'listar':
    echo json_encode(['data'=>$per->listar()]); break;

case 'mostrar':
    echo json_encode($per->mostrar((int)$_POST['id']) ?: []); break;

case 'guardar':
case 'editar':
    $d=[
      'modulo_id'=> (int)$_POST['modulo_id'],
      'accion'   => trim($_POST['accion'] ?? ''),
      'estado'   => (int)$_POST['estado']
    ];
    if(!$d['modulo_id']||$d['accion']===''){
        exit(json_encode(['status'=>'error','msg'=>'Datos incompletos']));
    }
    $ok = $op==='guardar'
        ? $per->insertar($d)
        : $per->editar((int)$_POST['id'],$d);
    echo json_encode(['status'=>$ok?'success':'error',
                      'msg'=>$ok?'Guardado':'Error']); break;

case 'cambiarEstado':
    echo json_encode(['status'=>$per->cambiarEstado(
                      (int)$_POST['id'],(int)$_POST['estado'])
                      ?'success':'error']); break;

case 'eliminar':
    echo json_encode(['status'=>$per->eliminar((int)$_POST['id'])
                      ?'success':'error']); break;

default:
    http_response_code(400); echo json_encode(['status'=>'error']);
}
