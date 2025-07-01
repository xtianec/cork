<?php $pageTitle = 'Empleado'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>
  <div class="container-fluid pt-4">
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor"><?= $pageTitle ?></h3>
      </div>
      <div class="col-md-7 align-self-center">
        <ol class="breadcrumb float-right">
          <li class="breadcrumb-item"><a href="<?= APP_URL ?>">Inicio</a></li>
          <li class="breadcrumb-item active"><?= $pageTitle ?></li>
        </ol>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <button id="btnNuevo" class="btn btn-success mb-3">
          <i class="fa fa-plus"></i> Nuevo
        </button>
        <div class="table-responsive">
          <table id="tblEmpleado" class="table color-table inverse-table" style="width:100%">
            <thead style="background-color: #2A3E52; color: white;">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Cargo</th>
                <th>F. Creación</th>
                <th>F. Actualización</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalEmpleado" tabindex="-1">
      <div class="modal-dialog">
        <form id="formEmpleado" class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nuevo Empleado</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Apellido</label>
              <input type="text" name="apellido" class="form-control">
            </div>
            <div class="form-group">
              <label>DNI</label>
              <input type="text" name="dni" class="form-control">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Teléfono</label>
              <input type="text" name="telefono" class="form-control">
            </div>
            <div class="form-group">
              <label>Cargo</label>
              <select name="cargo_id" class="form-control"></select>
            </div>
            <div class="form-group">
              <label>Fecha Ingreso</label>
              <input type="date" name="fecha_ingreso" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-light">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require 'layout/footer.php'; ?>
<script>
  window.BASE_URL = '<?= APP_URL ?>';
  window.CRUD_CONFIG = {
    controller: 'EmpleadoController.php',
    tableId: 'tblEmpleado',
    modalId: 'modalEmpleado',
    formId: 'formEmpleado'
  };

  // cargar cargos en select cuando se abra el modal
  $('#modalEmpleado').on('show.bs.modal', function () {
    const select = $('#formEmpleado select[name="cargo_id"]');
    $.get(window.BASE_URL + 'controlador/EmpleadoController.php?op=selectCargo', function (html) {
      select.html(html);
    });
  });
</script>
<script src="<?= APP_URL ?>vistas/js/init-crud.js"></script>
