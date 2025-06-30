<?php 
  // vistas/cliente.php
  $pageTitle = 'Gestión de Clientes';
  require 'layout/header.php';
  require 'layout/navbar.php';
  require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <!-- Título / Breadcrumb -->
  <div class="row page-titles">
    <div class="col-md-5"><h3><?= $pageTitle ?></h3></div>
    <div class="col-md-7">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= APP_URL ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Cliente</li>
      </ol>
    </div>
  </div>

  <!-- Botón + Tabla -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <button id="btnNuevoCliente" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Nuevo Cliente
      </button>
      <div class="table-responsive">
        <table id="tblCliente"
               class="table table-striped table-hover nowrap"
               style="width:100%">
          <thead>
            <tr>
              <th>ID</th><th>RUC</th><th>Razón Social</th>
              <th>Categoría</th><th>Estado</th><th>F. Registro</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal con pestañas -->
<div class="modal fade" id="modalCliente" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <form id="formCliente" class="modal-content needs-validation" novalidate>
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="clienteTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#datos-generales">Generales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#direccion">Ubicación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#contacto">Contacto</a>
          </li>
        </ul>
        <div class="tab-content pt-3">
          <!-- Generales -->
          <div class="tab-pane fade show active" id="datos-generales">
            <input type="hidden" name="id">
            <input type="hidden" name="estado" value="1">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>RUC <span class="text-danger">*</span></label>
                <input name="ruc" class="form-control" required maxlength="11" pattern="\d{11}">
                <div class="invalid-feedback">RUC inválido (11 dígitos).</div>
              </div>
              <div class="form-group col-md-8">
                <label>Razón Social <span class="text-danger">*</span></label>
                <input name="razon_social" class="form-control" required>
                <div class="invalid-feedback">Complete la razón social.</div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Categoría <span class="text-danger">*</span></label>
                <select name="categoria_id" class="form-control" required></select>
                <div class="invalid-feedback">Seleccione una categoría.</div>
              </div>
              <div class="form-group col-md-4">
                <label>Teléfono Fijo</label>
                <input name="telefono_fijo" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label>Teléfono Móvil</label>
                <input name="telefono_movil" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email</label>
                <input name="email" type="email" class="form-control">
                <div class="invalid-feedback">Email inválido.</div>
              </div>
              <div class="form-group col-md-6">
                <label>Web</label>
                <input name="web" type="url" class="form-control">
                <div class="invalid-feedback">URL inválida.</div>
              </div>
            </div>
          </div>
          <!-- Ubicación -->
          <div class="tab-pane fade" id="direccion">
            <div class="form-group">
              <label>Dirección Fiscal</label>
              <input name="direccion_fiscal" class="form-control">
            </div>
            <div class="form-group">
              <label>Dirección Planta</label>
              <input name="direccion_planta" class="form-control">
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Departamento</label>
                <input name="departamento" class="form-control" list="lista-departamentos">
                <datalist id="lista-departamentos"></datalist>
              </div>
              <div class="form-group col-md-4">
                <label>Provincia</label>
                <input name="provincia" class="form-control" list="lista-provincias">
                <datalist id="lista-provincias"></datalist>
              </div>
              <div class="form-group col-md-4">
                <label>Distrito</label>
                <input name="distrito" class="form-control" list="lista-distritos">
                <datalist id="lista-distritos"></datalist>
              </div>
            </div>
          </div>
          <!-- Contacto -->
          <div class="tab-pane fade" id="contacto">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Responsable</label>
                <input name="contacto_responsable" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Cargo</label>
                <input name="cargo_contacto" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Teléfono</label>
                <input name="telefono_contacto" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Email Contacto</label>
                <input name="email_contacto" type="email" class="form-control">
                <div class="invalid-feedback">Email de contacto inválido.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<?php require 'layout/footer.php'; ?>

<!-- Inicializamos la URL base y cargamos sólo un .js -->
<script>const BASE_URL = '<?= APP_URL ?>';</script>
<script src="<?= APP_URL ?>vistas/js/cliente.js"></script>
