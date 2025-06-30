<?php
session_start(); header('Content-Type: application/json');
require_once '../modelos/UsuarioRol.php';
$ur = new UsuarioRol();

if ($_SERVER['REQUEST_METHOD']==='POST'){
  if (($_SERVER['HTTP_X_CSRF_TOKEN']??'')!==($_SESSION['csrf_token']??'')){
      http_response_code(419); exit(json_encode(['status'=>'error']));
  }
}

$op = $_GET['op'] ?? '';

switch ($op){

case 'listar':
    $uid = (int)$_GET['usuario_id'];
    echo json_encode(['data'=>$ur->listarPorUsuario($uid)]); break;

case 'asignar':
    echo json_encode(['status'=>$ur->insertar(
                      (int)$_POST['usuario_id'],(int)$_POST['rol_id'])
                      ?'success':'error']); break;

case 'quitar':
    echo json_encode(['status'=>$ur->eliminar(
                      (int)$_POST['usuario_id'],(int)$_POST['rol_id'])
                      ?'success':'error']); break;

default: http_response_code(400);
}
