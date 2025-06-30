<?php $pageTitle = 'Reporte de Inventario'; ?>
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
                    <label>Línea</label>
                    <input id="qLinea" type="text" class="form-control" placeholder="Escribe línea…">
                </div>
                <div class="col-md-3">
                    <label>Sub-línea</label>
                    <input id="qSub" type="text" class="form-control" placeholder="Escribe sub-línea…">
                </div>
                <div class="col-md-3">
                    <label>Marca</label>
                    <input id="qMarca" type="text" class="form-control" placeholder="Escribe marca…">
                </div>
                <div class="col-md-3 text-md-end">
                    <div id="exportBtns"></div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tblReporteInv" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>Línea</th>
                            <th>Sub-línea</th>
                            <th>Marca</th>
                            <th>Artículo</th>
                            <th class="text-end">Stock Actual</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require 'layout/footer.php'; ?>
<script>
    const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/reporteInventario.js"></script>

