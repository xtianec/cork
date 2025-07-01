<?php $pageTitle = 'Orden Trabajo'; ?>
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
          <table id="tblOrdenTrabajo" class="table color-table inverse-table" style="width:100%">
            <thead id="tblHead" style="background-color: #2A3E52; color: white;"></thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalOrdenTrabajo" tabindex="-1">
      <div class="modal-dialog">
        <form id="formOrdenTrabajo" class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nueva Orden Trabajo</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="formFields"></div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-light">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require "layout/footer.php"; ?>
<script>
  window.BASE_URL = '<?= APP_URL ?>';
  window.CRUD_CONFIG = {
    controller: 'OrdenTrabajoController.php',
    tableId: 'tblOrdenTrabajo',
    modalId: 'modalOrdenTrabajo',
    formId: 'formOrdenTrabajo'
  };
</script>
<script src="<?= APP_URL ?>vistas/js/init-crud.js"></script>
