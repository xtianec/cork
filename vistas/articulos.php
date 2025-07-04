<?php $pageTitle = 'Gestión de Artículos'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>

<div class="container-fluid pt-4">
  <!-- Título y botón -->
  <div class="row mb-3">
    <div class="col">
      <h3 class="text-themecolor"><?= $pageTitle ?></h3>
    </div>
    <div class="col text-right">
      <button id="btnNuevoArticulo" class="btn btn-success">
        <i class="fa fa-plus"></i> Nuevo Artículo
      </button>
    </div>
  </div>

  <!-- Pestañas -->
  <ul class="nav nav-tabs" id="invTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="tab-lista" data-toggle="tab" href="#lista-articulos">Lista</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="tab-registro" data-toggle="tab" href="#registro-articulo">Registro</a>
    </li>
  </ul>

  <!-- Contenido de pestañas -->
  <div class="tab-content mt-3">

    <!-- ==== TAB LISTA ==== -->
    <div class="tab-pane fade show active" id="lista-articulos">
      <div class="card shadow-sm">
        <div class="card-body p-0">
          <table id="tblArticulos" class="table table-striped table-bordered mb-0" style="width:100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Línea</th>
                <th>Sub-línea</th>
                <th>UM</th>
                <th>Stock</th>
                <th>Precio Vta.</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ==== TAB REGISTRO ==== -->
    <div class="tab-pane fade" id="registro-articulo">
      <div class="card shadow-sm">
        <div class="card-body">
          <form id="formArticulo" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="id" value="">

            <!-- Primera fila -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="codigo">Código <sup class="text-danger">*</sup></label>
                <input id="codigo" name="codigo" class="form-control" required>
              </div>
              <div class="form-group col-md-3">
                <label for="numero_parte">Núm. Parte</label>
                <input id="numero_parte" name="numero_parte" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="nombre">Nombre <sup class="text-danger">*</sup></label>
                <input id="nombre" name="nombre" class="form-control" required>
              </div>
            </div>

            <!-- Descripción -->
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" name="descripcion" rows="2" class="form-control"></textarea>
            </div>

            <!-- Partes -->
            <div class="form-group">
              <label>Partes</label>
              <table class="table table-sm" id="tblPartes">
                <thead>
                  <tr><th>Parte</th><th></th></tr>
                </thead>
                <tbody></tbody>
              </table>
              <button type="button" id="btnAddParte" class="btn btn-secondary btn-sm">Agregar Parte</button>
            </div>

            <!-- Selects -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="marca_id">Marca <sup class="text-danger">*</sup></label>
                <select id="marca_id" name="marca_id" class="form-control" required>
                  <option value="">-- Selecciona Marca --</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="linea_id">Línea <sup class="text-danger">*</sup></label>
                <select id="linea_id" name="linea_id" class="form-control" required>
                  <option value="">-- Selecciona Línea --</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="sublinea_id">Sub-línea</label>
                <select id="sublinea_id" name="sublinea_id" class="form-control">
                  <option value="">-- Selecciona Sub-línea --</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="unidad_medida_id">U. Medida <sup class="text-danger">*</sup></label>
                <select id="unidad_medida_id" name="unidad_medida_id" class="form-control" required>
                  <option value="">-- Selecciona U. Medida --</option>
                </select>
              </div>
            </div>

            <!-- Números -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="stock_minimo">Stock Mínimo</label>
                <input id="stock_minimo" name="stock_minimo" type="number" min="0" class="form-control" value="0">
              </div>
              <div class="form-group col-md-3">
                <label for="stock_maximo">Stock Máximo</label>
                <input id="stock_maximo" name="stock_maximo" type="number" min="0" class="form-control">
              </div>
              <div class="form-group col-md-3">
                <label for="precio_costo">Precio Costo</label>
                <input id="precio_costo" name="precio_costo" type="number" step="0.01" min="0" class="form-control" value="0.00">
              </div>
              <div class="form-group col-md-3">
                <label for="precio_venta">Precio Venta</label>
                <input id="precio_venta" name="precio_venta" type="number" step="0.01" min="0" class="form-control" value="0.00">
              </div>
            </div>

            <!-- Imagen -->
            <div class="form-group">
              <label for="imagen">Imagen</label>
              <div class="custom-file">
                <input type="file" name="imagen" id="imagen" class="custom-file-input">
                <label class="custom-file-label" for="imagen">Selecciona archivo…</label>
              </div>
              <img id="imgPreview" src="#" class="img-thumbnail mt-2" style="max-height:120px; display:none;">
            </div>

            <!-- Botones -->
            <div class="text-right">
              <button type="submit" class="btn btn-primary px-4">
                <i class="fa fa-save"></i> Guardar
              </button>
              <button type="button" class="btn btn-secondary px-4" data-toggle="tab" href="#lista-articulos">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require 'layout/footer.php'; ?>

<!-- Inyectar la URL base antes de cargar el script -->
<script>
  window.BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/articulos.js"></script>