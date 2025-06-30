<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/Proveedor.php';
header('Content-Type: application/json; charset=utf-8');

$prov = new Proveedor();

$id                   = isset($_POST['id'])                 ? limpiarCadena($_POST['id'])                 : '';
$ruc                  = isset($_POST['ruc'])                ? limpiarCadena($_POST['ruc'])                : '';
$razon_social         = isset($_POST['razon_social'])       ? limpiarCadena($_POST['razon_social'])       : '';
$categoria_id         = isset($_POST['categoria_id'])       ? limpiarCadena($_POST['categoria_id'])       : null;
$direccion            = isset($_POST['direccion'])          ? limpiarCadena($_POST['direccion'])          : '';
$departamento         = isset($_POST['departamento'])       ? limpiarCadena($_POST['departamento'])       : '';
$provincia            = isset($_POST['provincia'])          ? limpiarCadena($_POST['provincia'])          : '';
$distrito             = isset($_POST['distrito'])           ? limpiarCadena($_POST['distrito'])           : '';
$telefono_fijo        = isset($_POST['telefono_fijo'])      ? limpiarCadena($_POST['telefono_fijo'])      : '';
$telefono_movil       = isset($_POST['telefono_movil'])     ? limpiarCadena($_POST['telefono_movil'])     : '';
$email                = isset($_POST['email'])              ? limpiarCadena($_POST['email'])              : '';
$web                  = isset($_POST['web'])                ? limpiarCadena($_POST['web'])                : '';
$contacto_responsable = isset($_POST['contacto_responsable'])? limpiarCadena($_POST['contacto_responsable']): '';
$cargo_contacto       = isset($_POST['cargo_contacto'])     ? limpiarCadena($_POST['cargo_contacto'])     : '';
$telefono_contacto    = isset($_POST['telefono_contacto'])  ? limpiarCadena($_POST['telefono_contacto'])  : '';
$email_contacto       = isset($_POST['email_contacto'])     ? limpiarCadena($_POST['email_contacto'])     : '';

switch ($_GET['op']) {
    case 'guardar':
        $rspta = $prov->insertar(
            $ruc, $razon_social, $categoria_id,
            $direccion, $departamento, $provincia, $distrito,
            $telefono_fijo, $telefono_movil,
            $email, $web,
            $contacto_responsable, $cargo_contacto,
            $telefono_contacto, $email_contacto
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Proveedor registrado correctamente' : 'Error al registrar proveedor']);
        break;

    case 'editar':
        $rspta = $prov->editar(
            $id,
            $ruc, $razon_social, $categoria_id,
            $direccion, $departamento, $provincia, $distrito,
            $telefono_fijo, $telefono_movil,
            $email, $web,
            $contacto_responsable, $cargo_contacto,
            $telefono_contacto, $email_contacto
        );
        echo json_encode(['status' => $rspta ? 'success' : 'error', 'msg' => $rspta ? 'Proveedor actualizado correctamente' : 'Error al actualizar proveedor']);
        break;

    case 'mostrar':
        $rspta = $prov->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $prov->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                htmlspecialchars($reg->ruc),
                htmlspecialchars($reg->razon_social),
                htmlspecialchars($reg->email),
                htmlspecialchars($reg->telefono_movil),
                $reg->estado
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>'
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $prov->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">" . htmlspecialchars($reg->razon_social) . "</option>";
        }
        break;
}
