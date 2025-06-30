<?php
// File: controlador/FormaPagoController.php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/FormaPago.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new FormaPago();
$id     = isset($_POST['id'])          ? limpiarCadena($_POST['id'])          : '';
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']): '';

switch ($_GET['op']) {
    case 'guardar':
        echo $mc->insertar($descripcion) ? "Registrado" : "Error al registrar";
        break;
    case 'editar':
        echo $mc->editar($id, $descripcion) ? "Actualizado" : "Error al actualizar";
        break;
    case 'desactivar':
        echo $mc->desactivar($id) ? "Desactivado" : "Error al desactivar";
        break;
    case 'activar':
        echo $mc->activar($id) ? "Activado" : "Error al activar";
        break;
    case 'mostrar':
        echo json_encode($mc->mostrar($id));
        break;
    case 'listar':
        $rspta = $mc->listar();
        $data = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0"=>$reg->id,
                "1"=>htmlspecialchars($reg->descripcion),
                "2"=>($reg->is_active??1)
                    ?'<span class="badge badge-success">Activo</span>'
                    :'<span class="badge badge-danger">Inactivo</span>',
                "3"=>($reg->is_active??1)
                    ?'<button onclick="editarFormaPago('.$reg->id.')">✎</button> '
                     .'<button onclick="desactivarFormaPago('.$reg->id.')">✖</button>'
                    :'<button onclick="activarFormaPago('.$reg->id.')">✔</button>'
            ];
        }
        echo json_encode(["data"=>$data]);
        break;
    case 'select':
        $rspta = $mc->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value="'.$reg->id.'">'.htmlspecialchars($reg->descripcion).'</option>';
        }
        break;
}
