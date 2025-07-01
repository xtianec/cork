<?php
$pageTitle = 'Dashboard Inventario';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <div class="row">
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
          <h5 class="card-title">Movimientos</h5>
          <p class="display-4" id="countMovimientos">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Marcas</h5>
          <p class="display-4" id="countMarcas">0</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Líneas</h5>
          <p class="display-4" id="countLineas">0</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div id="chartArticulosMarca" style="height:350px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'layout/footer.php'; ?>
<script>
  window.BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>app/template/cork/plugins/apex/apexcharts.min.js"></script>
<script src="<?= APP_URL ?>vistas/js/dashboardInventario.js"></script>
