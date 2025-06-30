<?php $pageTitle = 'Equipo Modelo'; ?>
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

  <!-- Card con tabla -->
  <div class="card">
    <div class="card-body">
      <button id="btnNuevoEquipoModelo" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Nuevo
      </button>
      <div class="table-responsive">
        <table id="tblEquipoModelo" class="table color-table inverse-table" style="width:100%">
          <thead style="background-color: #2A3E52; color: white;">
            <tr>
              <th width="5%">ID</th>
              <th width="50%">Nombre</th>
              <th width="10%">F. Creación</th>
              <th width="10%">F. Actualización</th>
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
  <div class="modal fade" id="modalEquipoModelo" tabindex="-1">
    <div class="modal-dialog">
      <form id="formEquipoModelo" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo Equipo Modelo</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="equipoModelo_id" name="id">
          <div class="form-group">
            <label for="equipoModelo_nombre">Nombre</label>
            <input type="text" id="equipoModelo_nombre" name="nombre" class="form-control" required>
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

<script>const BASE_URL = '<?= APP_URL ?>';</script>
<script src="<?= APP_URL ?>vistas/js/equipomodelo.js"></script>
