<?php $pageTitle = 'Estado Cotización'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>

<div class="container-fluid pt-4">
  <!-- título y breadcrumb -->
  <div class="row page-titles">
    <div class="col-md-5">
      <h3 class="text-themecolor"><?= $pageTitle ?></h3>
    </div>
    <div class="col-md-7">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= APP_URL ?>">Inicio</a></li>
        <li class="breadcrumb-item active"><?= $pageTitle ?></li>
      </ol>
    </div>
  </div>

  <!-- tabla y botón Nuevo -->
  <div class="card">
    <div class="card-body">
      <button id="btnNuevoEstadoCot" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Nuevo
      </button>
      <div class="table-responsive">
        <table id="tblEstadoCotizacion" class="table table-striped table-bordered" style="width:100%">
          <thead style="background-color:#2A3E52;color:#fff">
            <tr>
              <th>ID</th>
              <th>Descripción</th>
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

  <!-- modal -->
  <div class="modal fade" id="modalEstadoCotizacion" tabindex="-1">
    <div class="modal-dialog">
      <form id="formEstadoCotizacion" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo Estado Cotización</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="estadoCot_id" name="id">
          <div class="form-group">
            <label for="estadoCot_descripcion">Descripción</label>
            <input type="text" id="estadoCot_descripcion" name="descripcion" class="form-control" required>
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
// constante global para rutas AJAX
const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/estadoCotizacion.js"></script>
