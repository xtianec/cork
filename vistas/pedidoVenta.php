<?php $pageTitle = 'Pedido Venta'; ?>
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
          <table id="tblPedidoVenta" class="table color-table inverse-table" style="width:100%">
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
    <div class="modal fade" id="modalPedidoVenta" tabindex="-1">
      <div class="modal-dialog">
        <form id="formPedidoVenta" class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nuevo Pedido</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label for="ped_cli">Cliente ID</label>
              <input type="number" name="cliente_id" id="ped_cli" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="ped_fecha">Fecha</label>
              <input type="date" name="fecha" id="ped_fecha" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="ped_monto">Monto Total</label>
              <input type="number" step="0.01" name="monto_total" id="ped_monto" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="ped_estado">Estado ID</label>
              <input type="number" name="estado_id" id="ped_estado" class="form-control" required>
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
    controller: 'PedidoVentaController.php',
    tableId: 'tblPedidoVenta',
    modalId: 'modalPedidoVenta',
    formId: 'formPedidoVenta'
  };
</script>
<script src="<?= APP_URL ?>vistas/js/init-crud.js"></script>
