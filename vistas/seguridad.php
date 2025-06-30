<?php
require_once __DIR__ . '/../config/global.php';
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$pageTitle = 'Gestión de Seguridad';
?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/navbar.php'; ?>
<?php include __DIR__ . '/layout/sidebar.php'; ?>



<div class="container-fluid pt-4">
  <h3 class="mb-3"><?= htmlspecialchars($pageTitle) ?></h3>

  <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabUsr">Usuarios</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabRol">Roles</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabPerm">Permisos</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabMod">Módulos</a></li>
  </ul>

  <div class="tab-content pt-3">

    <!-- ░░ USUARIOS ░░ -->
    <div id="tabUsr" class="tab-pane fade show active">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Usuarios</span>
          <button id="btnNewUsr" class="btn btn-primary">
            <i class="fa fa-user-plus"></i> Nuevo
          </button>
        </div>
        <div class="card-body">
          <table id="dtUsr" class="table table-striped w-100">
            <thead>
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Roles</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ░░ ROLES ░░ -->
    <div id="tabRol" class="tab-pane fade">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Roles</span>
          <button id="btnNewRol" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="dtRol" class="table table-striped w-100">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ░░ PERMISOS ░░ -->
    <div id="tabPerm" class="tab-pane fade">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Permisos</span>
          <button id="btnNewPer" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="dtPerm" class="table table-striped w-100">
            <thead>
              <tr>
                <th>ID</th>
                <th>Módulo</th>
                <th>Acción</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ░░ MÓDULOS ░░ -->
    <div id="tabMod" class="tab-pane fade">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Módulos</span>
          <button id="btnNewMod" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="dtMod" class="table table-striped w-100">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ruta</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

  </div><!-- /.tab-content -->
</div><!-- /.container -->

<!-- ────────────────  MODAL USUARIO  ──────────────── -->
<div class="modal fade" id="modalUsuario" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <form id="formUsuario" class="modal-content needs-validation" novalidate>
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
      <input type="hidden" name="id">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Usuario</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 mb-3 form-floating">
            <input type="text" class="form-control" name="username" placeholder="Usuario" required minlength="3">
            <label>Usuario</label>
          </div>
          <div class="col-md-4 mb-3 form-floating">
            <input type="email" class="form-control" name="email" placeholder="correo@dominio" required>
            <label>Correo</label>
          </div>
          <div class="col-md-4 mb-3 form-floating">
            <select class="form-select" name="estado">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select><label>Estado</label>
          </div>

          <!-- dentro .modal-body del modalUsuario -->
          <div class="mb-3">
            <label class="form-label">Accesos por módulo</label>
            <div class="d-flex">
              <select id="selModuloUsr" class="form-control me-2"></select>
              <select id="selRolUsr" class="form-control me-2">
                <option value="">— Rol —</option>
              </select>
              <button id="btnAddAcceso" type="button" class="btn btn-success">Añadir</button>
            </div>
          </div>

          <table id="tblAccesosUsr" class="table table-bordered">
            <thead>
              <tr>
                <th>Módulo</th>
                <th>Rol</th>
                <th style="width:60px"></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
          <input type="hidden" name="accesos_json">


          <div class="col-md-6 mb-3 form-floating position-relative">
            <input type="password" class="form-control" id="password" name="password"
              placeholder="Contraseña" minlength="6">


            <label>Contraseña</label>
            <button type="button"
              class="btn btn-outline-secondary btn-sm position-absolute top-50 end-0 translate-middle-y me-2"
              id="togglePwd"><i class="fa fa-eye"></i></button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">
          <span class="spinner-border spinner-border-sm d-none"></span> Guardar
        </button>
        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- ────────────────  MODAL ROL  ──────────────── -->
<div class="modal fade" id="modalRol" tabindex="-1">
  <div class="modal-dialog">
    <form id="formRol" class="modal-content needs-validation" novalidate>
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"><input type="hidden" name="id">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Rol</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nombre <span class="text-danger">*</span></label>
          <input name="nombre" class="form-control" required minlength="3">
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit">
          <span class="spinner-border spinner-border-sm d-none"></span> Guardar
        </button>
        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- ────────────────  MODAL PERMISO  ──────────────── -->
<div class="modal fade" id="modalPermiso" tabindex="-1">
  <div class="modal-dialog">
    <form id="formPermiso" class="modal-content needs-validation" novalidate>
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"><input type="hidden" name="id">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Permiso</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Módulo <span class="text-danger">*</span></label>
          <select name="modulo_id" class="form-control" required></select>
        </div>
        <div class="form-group">
          <label>Acción <span class="text-danger">*</span></label>
          <input name="accion" class="form-control" required minlength="3">
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit">
          <span class="spinner-border spinner-border-sm d-none"></span> Guardar
        </button>
        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- ────────────────  MODAL MÓDULO  ──────────────── -->
<div class="modal fade" id="modalModulo" tabindex="-1">
  <div class="modal-dialog">
    <form id="formModulo" class="modal-content needs-validation" novalidate>
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"><input type="hidden" name="id">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Módulo</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nombre <span class="text-danger">*</span></label>
          <input name="nombre" class="form-control" required minlength="3">
        </div>
        <div class="form-group">
          <label>Ruta</label>
          <input name="ruta" class="form-control">
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit">
          <span class="spinner-border spinner-border-sm d-none"></span> Guardar
        </button>
        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<!-- ────────────────  MODAL PERMISOS ↔ ROL  ──────────────── -->
<div class="modal fade" id="modalPermRol" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 id="permRolTitle" class="modal-title">Permisos</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="d-flex mb-3">
          <select id="selPermRol" class="form-control me-2"></select>
          <button id="btnAddPermRol" class="btn btn-success">Asignar</button>
        </div>
        <table id="dtPermRol" class="table table-bordered w-100">
          <thead>
            <tr>
              <th>Permiso</th>
              <th style="width:60px">Quitar</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>


<script>
  const BASE_URL = '<?= APP_URL ?>controlador/';
</script>
<script src="<?= APP_URL ?>vistas/js/seguridad.js"></script>