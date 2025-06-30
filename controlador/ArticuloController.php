<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelos/Articulo.php';
$mc = new Articulo();
$op = $_GET['op'] ?? '';

if ($op === 'listarSelect') {
    $rs = $mc->listar();
    while ($r = $rs->fetch_assoc()) {
        printf(
            '<option value="%d">%s</option>',
            (int)$r['id'],
            htmlspecialchars($r['nombre'], ENT_QUOTES, 'UTF-8')
        );
    }
    exit;                    // <- ¡no dejes que continúe al switch!
}
switch ($op) {

    case 'searchStock':
        echo json_encode([
            'results' => $mc->listarConStock($_GET['q'] ?? '')
        ]);
        break;

    /*―👉 info de un artículo ―*/
    case 'info':
        echo json_encode($mc->info((int)$_POST['id']));
        break;


    case 'guardar':
        $imagenPath = '';
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $ext     = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $newName = uniqid('art_') . '.' . $ext;
            move_uploaded_file(
                $_FILES['imagen']['tmp_name'],
                __DIR__ . "/../uploads/{$newName}"
            );
            $imagenPath = "uploads/{$newName}";
        }
        $ok = $mc->insertar($_POST, $imagenPath);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Artículo creado correctamente' : 'Error al crear artículo'
        ]);
        break;

    case 'editar':
        $imagenPath = null;
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $ext     = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $newName = uniqid('art_') . '.' . $ext;
            move_uploaded_file(
                $_FILES['imagen']['tmp_name'],
                __DIR__ . "/../uploads/{$newName}"
            );
            $imagenPath = "uploads/{$newName}";
        }
        $ok = $mc->editar($_POST, $imagenPath);
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Artículo actualizado correctamente' : 'Error al actualizar artículo'
        ]);
        break;

    case 'desactivar':
        $ok = $mc->desactivar((int)($_POST['id'] ?? 0));
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Artículo desactivado' : 'Error al desactivar artículo'
        ]);
        break;

    case 'activar':
        $ok = $mc->activar((int)($_POST['id'] ?? 0));
        echo json_encode([
            'status' => $ok ? 'success' : 'error',
            'msg'    => $ok ? 'Artículo activado' : 'Error al activar artículo'
        ]);
        break;

    case 'mostrar':
        $row = $mc->mostrar((int)($_POST['id'] ?? 0));
        echo json_encode($row);
        break;

    case 'listar':
        $rs   = $mc->listar();
        if ($rs === false) {
            echo json_encode(['data' => []]);
            exit;
        }
        $data = [];
        while ($r = $rs->fetch_object()) {
            $imgTag = $r->imagen
                ? '<img src="' . APP_URL . $r->imagen . '" height="40" class="rounded" />'
                : '';
            $data[] = [
                $r->id,
                htmlspecialchars($r->codigo,        ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($r->nombre,        ENT_QUOTES, 'UTF-8'),
                $imgTag,
                htmlspecialchars($r->marca,         ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($r->linea,         ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($r->sublinea,      ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($r->unidad_medida, ENT_QUOTES, 'UTF-8'),
                (int)$r->stock_actual,
                '$ ' . number_format($r->precio_venta, 2),
                $r->estado,
                $r->acciones
            ];
        }
        echo json_encode(['data' => $data]);
        exit;
    case 'listarSelect':                         // <option value="…">…</option>
        header('Content-Type: text/html; charset=utf-8');   // ¡Ojo!
        $rs = $mc->listar();
        while ($r = $rs->fetch_assoc()) {
            printf(
                '<option value="%d">%s</option>',
                (int)$r['id'],
                htmlspecialchars($r['nombre'], ENT_QUOTES, 'UTF-8')
            );
        }
        exit;



    case 'lineas':
        echo json_encode(ejecutarConsultaArray(
            "SELECT id, nombre text FROM linea WHERE is_active=1"
        ));
        break;

    case 'sublineas':        // recibe línea en $_GET['linea_id']
        echo json_encode(ejecutarConsultaArray(
            "SELECT id, nombre text FROM sublinea
         WHERE linea_id=? AND is_active=1",
            [(int)$_GET['linea_id']]
        ));
        break;

    case 'marcas':
        echo json_encode(ejecutarConsultaArray(
            "SELECT id, nombre text FROM marca WHERE is_active=1"
        ));
        break;

    /* ───── búsqueda de artículos con filtros y stock ───── */
    /* controlador/ArticuloController.php  –  case 'searchArt' */
    /* --------- buscador remoto para Select2 --------- */
    case 'searchArt':
        $q        = trim($_GET['q']          ?? '');
        $linea_id = (int)($_GET['linea_id']   ?? 0);
        $sub_id   = (int)($_GET['sublinea_id'] ?? 0);
        $marca_id = (int)($_GET['marca_id']   ?? 0);

        /* ---------- paginación Select2 ---------- */
        $page     = (int)($_GET['page'] ?? 1);
        $limit    = 20;
        $offset   = ($page - 1) * $limit;

        $rows = $mc->buscarSelect2($q, $linea_id, $sub_id, $marca_id, $limit, $offset);
        $total = $mc->contarSelect2($q, $linea_id, $sub_id, $marca_id);

        /* formato Select2 con more = quedan más páginas? */
        echo json_encode([
            'results' => array_map(fn($r) => [
                'id'  => $r['id'],
                'text' => $r['text']
            ], $rows),
            'more'    => ($offset + $limit) < $total
        ]);
        exit;
}
