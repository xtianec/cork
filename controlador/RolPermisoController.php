<?php
session_start(); header('Content-Type: application/json');
require_once '../modelos/RolPermiso.php';
$rp = new RolPermiso();

if ($_SERVER['REQUEST_METHOD']==='POST'){
  if (($_SERVER['HTTP_X_CSRF_TOKEN']??'')!==($_SESSION['csrf_token']??'')){
      http_response_code(419); exit(json_encode(['status'=>'error']));
  }
}

$op = $_GET['op'] ?? '';

switch ($op){

case 'listar':
    $rol = (int)($_GET['rol_id'] ?? 0);
    echo json_encode(['data'=>$rp->listar($rol)]); break;

case 'asignar':
    echo json_encode(['status'=>$rp->asignar(
                      (int)$_POST['rol_id'],(int)$_POST['permiso_id'])
                      ?'success':'error']); break;

case 'quitar':
    echo json_encode(['status'=>$rp->quitar(
                      (int)$_POST['rol_id'],(int)$_POST['permiso_id'])
                      ?'success':'error']); break;

default: http_response_code(400);
}
