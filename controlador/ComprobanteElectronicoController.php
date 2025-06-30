<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__.'/../modelos/ComprobanteElectronico.php';

$comp = new ComprobanteElectronico();
$op   = $_GET['op'] ?? '';

switch ($op) {

  case 'listar':
      echo json_encode(['data'=>$comp->listar()]);
      break;

  case 'guardar':
      $det = json_decode($_POST['detalles'] ?? '[]',true);
      $id  = $comp->insertar($_POST,$det);
      echo json_encode([
        'status'=>$id?'success':'error',
        'msg'   =>$id?'Comprobante guardado':'No se pudo guardar'
      ]);
      break;

  case 'anular':
      $ok = $comp->anular((int)$_POST['id']);
      echo json_encode(['status'=>$ok?'success':'error',
                        'msg'   =>$ok?'Anulado':'Error al anular']);
      break;

  default:
      echo json_encode(['status'=>'error','msg'=>'Operación inválida']);
}
