<?php
if (session_status() === PHP_SESSION_NONE) session_start(); header('Content-Type: application/json');
require_once __DIR__ . '/../modelos/Rol.php'; $rol = new Rol();

/* CSRF */
if ($_SERVER['REQUEST_METHOD']==='POST'){
    if (($_SERVER['HTTP_X_CSRF_TOKEN']??'')!==($_SESSION['csrf_token']??'')){
        http_response_code(419); exit(json_encode(['status'=>'error']));
    }
}

$op = $_GET['op'] ?? '';

switch ($op) {

case 'listar':
    echo json_encode(['data'=>$rol->listar()]); break;

case 'mostrar':
    echo json_encode($rol->mostrar((int)$_POST['id']) ?: []); break;

case 'guardar':
case 'editar':
    $d=['nombre'=>trim($_POST['nombre']??''),
       'estado'=>(int)$_POST['estado']];
    if(strlen($d['nombre'])<3)
        exit(json_encode(['status'=>'error','msg'=>'Nombre inválido']));

    $ok = $op==='guardar'
        ? $rol->insertar($d)
        : $rol->editar((int)$_POST['id'],$d);

    echo json_encode(['status'=>$ok?'success':'error',
                      'msg'=>$ok?'Guardado':'Error']); break;

case 'cambiarEstado':
    echo json_encode(['status'=>$rol->cambiarEstado(
                        (int)$_POST['id'],(int)$_POST['estado'])
                        ?'success':'error']); break;

case 'trash':
    echo json_encode(['status'=>$rol->trash((int)$_POST['id'])
                      ?'success':'error']); break;

case 'restore':
    echo json_encode(['status'=>$rol->restore((int)$_POST['id'])
                      ?'success':'error']); break;

default: http_response_code(400);
}
