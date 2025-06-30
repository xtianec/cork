<?php
  // vistas/tipo_movimiento_almacen.php
  $pageTitle = 'Tipos de Movimiento de Almacén';
  require 'layout/header.php';
  require 'layout/navbar.php';
  require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <div class="d-flex justify-content-between mb-3">
    <h3><?= $pageTitle ?></h3>
    <button id="btnNuevoTipo" class="btn btn-success">
      <i class="fa fa-plus mr-1"></i> Nuevo Tipo
    </button>
  </div>

  <div class="card shadow-sm">
    <div class="card-body p-2">
      <table id="tblTipoMov" class="table table-striped table-hover nowrap" style="width:100%">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal CRUD -->
<div class="modal fade" id="modalTipo" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form id="formTipo" class="modal-content needs-validation" novalidate>
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Nuevo Tipo</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="form-group">
          <label>Nombre <span class="text-danger">*</span></label>
          <input name="nombre" class="form-control" required>
          <div class="invalid-feedback">Ingrese un nombre.</div>
        </div>
      </div>
      <div class="modal-footer py-2">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-save mr-1"></i> Guardar
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<?php require 'layout/footer.php'; ?>
<script>
    const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/tipoMovimientoAlmacen.js"></script>