<?php
$pageTitle = 'Dashboard Seguridad';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <div class="row">
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Usuarios</h5>
          <p class="display-4" id="countUsuarios">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Roles</h5>
          <p class="display-4" id="countRoles">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Permisos</h5>
          <p class="display-4" id="countPermisos">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Módulos</h5>
          <p class="display-4" id="countModulos">0</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'layout/footer.php'; ?>
<script>
  window.BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/dashboardSeguridad.js"></script>
