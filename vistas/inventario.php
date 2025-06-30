<?php $pageTitle = 'Inventario: Líneas, Sub-líneas, Marcas, Tipos Artículo y Unidades de Medida'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>

<div class="container-fluid pt-4">
    <!-- Título y breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5">
            <h3 class="text-themecolor"><?= $pageTitle ?></h3>
        </div>
        <div class="col-md-7">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= APP_URL ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Inventario</li>
            </ol>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="invTab" role="tablist">
                <?php
                // Ahora con 5 pestañas
                $tabs = [
                    'linea'        => 'Líneas',
                    'sublinea'     => 'Sub-líneas',
                    'marca'        => 'Marcas',
                    'tipoArt'      => 'Tipos Artículo',
                    'unidadMedida' => 'Unidades de Medida',
                ];
                $first = true;
                foreach ($tabs as $key => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $first ? 'active' : '' ?>"
                            id="tab-<?= $key ?>"
                            data-toggle="tab"
                            href="#<?= $key ?>"
                            role="tab"><?= $label ?></a>
                    </li>
                <?php
                    $first = false;
                endforeach;
                ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-3">
                <?php
                $first = true;
                foreach ($tabs as $key => $label):
                    $Uc = ucfirst($key);
                ?>
                    <div class="tab-pane fade <?= $first ? 'show active' : '' ?>" id="<?= $key ?>" role="tabpanel">
                        <button id="btnNuevo<?= $Uc ?>" class="btn btn-success mb-3">
                            <i class="fa fa-plus"></i> Nuevo <?= $label ?>
                        </button>

                        <div class="table-responsive">
                            <table id="tbl<?= $Uc ?>" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background:#2A3E52;color:#fff">
                                    <tr>
                                        <th>ID</th>
                                        <th>Descripción</th>
                                        <?php if ($key === 'sublinea'): ?>
                                            <th>Línea</th>
                                        <?php endif; ?>
                                        <?php if ($key === 'unidadMedida'): ?>
                                            <!-- Para unidadMedida no necesitamos columna extra -->
                                        <?php endif; ?>
                                        <th>F. Creación</th>
                                        <th>F. Actualización</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modal<?= $Uc ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form id="form<?= $Uc ?>" class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Nuevo <?= $label ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="<?= $key ?>_id" name="id">

                                        <?php if ($key === 'sublinea'): ?>
                                            <div class="form-group">
                                                <label for="sublinea_linea_id">Línea</label>
                                                <select id="sublinea_linea_id" name="linea_id" class="form-control" required>
                                                    <!-- Se carga dinámicamente en JS -->
                                                </select>
                                            </div>
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <label for="<?= $key ?>_descripcion">Descripción</label>
                                            <input type="text"
                                                id="<?= $key ?>_descripcion"
                                                name="descripcion"
                                                class="form-control"
                                                required>
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
                <?php
                    $first = false;
                endforeach;
                ?>
            </div>
        </div>

    </div>
</div>

<?php require 'layout/footer.php'; ?>

<script>
    const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/inventario.js"></script>