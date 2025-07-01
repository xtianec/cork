<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/OrdenTrabajo.php';
require_once __DIR__ . '/../modelos/OrdenTrabajoTarea.php';
header('Content-Type: application/json; charset=utf-8');

$ot = new OrdenTrabajo();
$tt = new OrdenTrabajoTarea();
$op = $_GET['op'] ?? '';

switch ($op) {
    case 'guardar':
        $ok = $ot->insertar(
            $_POST['proyecto_id'] ?? 0,
            $_POST['codigo'] ?? '',
            $_POST['descripcion'] ?? '',
            $_POST['estado_id'] ?? null,
            $_POST['fecha_inicio'] ?? null,
            $_POST['fecha_fin'] ?? null
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Orden registrada' : 'Error al registrar']);
        break;

    case 'editar':
        $ok = $ot->editar(
            $_POST['id'] ?? 0,
            $_POST['proyecto_id'] ?? 0,
            $_POST['codigo'] ?? '',
            $_POST['descripcion'] ?? '',
            $_POST['estado_id'] ?? null,
            $_POST['fecha_inicio'] ?? null,
            $_POST['fecha_fin'] ?? null
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Orden actualizada' : 'Error al actualizar']);
        break;

    case 'desactivar':
        $ok = $ot->desactivar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'activar':
        $ok = $ot->activar($_POST['id'] ?? 0);
        echo json_encode(['status' => $ok ? 'success' : 'error']);
        break;

    case 'mostrar':
        echo json_encode($ot->mostrar($_POST['id'] ?? 0));
        break;

    case 'listar':
        $rs   = $ot->listar();
        $data = [];
        while ($r = $rs->fetch_object()) {
            $estado = $r->is_active
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';
            $botones = $r->is_active
                ? '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $r->id . '"><i class="fa fa-edit"></i></button> '
                  . '<button class="btn btn-sm btn-danger btn-deactivate" data-id="' . $r->id . '"><i class="fa fa-trash"></i></button>'
                : '<button class="btn btn-sm btn-success btn-activate" data-id="' . $r->id . '"><i class="fa fa-check"></i></button>';
            $data[] = [
                $r->id,
                htmlspecialchars($r->proyecto),
                htmlspecialchars($r->codigo),
                $r->fecha_inicio,
                $r->fecha_fin,
                htmlspecialchars($r->estado ?? ''),
                $r->created_at,
                $r->updated_at,
                $estado,
                $botones
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    case 'selectProyecto':
        header('Content-Type: text/html; charset=utf-8');
        $rs = $ot->selectProyecto();
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->nombre) . '</option>';
        }
        exit;

    case 'selectEstado':
        header('Content-Type: text/html; charset=utf-8');
        $rs = $ot->selectEstado();
        while ($r = $rs->fetch_object()) {
            echo '<option value="' . $r->id . '">' . htmlspecialchars($r->descripcion) . '</option>';
        }
        exit;

    case 'agregarTarea':
        $ok = $tt->insertar(
            $_POST['orden_trabajo_id'] ?? 0,
            $_POST['descripcion'] ?? '',
            $_POST['empleado_id'] ?? null,
            $_POST['horas'] ?? 0,
            $_POST['costo_hora'] ?? 0
        );
        echo json_encode(['status' => $ok ? 'success' : 'error', 'msg' => $ok ? 'Tarea registrada' : 'Error al registrar']);
        break;

    case 'listarTareas':
        $rs   = $tt->listarPorOrden($_GET['orden_id'] ?? 0);
        $data = [];
        while ($r = $rs->fetch_object()) {
            $data[] = [
                $r->id,
                htmlspecialchars($r->descripcion),
                htmlspecialchars($r->empleado ?? ''),
                $r->horas,
                $r->costo_hora,
                $r->costo_total
            ];
        }
        echo json_encode(['data' => $data]);
        break;

    default:
        echo json_encode(['data' => []]);
        break;
}
