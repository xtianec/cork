<?php $pageTitle = 'Vacaciones'; ?>
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
          <table id="tblVacacion" class="table color-table inverse-table" style="width:100%">
            <thead style="background-color: #2A3E52; color: white;">
              <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Días</th>
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
    <div class="modal fade" id="modalVacacion" tabindex="-1">
      <div class="modal-dialog">
        <form id="formVacacion" class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nuevo Vacaciones</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Empleado</label>
              <select name="empleado_id" class="form-control" required></select>
            </div>
            <div class="form-group">
              <label>Fecha Inicio</label>
              <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Fecha Fin</label>
              <input type="date" name="fecha_fin" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Días</label>
              <input type="number" name="dias" class="form-control" min="1" required>
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
    controller: 'VacacionController.php',
    tableId: 'tblVacacion',
    modalId: 'modalVacacion',
    formId: 'formVacacion'
  };

  $('#modalVacacion').on('show.bs.modal', function () {
    const select = $('#formVacacion select[name="empleado_id"]');
    $.get(window.BASE_URL + 'controlador/VacacionController.php?op=selectEmpleado', function (html) {
      select.html(html);
    });
  });
</script>
<script src="<?= APP_URL ?>vistas/js/init-crud.js"></script>
