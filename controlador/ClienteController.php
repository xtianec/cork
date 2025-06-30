<?php
// controlador/ClienteController.php

// 1) Buffer y silenciado de errores para devolver siempre JSON limpio
ob_start();
ini_set('display_errors',    '0');
ini_set('display_startup_errors', '0');
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');

// 2) Conexión
require_once __DIR__ . '/../config/Conexion.php';
global $conexion;
if (!$conexion || $conexion->connect_errno) {
  ob_end_clean();
  echo json_encode(['status' => 'error', 'msg' => 'DB connection error'], JSON_UNESCAPED_UNICODE);
  exit;
}

// 3) Operación
$op = $_REQUEST['op'] ?? '';

switch ($op) {

  // 1) Select categorías
  case 'select':
    header('Content-Type: text/html; charset=utf-8');
    if ($res = $conexion->query("SELECT id,nombre FROM categoria_cliente WHERE is_active=1 ORDER BY nombre")) {
      while ($r = $res->fetch_assoc()) {
        printf(
          '<option value="%d">%s</option>',
          $r['id'],
          htmlspecialchars($r['nombre'], ENT_QUOTES, 'UTF-8')
        );
      }
    }
    exit;

    // 2) Listar
  case 'listar':
    $out = ['data' => []];
    $sql = "
      SELECT c.id, c.ruc, c.razon_social,
        (SELECT nombre FROM categoria_cliente 
           WHERE id=c.categoria_id AND is_active=1 LIMIT 1
        ) AS categoria,
        c.estado, DATE_FORMAT(c.fecha_registro,'%Y-%m-%d') AS fecha_registro
      FROM cliente c
      ORDER BY c.id DESC
    ";
    if ($res = $conexion->query($sql)) {
      while ($r = $res->fetch_assoc()) {
        $r['estado_label'] = $r['estado']
          ? '<span class="badge badge-success">Activo</span>'
          : '<span class="badge badge-danger">Inactivo</span>';
        $r['acciones']  = '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $r['id'] . '">✎</button> ';
        $r['acciones'] .= $r['estado']
          ? '<button class="btn btn-sm btn-danger btn-deactivate" data-id="' . $r['id'] . '">✖</button>'
          : '<button class="btn btn-sm btn-success btn-activate" data-id="' . $r['id'] . '">✔</button>';
        $out['data'][] = $r;
      }
    }
    ob_end_clean();
    echo json_encode($out, JSON_UNESCAPED_UNICODE);
    exit;

    // 3) Mostrar
  case 'mostrar':
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $conexion->prepare("SELECT * FROM cliente WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    ob_end_clean();
    echo json_encode($row ?: [], JSON_UNESCAPED_UNICODE);
    exit;

    // 4) Guardar
  case 'guardar':
    // Recogemos variables
    $ruc                  = $_POST['ruc'];
    $razon_social         = $_POST['razon_social'];
    $categoria_id         = (int)$_POST['categoria_id'];
    $estado               = 1;
    $direccion_fiscal     = $_POST['direccion_fiscal']     ?? '';
    $direccion_planta     = $_POST['direccion_planta']     ?? '';
    $departamento         = $_POST['departamento']         ?? '';
    $provincia            = $_POST['provincia']            ?? '';
    $distrito             = $_POST['distrito']             ?? '';
    $telefono_fijo        = $_POST['telefono_fijo']        ?? '';
    $telefono_movil       = $_POST['telefono_movil']       ?? '';
    $email                = $_POST['email']                ?? '';
    $web                  = $_POST['web']                  ?? '';
    $contacto_responsable = $_POST['contacto_responsable'] ?? '';
    $cargo_contacto       = $_POST['cargo_contacto']       ?? '';
    $telefono_contacto    = $_POST['telefono_contacto']    ?? '';
    $email_contacto       = $_POST['email_contacto']       ?? '';

    // Preparamos INSERT
    $sql = "INSERT INTO cliente (
              ruc, razon_social, categoria_id, estado,
              direccion_fiscal, direccion_planta,
              departamento, provincia, distrito,
              telefono_fijo, telefono_movil,
              email, web,
              contacto_responsable, cargo_contacto,
              telefono_contacto, email_contacto
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
      error_log("Prepare failed en guardar: " . $conexion->error);
    }
    // 2 s + 2 i + 13 s = 17 tipos
    $types = 'ssii' . str_repeat('s', 13);
    $stmt->bind_param(
      $types,
      $ruc,
      $razon_social,
      $categoria_id,
      $estado,
      $direccion_fiscal,
      $direccion_planta,
      $departamento,
      $provincia,
      $distrito,
      $telefono_fijo,
      $telefono_movil,
      $email,
      $web,
      $contacto_responsable,
      $cargo_contacto,
      $telefono_contacto,
      $email_contacto
    );
    $ok = $stmt->execute();
    ob_end_clean();
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'   => $ok ? 'Cliente creado correctamente' : 'Error al crear cliente'
    ], JSON_UNESCAPED_UNICODE);
    exit;

    // 5) Editar
  case 'editar':
    // Recogemos variables (idénticas más estado e id)
    $ruc                  = $_POST['ruc'];
    $razon_social         = $_POST['razon_social'];
    $categoria_id         = (int)$_POST['categoria_id'];
    $estado               = (int)$_POST['estado'];
    $direccion_fiscal     = $_POST['direccion_fiscal']     ?? '';
    $direccion_planta     = $_POST['direccion_planta']     ?? '';
    $departamento         = $_POST['departamento']         ?? '';
    $provincia            = $_POST['provincia']            ?? '';
    $distrito             = $_POST['distrito']             ?? '';
    $telefono_fijo        = $_POST['telefono_fijo']        ?? '';
    $telefono_movil       = $_POST['telefono_movil']       ?? '';
    $email                = $_POST['email']                ?? '';
    $web                  = $_POST['web']                  ?? '';
    $contacto_responsable = $_POST['contacto_responsable'] ?? '';
    $cargo_contacto       = $_POST['cargo_contacto']       ?? '';
    $telefono_contacto    = $_POST['telefono_contacto']    ?? '';
    $email_contacto       = $_POST['email_contacto']       ?? '';
    $id                   = (int)$_POST['id'];

    // Preparamos UPDATE
    $sql = "UPDATE cliente SET
              ruc = ?, razon_social = ?, categoria_id = ?, estado = ?,
              direccion_fiscal = ?, direccion_planta = ?,
              departamento = ?, provincia = ?, distrito = ?,
              telefono_fijo = ?, telefono_movil = ?,
              email = ?, web = ?,
              contacto_responsable = ?, cargo_contacto = ?,
              telefono_contacto = ?, email_contacto = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
      error_log("Prepare failed en editar: " . $conexion->error);
    }
    // 2 s + 2 i + 13 s + 1 i = 18 tipos
    $types = 'ssii' . str_repeat('s', 13) . 'i';
    $stmt->bind_param(
      $types,
      $ruc,
      $razon_social,
      $categoria_id,
      $estado,
      $direccion_fiscal,
      $direccion_planta,
      $departamento,
      $provincia,
      $distrito,
      $telefono_fijo,
      $telefono_movil,
      $email,
      $web,
      $contacto_responsable,
      $cargo_contacto,
      $telefono_contacto,
      $email_contacto,
      $id
    );
    $ok = $stmt->execute();
    ob_end_clean();
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'   => $ok ? 'Cliente actualizado correctamente' : 'Error al actualizar cliente'
    ], JSON_UNESCAPED_UNICODE);
    exit;

    // 5) Editar
  case 'editar':
    // Mismas variables + id
    $ruc                  = $_POST['ruc'];
    $razon_social         = $_POST['razon_social'];
    $categoria_id         = (int)$_POST['categoria_id'];
    $estado               = (int)$_POST['estado'];
    $direccion_fiscal     = $_POST['direccion_fiscal']     ?? '';
    $direccion_planta     = $_POST['direccion_planta']     ?? '';
    $departamento         = $_POST['departamento']         ?? '';
    $provincia            = $_POST['provincia']            ?? '';
    $distrito             = $_POST['distrito']             ?? '';
    $telefono_fijo        = $_POST['telefono_fijo']        ?? '';
    $telefono_movil       = $_POST['telefono_movil']       ?? '';
    $email                = $_POST['email']                ?? '';
    $web                  = $_POST['web']                  ?? '';
    $contacto_responsable = $_POST['contacto_responsable'] ?? '';
    $cargo_contacto       = $_POST['cargo_contacto']       ?? '';
    $telefono_contacto    = $_POST['telefono_contacto']    ?? '';
    $email_contacto       = $_POST['email_contacto']       ?? '';
    $id                   = (int)$_POST['id'];

    // Prepare UPDATE
    $sql = "UPDATE cliente SET
              ruc = ?, razon_social = ?, categoria_id = ?, estado = ?,
              direccion_fiscal = ?, direccion_planta = ?,
              departamento = ?, provincia = ?, distrito = ?,
              telefono_fijo = ?, telefono_movil = ?,
              email = ?, web = ?,
              contacto_responsable = ?, cargo_contacto = ?,
              telefono_contacto = ?, email_contacto = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
      'ssiisssssssssssssi',
      $ruc,
      $razon_social,
      $categoria_id,
      $estado,
      $direccion_fiscal,
      $direccion_planta,
      $departamento,
      $provincia,
      $distrito,
      $telefono_fijo,
      $telefono_movil,
      $email,
      $web,
      $contacto_responsable,
      $cargo_contacto,
      $telefono_contacto,
      $email_contacto,
      $id
    );
    $ok = $stmt->execute();
    ob_end_clean();
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'   => $ok ? 'Cliente actualizado correctamente' : 'Error al actualizar cliente'
    ], JSON_UNESCAPED_UNICODE);
    exit;

    // 6) Desactivar
  case 'desactivar':
    $id = (int)($_POST['id'] ?? 0);
    $ok = $conexion->query("UPDATE cliente SET estado=0 WHERE id=$id");
    ob_end_clean();
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'   => $ok ? 'Cliente desactivado' : 'Error al desactivar cliente'
    ], JSON_UNESCAPED_UNICODE);
    exit;

    // 7) Activar
  case 'activar':
    $id = (int)($_POST['id'] ?? 0);
    $ok = $conexion->query("UPDATE cliente SET estado=1 WHERE id=$id");
    ob_end_clean();
    echo json_encode([
      'status' => $ok ? 'success' : 'error',
      'msg'   => $ok ? 'Cliente activado' : 'Error al activar cliente'
    ], JSON_UNESCAPED_UNICODE);
    exit;

    // Por defecto
  default:
    ob_end_clean();
    echo json_encode(['status' => 'error', 'msg' => 'Operación inválida'], JSON_UNESCAPED_UNICODE);
    exit;
}
