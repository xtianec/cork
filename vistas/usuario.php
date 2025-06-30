<div class="container-fluid pt-4">
  <div class="d-flex justify-content-between mb-3">
    <h4>Gestión de Usuarios</h4>
    <button id="btnNuevoUsr" class="btn btn-success">
      <i class="fa fa-plus"></i> Nuevo Usuario
    </button>
  </div>
  <table id="tblUsr" class="table table-striped w-100">
    <thead>
      <tr>
        <th>ID</th><th>Usuario</th><th>Estado</th><th>Roles</th><th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<!-- Modal Usuario -->
<div class="modal fade" id="modalUsr" tabindex="-1">
  <div class="modal-dialog">
    <form id="formUsr" class="modal-content needs-validation" novalidate>
      <input type="hidden" name="id">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Usuario</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <!-- username -->
        <div class="form-group">
          <label>Usuario<span class="text-danger">*</span></label>
          <input name="username" class="form-control" required minlength="3">
          <div class="invalid-feedback">Mín. 3 chars.</div>
        </div>
        <!-- password -->
        <div class="form-group">
          <label>Contraseña <small>(nueva)</small></label>
          <input type="password" name="password" class="form-control">
        </div>
        <!-- roles -->
        <div class="form-group">
          <label>Roles<span class="text-danger">*</span></label>
          <select name="roles[]" multiple class="form-control" required></select>
          <div class="invalid-feedback">Seleccione 1 rol.</div>
        </div>
        <!-- estado -->
        <div class="form-group">
          <label>Estado</label>
          <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">
          <span class="spinner-border spinner-border-sm d-none"></span> Guardar
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>
