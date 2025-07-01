<?php $pageTitle = 'Cotizacion'; ?>
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
          <table id="tblCotizacion" class="table color-table inverse-table" style="width:100%">
            <thead style="background-color: #2A3E52; color: white;">
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Activo</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalCotizacion" tabindex="-1">
      <div class="modal-dialog">
        <form id="formCotizacion" class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nueva Cotización</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label for="cot_cli">Cliente ID</label>
              <input type="number" name="cliente_id" id="cot_cli" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="cot_fecha">Fecha</label>
              <input type="date" name="fecha" id="cot_fecha" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="cot_monto">Monto Total</label>
              <input type="number" step="0.01" name="monto_total" id="cot_monto" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="cot_estado">Estado ID</label>
              <input type="number" name="estado_id" id="cot_estado" class="form-control" required>
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
    controller: 'CotizacionController.php',
    tableId: 'tblCotizacion',
    modalId: 'modalCotizacion',
    formId: 'formCotizacion'
  };
</script>
<script src="<?= APP_URL ?>vistas/js/init-crud.js"></script>
