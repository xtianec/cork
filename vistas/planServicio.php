<?php $pageTitle = 'Gestión de Planes'; ?>
<?php require 'layout/header.php'; ?>
<?php require 'layout/navbar.php'; ?>
<?php require 'layout/sidebar.php'; ?>
<div class="container-fluid pt-4">
  <h3 class="mb-3"><?= htmlspecialchars($pageTitle) ?></h3>
  <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabServ">Planes Servicio</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabHoras">Planes Horas</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabPrecios">Planes Precios</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabPS">Precios Servicios</a></li>
  </ul>
  <div class="tab-content pt-3">
    <!-- Planes Servicio -->
    <div id="tabServ" class="tab-pane fade show active">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Planes Servicio</span>
          <button id="btnNewServ" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="tblPlanServicio" class="table table-striped w-100">
            <thead>
              <tr><th>ID</th><th>Descripción</th><th>Acción</th></tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Planes Horas -->
    <div id="tabHoras" class="tab-pane fade">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Planes Horas</span>
          <button id="btnNewHoras" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="tblPlanesHoras" class="table table-striped w-100">
            <thead>
              <tr><th>ID</th><th>Horas</th><th>Descripción</th><th>Acción</th></tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Planes Precios -->
    <div id="tabPrecios" class="tab-pane fade">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Planes Precios</span>
          <button id="btnNewPrecios" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="tblPlanesPrecios" class="table table-striped w-100">
            <thead>
              <tr>
                <th>Modelo</th><th>Plan</th><th>Mano Obra</th><th>Materiales</th><th>Terceros</th><th>Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Planes Precios Servicios -->
    <div id="tabPS" class="tab-pane fade">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-bold">Precios por Servicio</span>
          <button id="btnNewPS" class="btn btn-success">+ Nuevo</button>
        </div>
        <div class="card-body">
          <table id="tblPlanesPreciosServ" class="table table-striped w-100">
            <thead>
              <tr>
                <th>Modelo</th><th>Plan A</th><th>Plan B</th><th>Plan C</th><th>Plan D</th><th>Acción</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modales -->
<div class="modal fade" id="modalPlanServicio" tabindex="-1">
  <div class="modal-dialog">
    <form id="formPlanServicio" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Plan Servicio</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="form-group" id="groupPlanId">
          <label>ID</label>
          <input type="text" name="plan_id" class="form-control" maxlength="2">
        </div>
        <div class="form-group">
          <label>Descripción</label>
          <input type="text" name="plan_desc" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-light">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalPlanesHoras" tabindex="-1">
  <div class="modal-dialog">
    <form id="formPlanesHoras" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Plan Horas</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="form-group">
          <label>Plan</label>
          <select name="plan_id" class="form-control"></select>
        </div>
        <div class="form-group">
          <label>Horas</label>
          <input type="number" name="horas_plan" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Descripción</label>
          <input type="text" name="plan_desc" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-light">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalPlanesPrecios" tabindex="-1">
  <div class="modal-dialog">
    <form id="formPlanesPrecios" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Plan Precio</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="form-group">
          <label>Modelo Equipo</label>
          <select name="modelo_equipo_id" class="form-control"></select>
        </div>
        <div class="form-group">
          <label>Plan</label>
          <select name="plan_id" class="form-control"></select>
        </div>
        <div class="form-group">
          <label>Mano de Obra</label>
          <input type="number" step="0.01" name="precio_manoobra" class="form-control">
        </div>
        <div class="form-group">
          <label>Materiales</label>
          <input type="number" step="0.01" name="precio_materiales" class="form-control">
        </div>
        <div class="form-group">
          <label>Terceros</label>
          <input type="number" step="0.01" name="terceros" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-light">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalPlanesPreciosServ" tabindex="-1">
  <div class="modal-dialog">
    <form id="formPlanesPreciosServ" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Precios Servicio</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="max-height:60vh;overflow:auto;">
        <input type="hidden" name="id">
        <div class="form-group">
          <label>Modelo Equipo</label>
          <select name="modelo_equipo_id" class="form-control"></select>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>Plan A Mano Obra</label>
            <input type="number" step="0.01" name="plana_manoobra" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan A Materiales</label>
            <input type="number" step="0.01" name="plana_materiales" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan A Terceros</label>
            <input type="number" step="0.01" name="plana_terceros" class="form-control">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">
            <label>Plan B Mano Obra</label>
            <input type="number" step="0.01" name="planb_manoobra" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan B Materiales</label>
            <input type="number" step="0.01" name="planb_materiales" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan B Terceros</label>
            <input type="number" step="0.01" name="planb_terceros" class="form-control">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">
            <label>Plan C Mano Obra</label>
            <input type="number" step="0.01" name="planc_manoobra" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan C Materiales</label>
            <input type="number" step="0.01" name="planc_materiales" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan C Terceros</label>
            <input type="number" step="0.01" name="planc_terceros" class="form-control">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">
            <label>Plan D Mano Obra</label>
            <input type="number" step="0.01" name="pland_manoobra" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan D Materiales</label>
            <input type="number" step="0.01" name="pland_materiales" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Plan D Terceros</label>
            <input type="number" step="0.01" name="pland_terceros" class="form-control">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">
            <label>Semestral Mano Obra</label>
            <input type="number" step="0.01" name="plan_semestral_manoobra" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Semestral Materiales</label>
            <input type="number" step="0.01" name="plan_semestral_materiales" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Semestral Terceros</label>
            <input type="number" step="0.01" name="plan_semestral_terceros" class="form-control">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">
            <label>Anual Mano Obra</label>
            <input type="number" step="0.01" name="plan_anual_manoobra" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Anual Materiales</label>
            <input type="number" step="0.01" name="plan_anual_materiales" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Anual Terceros</label>
            <input type="number" step="0.01" name="plan_anual_terceros" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-light">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<?php require 'layout/footer.php'; ?>
<script>
  const BASE_URL = '<?= APP_URL ?>';
</script>
<script src="<?= APP_URL ?>vistas/js/planServicio.js"></script>
