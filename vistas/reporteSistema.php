<?php $pageTitle = 'Reporte del Sistema'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>

<div class="container-fluid pt-4">
    <div class="row page-titles">
        <div class="col-md-5">
            <h3 class="text-themecolor"><?= $pageTitle ?></h3>
        </div>
        <div class="col-md-7">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= APP_URL ?>">Inicio</a></li>
                <li class="breadcrumb-item active"><?= $pageTitle ?></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 align-items-end">
                <div class="col-md-3">
                    <label>Módulo</label>
                    <select id="selModulo" class="form-select">
                        <option value="cliente">Clientes</option>
                        <option value="proveedor">Proveedores</option>
                        <option value="articulo">Artículos</option>
                        <option value="movimiento">Movimientos</option>
                        <option value="usuario">Usuarios</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Fecha Inicio</label>
                    <input type="date" id="fInicio" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-3">
                    <label>Fecha Fin</label>
                    <input type="date" id="fFin" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-3 text-md-end">
                    <button id="btnFiltrar" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
            <div id="chartReporte" style="min-height:300px;"></div>
        </div>
    </div>
</div>

<?php require 'layout/footer.php'; ?>
<script>
    const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>app/template/cork/plugins/apex/apexcharts.min.js"></script>
<script src="<?= APP_URL ?>vistas/js/reporteSistema.js"></script>
