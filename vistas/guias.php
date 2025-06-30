<button id="btnNuevaGuia" class="btn btn-primary">Nueva Guía</button>

<table id="tblGuias" class="table table-bordered mt-3">
  <thead>
    <tr>
      <th>#</th><th>Serie-Numero</th><th>Fecha</th><th>Cliente</th><th>Motivo</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<!-- Modal Formulario -->
<div id="modalGuia" class="modal fade">
  <div class="modal-dialog">
    <form id="formGuia" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Nueva Guía Electrónica</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <input name="serie" placeholder="Serie" required class="form-control mb-2">
        <input name="numero" placeholder="Número" required type="number" class="form-control mb-2">
        <input name="fecha_emision" type="datetime-local" class="form-control mb-2">
        <input name="cliente_id" placeholder="ID Cliente" required class="form-control mb-2">
        <input name="direccion_partida" placeholder="Dirección partida" class="form-control mb-2">
        <input name="direccion_llegada" placeholder="Dirección llegada" class="form-control mb-2">
        <input name="motivo_traslado" placeholder="Motivo traslado" class="form-control mb-2">
        <input name="modalidad_traslado" placeholder="Modalidad traslado" class="form-control mb-2">
        <input name="transportista_ruc" placeholder="RUC Transportista" class="form-control mb-2">
        <input name="placa_vehiculo" placeholder="Placa Vehículo" class="form-control mb-2">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>
