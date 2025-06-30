<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/GuiaRemModalidad.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new GuiaRemModalidad();

switch ($_GET['op']) {
    case 'guardar':
        $desc = limpiarCadena($_POST['descripcion']);
        echo $mc->insertar($desc)
             ? "Registrado"
             : "Error al registrar";
        break;

    case 'editar':
        $id   = limpiarCadena($_POST['id']);
        $desc = limpiarCadena($_POST['descripcion']);
        echo $mc->editar($id, $desc)
             ? "Actualizado"
             : "Error al actualizar";
        break;

    case 'desactivar':
        $id = limpiarCadena($_POST['id']);
        echo $mc->desactivar($id)
             ? "Desactivado"
             : "Error al desactivar";
        break;

    case 'activar':
        $id = limpiarCadena($_POST['id']);
        echo $mc->activar($id)
             ? "Activado"
             : "Error al activar";
        break;

    case 'mostrar':
        $id = limpiarCadena($_POST['id']);
        echo json_encode($mc->mostrar($id));
        break;

    case 'listar':
        $rspta = $mc->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->descripcion),
                $reg->is_active
                  ? '<span class="badge badge-success">Activo</span>'
                  : '<span class="badge badge-danger">Inactivo</span>',
                $reg->is_active
                  ? '<button onclick="editarModalidad('.$reg->id.')">✏️</button>
                     <button onclick="desactivarModalidad('.$reg->id.')">🚫</button>'
                  : '<button onclick="editarModalidad('.$reg->id.')">✏️</button>
                     <button onclick="activarModalidad('.$reg->id.')">✅</button>'
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $mc->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value="'.$reg->id.'">'.htmlspecialchars($reg->descripcion).'</option>';
        }
        break;
}
