<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/CategoriaCliente.php';

$cat = new CategoriaCliente();
$op  = $_GET['op'] ?? '';

header('Content-Type: application/json; charset=utf-8');

switch ($op) {
  case 'guardar':
    $ok = $cat->insertar($_POST['nombre'] ?? '');
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'    => $ok ? 'Categoría creada correctamente' : 'Error al crear categoría'
    ]);
    break;

  case 'editar':
    $ok = $cat->editar($_POST['id'] ?? 0, $_POST['nombre'] ?? '');
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'    => $ok ? 'Categoría actualizada correctamente' : 'Error al actualizar categoría'
    ]);
    break;

  case 'desactivar':
    $ok = $cat->desactivar($_POST['id'] ?? 0);
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'    => $ok ? 'Categoría desactivada' : 'Error al desactivar categoría'
    ]);
    break;

  case 'activar':
    $ok = $cat->activar($_POST['id'] ?? 0);
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'    => $ok ? 'Categoría activada' : 'Error al activar categoría'
    ]);
    break;

  case 'mostrar':
    echo json_encode($cat->mostrar($_POST['id'] ?? 0));
    break;

  case 'listar':
    $rspta = $cat->listar();
    $data  = [];
    while ($row = $rspta->fetch_object()) {
      $data[] = [
        $row->id,
        htmlspecialchars($row->nombre),
        $row->created_at,
        $row->updated_at,
        $row->is_active
          ? '<span class="badge badge-success">Activo</span>'
          : '<span class="badge badge-danger">Inactivo</span>',
        $row->is_active
          ? '<button class="btn btn-sm btn-primary btn-edit"      data-id="' . $row->id . '"><i class="fa fa-edit"></i></button> '
          . '<button class="btn btn-sm btn-danger  btn-deactivate" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>'
          : '<button class="btn btn-sm btn-success btn-activate"  data-id="' . $row->id . '"><i class="fa fa-check"></i></button>'
      ];
    }
    echo json_encode(['data' => $data]);
    break;

  case 'select':
    // Usamos listar() y filtramos is_active=1
    $rs = $cat->listar();
    // No queremos JSON sino HTML de <option>
    // así que quitamos el header JSON para esta rama
    header('Content-Type: text/html; charset=utf-8');
    while ($row = $rs->fetch_object()) {
      if ((int)$row->is_active === 1) {
        echo "<option value=\"{$row->id}\">" . htmlspecialchars($row->nombre, ENT_QUOTES, 'UTF-8') . "</option>";
      }
    }
    break;

  default:
    echo json_encode(['data' => []]);
    break;
}
