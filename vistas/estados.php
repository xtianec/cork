<?php
$pageTitle = 'Gestión de Estados';
require 'layout/header.php';
require 'layout/navbar.php';
require 'layout/sidebar.php';

// Define aquí tus pestañas:
$tabs = [
    'estadoCotizacion'   => 'Cotización',
    'estadoDocumento'    => 'Documento',
    'estadoEquipos'      => 'Equipos',
    'estadoOrdenCompra'  => 'Orden Compra',
    'estadoOrdenTrabajo' => 'Orden Trabajo',
];
?>

<div class="container-fluid pt-4">
    <!-- Título y breadcrumb -->
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
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="estadosTab" role="tablist">
                <?php $active = 'active';
                foreach ($tabs as $id => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $active ?>" id="tab-<?= $id ?>"
                            data-toggle="tab" href="#<?= $id ?>" role="tab">
                            <?= $label ?>
                        </a>
                    </li>
                <?php $active = '';
                endforeach; ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-3">
                <?php $active = 'show active';
                foreach ($tabs as $id => $label):
                    $Uc = ucfirst($id);
                ?>
                    <div class="tab-pane fade <?= $active ?>" id="<?= $id ?>" role="tabpanel">
                        <button id="btnNuevo<?= $Uc ?>" class="btn btn-success mb-3">
                            <i class="fa fa-plus"></i> Nuevo <?= $label ?>
                        </button>

                        <div class="table-responsive">
                            <table id="tbl<?= $Uc ?>" class="table table-striped table-bordered w-100">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Descripción</th>
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
                        <div class="modal fade" id="modal<?= $Uc ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form id="form<?= $Uc ?>" class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Nuevo <?= $label ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="<?= $id ?>_id" name="id">
                                        <div class="form-group">
                                            <label for="<?= $id ?>_descripcion">Descripción</label>
                                            <input type="text"
                                                id="<?= $id ?>_descripcion"
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
                    $active = '';
                endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php require 'layout/footer.php'; ?>

<script>
    const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/estados.js"></script>