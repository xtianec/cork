<?php
/*--------------------------------------------------------------
 |  vistas/comprobantes.php
 |  (Backend: Admin-Pro template)
 *-------------------------------------------------------------*/
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>

<div class="container-fluid pt-12">

  <!-- Encabezado -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Comprobantes electrónicos</h3>
    <button id="btnNuevo" class="btn btn-primary">
      <i class="fa fa-plus"></i> Nuevo comprobante
    </button>
  </div>

  <!-- Tabla -->
  <table id="tblComprobantes" class="table table-striped w-100">
    <thead>
      <tr>
        <th>#</th><th>Tipo</th><th>Serie-N°</th><th>Cliente</th>
        <th>Fecha</th><th>Total</th><th>Estado</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<!-- Modal alta / edición -->
<div id="modalComprobante" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="formComprobante" class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Registrar Comprobante</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <!-- Cabecera -->
        <div class="form-row">
          <div class="col-md-4">
            <label class="mb-0">Tipo</label>
            <select name="tipo_comprobante" class="form-control">
              <option value="Factura">Factura</option>
              <option value="Boleta">Boleta</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="mb-0">Moneda</label>
            <select name="moneda" class="form-control">
              <option value="PEN">Soles (PEN)</option>
              <option value="USD">Dólares (USD)</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="mb-0">RUC cliente</label>
            <div class="input-group">
              <input name="cliente_ruc" id="cliente_ruc" class="form-control" required>
              <div class="input-group-append">
                <span id="rucSpinner" class="input-group-text d-none">
                  <i class="fas fa-spinner fa-spin"></i>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group mt-2">
          <label class="mb-0">Razón social</label>
          <input id="cliente_nombre" class="form-control" readonly>
        </div>

        <hr>

        <!-- Línea de detalle -->
        <div class="form-row align-items-end">
          <div class="col-md-5">
            <label class="mb-0">Artículo</label>
            <select id="articulo_id" class="form-control"></select>
            <small id="stock_disp" class="text-muted"></small>
          </div>
          <div class="col-md-2">
            <label class="mb-0">Cantidad</label>
            <input id="cantidad" type="number" min="1" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="mb-0">Precio unitario</label>
            <input id="precio_unitario" type="number" step="0.01" class="form-control">
          </div>
          <div class="col-md-2">
            <button type="button" id="addItem" class="btn btn-success btn-block">
              Agregar
            </button>
          </div>
        </div>

        <!-- Tabla detalle -->
        <table class="table table-sm mt-3">
          <thead class="thead-light">
            <tr><th>ID</th><th>Cant</th><th>Precio</th><th>Sub</th><th></th></tr>
          </thead>
          <tbody id="detalles"></tbody>
        </table>

      </div><!-- /modal-body -->

      <div class="modal-footer">
        <button class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </form>
  </div>
</div>


<script>
const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/comprobantes.js"></script>

<?php
require 'layout/footer.php';
?>
