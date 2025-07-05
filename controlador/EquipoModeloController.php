<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/EquipoModelo.php';

header('Content-Type: application/json; charset=utf-8');
$mod = new EquipoModelo();
$op  = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $mod->insertar($_POST['nombre']);
        echo json_encode([
          'status'=> $ok ? 'success' : 'error',
          'msg'   => $ok ? 'Modelo registrado correctamente' : 'Error al registrar modelo'
        ]);
        break;

    case 'editar':
        $ok = $mod->editar($_POST['id'], $_POST['nombre']);
        echo json_encode([
          'status'=> $ok ? 'success' : 'error',
          'msg'   => $ok ? 'Modelo actualizado correctamente' : 'Error al actualizar modelo'
        ]);
        break;

    case 'desactivar':
        $ok = $mod->desactivar($_POST['id']);
        echo json_encode([
          'status'=> $ok ? 'success' : 'error',
          'msg'   => $ok ? 'Modelo desactivado' : 'Error al desactivar modelo'
        ]);
        break;

    case 'activar':
        $ok = $mod->activar($_POST['id']);
        echo json_encode([
          'status'=> $ok ? 'success' : 'error',
          'msg'   => $ok ? 'Modelo activado' : 'Error al activar modelo'
        ]);
        break;
     case 'combo':
        echo json_encode($mod->listarCombo());
        break;

    case 'mostrar':
        echo json_encode($mod->mostrar($_POST['id']));
        break;

    case 'listar':
        $rspta = $mod->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
              $reg->id,
              htmlspecialchars($reg->nombre),
              $reg->created_at,
              $reg->updated_at,
              $reg->is_active
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>',
              $reg->is_active
                ? '<button class="btn btn-sm btn-primary btn-edit-equipomodelo"      data-id="'.$reg->id.'"><i class="fa fa-edit"></i></button> '
                  .'<button class="btn btn-sm btn-danger  btn-deactivate-equipomodelo" data-id="'.$reg->id.'"><i class="fa fa-trash"></i></button>'
                : '<button class="btn btn-sm btn-success btn-activate-equipomodelo"  data-id="'.$reg->id.'"><i class="fa fa-check"></i></button>'
            ];
        }
        echo json_encode(['data'=>$data]);
        break;

    default:
        echo json_encode(['data'=>[]]);
        break;
}
