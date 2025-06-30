<?php $pageTitle = 'Equipo Tipo'; ?>
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
        <table id="tblEquipoTipo" class="table table-striped table-bordered" style="width:100%">
          <thead style="background-color: #2A3E52; color: white;">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalEquipoTipo" tabindex="-1">
    <div class="modal-dialog">
      <form id="formEquipoTipo" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Tipo de Equipo</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="nombre">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
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

<!-- 1) Defino BASE_URL -->
<script>const BASE_URL = '<?= APP_URL ?>';</script>
<!-- 2) Cargo tu lógica de EquipoTipo -->
<script src="<?= APP_URL ?>vistas/js/equipotipo.js"></script>
