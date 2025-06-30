<?php
$pageTitle = 'Dashboard Roles';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';
?>
<div class="container-fluid pt-4">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div id="chartUsuariosRol" style="height:350px;"></div>
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
<script src="<?= APP_URL ?>vistas/js/dashboardRoles.js"></script>
