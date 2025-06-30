<!-- Modal Rol -->
<div class="modal fade" id="modalRol" tabindex="-1"><div class="modal-dialog">
  <form id="formRol" class="modal-content needs-validation" novalidate>
    <input type="hidden" name="id">
    <div class="modal-header bg-success text-white">
      <h5 class="modal-title">Rol</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>Nombre <span class="text-danger">*</span></label>
        <input name="nombre" class="form-control" required minlength="3">
        <div class="invalid-feedback">Mínimo 3 caracteres.</div>
      </div>
      <div class="form-group">
        <label>Estado</label>
        <select name="estado" class="form-control">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" type="submit">
        <span class="spinner-border spinner-border-sm d-none"></span> Guardar
      </button>
      <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
  </form>
</div></div>

<!-- Modal Permiso -->
<div class="modal fade" id="modalPermiso" tabindex="-1"><div class="modal-dialog">
  <form id="formPermiso" class="modal-content needs-validation" novalidate>
    <input type="hidden" name="id">
    <div class="modal-header bg-success text-white">
      <h5 class="modal-title">Permiso</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>Módulo<span class="text-danger">*</span></label>
        <select name="modulo_id" class="form-control" required></select>
        <div class="invalid-feedback">Seleccione módulo.</div>
      </div>
      <div class="form-group">
        <label>Acción<span class="text-danger">*</span></label>
        <input name="accion" class="form-control" required minlength="3">
        <div class="invalid-feedback">Mín. 3 caracteres.</div>
      </div>
      <div class="form-group">
        <label>Estado</label>
        <select name="estado" class="form-control">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" type="submit">
        <span class="spinner-border spinner-border-sm d-none"></span> Guardar
      </button>
      <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
  </form>
</div></div>

<!-- Modal Módulo -->
<div class="modal fade" id="modalModulo" tabindex="-1"><div class="modal-dialog">
  <form id="formModulo" class="modal-content needs-validation" novalidate>
    <input type="hidden" name="id">
    <div class="modal-header bg-success text-white">
      <h5 class="modal-title">Módulo</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>Nombre<span class="text-danger">*</span></label>
        <input name="nombre" class="form-control" required minlength="3">
        <div class="invalid-feedback">Mín. 3 caracteres.</div>
      </div>
      <div class="form-group">
        <label>Ruta</label>
        <input name="ruta" class="form-control">
      </div>
      <div class="form-group">
        <label>Estado</label>
        <select name="estado" class="form-control">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" type="submit">
        <span class="spinner-border spinner-border-sm d-none"></span> Guardar
      </button>
      <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
  </form>
</div></div>
