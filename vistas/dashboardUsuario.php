<?php
$pageTitle = 'Dashboard Usuario';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <div class="row">
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Clientes</h5>
          <p class="display-4" id="countClientes">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Proveedores</h5>
          <p class="display-4" id="countProveedores">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Artículos</h5>
          <p class="display-4" id="countArticulos">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Usuarios</h5>
          <p class="display-4" id="countUsuarios">0</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'layout/footer.php'; ?>
<script>
  window.BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/dashboardUsuario.js"></script>
