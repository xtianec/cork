<?php $pageTitle = 'Proveedor'; ?>
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
          <table id="tblProveedor" class="table color-table inverse-table" style="width:100%">
            <thead style="background-color: #2A3E52; color: white;">
              <tr>
                <th width="5%">ID</th>
                <th width="10%">RUC</th>
                <th width="25%">Razón Social</th>
                <th width="20%">Email</th>
                <th width="15%">Teléfono</th>
                <th width="10%">Estado</th>
                <th width="15%">Opciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalProveedor" tabindex="-1">
      <div class="modal-dialog">
        <form id="formProveedor" class="modal-content needs-validation" novalidate>
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nuevo Proveedor</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>RUC <span class="text-danger">*</span></label>
                <input name="ruc" class="form-control" required maxlength="11" pattern="\d{11}">
                <div class="invalid-feedback">RUC inválido.</div>
              </div>
              <div class="form-group col-md-6">
                <label>Razón Social <span class="text-danger">*</span></label>
                <input name="razon_social" class="form-control" required>
                <div class="invalid-feedback">Complete la razón social.</div>
              </div>
            </div>
            <div class="form-group">
              <label>Categoría</label>
              <select name="categoria_id" class="form-control"></select>
            </div>
            <div class="form-group">
              <label>Dirección</label>
              <input name="direccion" class="form-control">
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
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Teléfono Fijo</label>
                <input name="telefono_fijo" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Teléfono Móvil</label>
                <input name="telefono_movil" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email</label>
                <input name="email" type="email" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Web</label>
                <input name="web" type="url" class="form-control">
              </div>
            </div>
            <hr>
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
                <label>Teléfono Contacto</label>
                <input name="telefono_contacto" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Email Contacto</label>
                <input name="email_contacto" type="email" class="form-control">
              </div>
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
<?php require "layout/footer.php"; ?>
<script>const BASE_URL = '<?= APP_URL ?>';</script>
<script src="<?= APP_URL ?>vistas/js/proveedor.js"></script>
