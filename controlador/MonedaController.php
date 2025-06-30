<?php
// File: controlador/MonedaController.php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Moneda.php';
header('Content-Type: application/json; charset=utf-8');

$mc = new Moneda();
$id     = isset($_POST['id'])          ? limpiarCadena($_POST['id'])          : '';
$codigo      = isset($_POST['codigo'])      ? limpiarCadena($_POST['codigo']): '';
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']): '';

switch ($_GET['op']) {
    case 'guardar':
        echo $mc->insertar($codigo, $descripcion) ? "Registrado" : "Error al registrar";
        break;
    case 'editar':
        echo $mc->editar($id, $codigo, $descripcion) ? "Actualizado" : "Error al actualizar";
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
                "1"=>htmlspecialchars($reg->codigo),
                "2"=>htmlspecialchars($reg->descripcion),
                "3"=>($reg->is_active??1)
                    ?'<span class="badge badge-success">Activo</span>'
                    :'<span class="badge badge-danger">Inactivo</span>',
                "4"=>($reg->is_active??1)
                    ?'<button onclick="editarMoneda('.$reg->id.')">✎</button> '
                     .'<button onclick="desactivarMoneda('.$reg->id.')">✖</button>'
                    :'<button onclick="activarMoneda('.$reg->id.')">✔</button>'
            ];
        }
        echo json_encode(["data"=>$data]);
        break;
    case 'select':
        $rspta = $mc->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value="'.$reg->id.'">'.htmlspecialchars($reg->codigo).' - '.htmlspecialchars($reg->descripcion).'</option>';
        }
        break;
}
