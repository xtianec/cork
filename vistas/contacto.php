<?php $pageTitle = 'Contacto'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>

<div class="container-fluid pt-4">
  <!-- Título y breadcrumb -->
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
      <button id="btnNuevoContacto" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Nuevo
      </button>
      <div class="table-responsive">
        <table id="tblContacto" class="table color-table inverse-table" style="width:100%">
          <thead style="background-color: #2A3E52; color: white;">
            <tr>
              <th width="5%">ID</th>
              <th width="20%">Nombre</th>
              <th width="15%">Cargo</th>
              <th width="15%">Teléfono</th>
              <th width="20%">Email</th>
              <th width="10%">Estado</th>
              <th width="15%">Opciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalContacto" tabindex="-1">
    <div class="modal-dialog">
      <form id="formContacto" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo Contacto</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="contacto_id" name="id">
          <div class="form-group">
            <label for="contacto_nombre">Nombre</label>
            <input type="text" id="contacto_nombre" name="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="contacto_cargo">Cargo</label>
            <input type="text" id="contacto_cargo" name="cargo" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="contacto_telefono">Teléfono</label>
            <input type="text" id="contacto_telefono" name="telefono" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="contacto_email">Email</label>
            <input type="email" id="contacto_email" name="email" class="form-control" required>
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

<!-- definición de BASE_URL -->
<script>const BASE_URL = '<?= APP_URL ?>';</script>
<!-- carga del script de lógica -->
<script src="<?= APP_URL ?>vistas/js/contacto.js"></script>
