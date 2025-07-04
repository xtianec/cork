<?php
// vistas/movimiento.php
$pageTitle = 'Movimientos de Almacén';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container-fluid pt-12">

  <!-- Encabezado -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= htmlspecialchars($pageTitle) ?></h3>
    <button id="btnNuevoMov" class="btn btn-primary">
      <i class="fa fa-plus"></i> Nuevo Movimiento
    </button>
  </div>

  <!-- Tabs -->
  <ul class="nav nav-tabs mb-3" id="tabs">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#movimientos">Movimientos</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kardex">Kardex</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#inventario">Inventario</a></li>
  </ul>

  <div class="tab-content">

    <!-- ░░ Movimientos ░░ -->
    <div class="tab-pane fade show active" id="movimientos">

      <div class="row mb-3 align-items-end">
        <div class="col-md-3">
          <label for="minDate">Desde</label>
          <input id="minDate" type="date" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="maxDate">Hasta</label>
          <input id="maxDate" type="date" class="form-control">
        </div>
        <div class="col-md-6 text-md-end">
          <div id="exportBtns"></div>
        </div>
      </div>

      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <table id="tblMov" class="table table-striped table-hover w-100">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Artículo</th>
                <th>Tipo</th>
                <th class="text-end">Entrada</th>
                <th class="text-end">Salida</th>
                <th class="text-end">Precio</th>
                <th>Referencia</th>
                <th class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </section>

    </div><!-- /tab movimientos -->

    <!-- ░░ Kardex ░░ -->
    <div class="tab-pane fade" id="kardex">

      <div class="row mb-3 align-items-end">
        <div class="col-md-3">
          <label for="kMinDate">Desde</label>
          <input id="kMinDate" type="date" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="kMaxDate">Hasta</label>
          <input id="kMaxDate" type="date" class="form-control">
        </div>
        <div class="col-md-6 text-md-end">
          <div id="kExportBtns"></div>
        </div>
      </div>

      <section class="card shadow-sm">
        <div class="card-body">

          <div class="form-group mb-3">
            <label for="selArt">Artículo:</label>
            <select id="selArt" class="form-control"></select>
          </div>

          <table id="tblKardex" class="table table-bordered w-100">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th class="text-end">Entrada</th>
                <th class="text-end">Salida</th>
                <th class="text-end">Saldo</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

        </div>
      </section>

    </div><!-- /tab kardex -->

    <!-- ░░ Inventario ░░ -->
    <div class="tab-pane fade" id="inventario">

      <div class="row mb-3 align-items-end">
        <div class="col-md-3">
          <label>Línea</label>
          <input id="qLinea" type="text" class="form-control" placeholder="Escribe línea…">
        </div>
        <div class="col-md-3">
          <label>Sub-línea</label>
          <input id="qSub" type="text" class="form-control" placeholder="Escribe sub-línea…">
        </div>
        <div class="col-md-3">
          <label>Marca</label>
          <input id="qMarca" type="text" class="form-control" placeholder="Escribe marca…">
        </div>
        <div class="col-md-3 text-md-end">
          <div id="invExportBtns"></div>
        </div>
      </div>

      <section class="card shadow-sm">
        <div class="card-body">
          <table id="tblInv" class="table table-striped w-100">
            <thead>
              <tr>
                <th>Línea</th>
                <th>Sub-línea</th>
                <th>Marca</th>
                <th>Artículo</th>
                <th class="text-end">Stock Actual</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </section>

    </div><!-- /tab inventario -->



    <!-- ==========  MODAL  ========== -->
    <div class="modal fade" id="modalMov" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form id="formMov" class="modal-content needs-validation" novalidate>
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Movimiento</h5>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Línea</label>
                <select id="selLinea" class="form-control"></select>
              </div>
              <div class="form-group col-md-4">
                <label>Sub-línea</label>
                <select id="selSub" class="form-control"></select>
              </div>
              <div class="form-group col-md-4">
                <label>Marca</label>
                <select id="selMarca" class="form-control"></select>
              </div>
            </div>
            <div class="form-group">
              <label>Artículo <span class="text-danger">*</span></label>
              <select name="articulo_id" class="form-control" required></select>
              <div class="invalid-feedback">Seleccione artículo.</div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Tipo <span class="text-danger">*</span></label>
                <select name="tipo_movimiento_id" class="form-control" required></select>
                <div class="invalid-feedback">Seleccione tipo.</div>
              </div>

              <div class="form-group col-md-6">
                <label>Fecha</label>
                <input name="fecha" type="datetime-local" class="form-control"
                  value="<?= date('Y-m-d\TH:i') ?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Cantidad <span class="text-danger">*</span></label>
                <input name="cantidad" type="number" min="1" class="form-control" required>
                <div class="invalid-feedback">Ingrese cantidad.</div>
              </div>

              <div class="form-group col-md-6">
                <label>Precio Unitario</label>
                <input name="precio_unitario" type="number" step="0.01" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label>Referencia</label>
              <input name="referencia" class="form-control">
            </div>
          </div>

          <div class="modal-footer py-2">
            <button class="btn btn-success">
              <span class="spinner-border spinner-border-sm d-none"></span> Guardar
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->

  <?php require 'layout/footer.php'; ?>

  <!-- Inyectar la URL base antes de cargar el script -->
  <script>
    window.BASE_URL = '<?= APP_URL ?>';
  </script>
  <script src="<?= APP_URL ?>vistas/js/almacenMovimiento.js"></script>
