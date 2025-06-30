<?php
$pageTitle = 'Dashboard por Módulo';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <div class="row mb-3">
    <div class="col-sm-4">
      <select id="selectModulo" class="form-select">
        <option value="inventario">Inventario</option>
        <option value="seguridad">Seguridad</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div id="modChart"></div>
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
<script src="<?= APP_URL ?>vistas/js/dashboardModuloGraficos.js"></script>
