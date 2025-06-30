<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Contacto.php';

header('Content-Type: application/json; charset=utf-8');
$cont = new Contacto();
$op   = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $cont->insertar($_POST['nombre'], $_POST['cargo'], $_POST['telefono'], $_POST['email']);
        echo json_encode([
          'status' => $ok ? 'success' : 'error',
          'msg'    => $ok ? 'Contacto registrado correctamente' : 'Error al registrar contacto'
        ]);
        break;

    case 'editar':
        $ok = $cont->editar($_POST['id'], $_POST['nombre'], $_POST['cargo'], $_POST['telefono'], $_POST['email']);
        echo json_encode([
          'status' => $ok ? 'success' : 'error',
          'msg'    => $ok ? 'Contacto actualizado correctamente' : 'Error al actualizar contacto'
        ]);
        break;

    case 'desactivar':
        $ok = $cont->desactivar($_POST['id']);
        echo json_encode([
          'status' => $ok ? 'success' : 'error',
          'msg'    => $ok ? 'Contacto desactivado' : 'Error al desactivar contacto'
        ]);
        break;

    case 'activar':
        $ok = $cont->activar($_POST['id']);
        echo json_encode([
          'status' => $ok ? 'success' : 'error',
          'msg'    => $ok ? 'Contacto activado' : 'Error al activar contacto'
        ]);
        break;

    case 'mostrar':
        echo json_encode($cont->mostrar($_POST['id']));
        break;

    case 'listar':
        $rspta = $cont->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
              $reg->id,
              htmlspecialchars($reg->nombre),
              htmlspecialchars($reg->cargo),
              htmlspecialchars($reg->telefono),
              htmlspecialchars($reg->email),
              $reg->is_active
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>',
              $reg->is_active
                ? '<button class="btn btn-sm btn-primary btn-edit-contacto"      data-id="'.$reg->id.'"><i class="fa fa-edit"></i></button> '
                  .'<button class="btn btn-sm btn-danger  btn-deactivate-contacto" data-id="'.$reg->id.'"><i class="fa fa-trash"></i></button>'
                : '<button class="btn btn-sm btn-success btn-activate-contacto"  data-id="'.$reg->id.'"><i class="fa fa-check"></i></button>'
            ];
        }
        echo json_encode(['data'=>$data]);
        break;

    default:
        echo json_encode(['data'=>[]]);
        break;
}
