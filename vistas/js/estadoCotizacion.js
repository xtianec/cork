// vistas/js/estadoCotizacion.js
$(function () {
  const ctrl  = 'EstadoCotizacionController.php';
  const table = $('#tblEstadoCotizacion').DataTable({
    ajax: {
      url: BASE_URL + 'controlador/' + ctrl + '?op=listar',
      type: 'GET',
      dataSrc: 'data'
    }
  });

  // ─── Abrir modal Nuevo ────────────────────────────
  $('#btnNuevoEstadoCot').click(() => {
    $('#formEstadoCotizacion')[0].reset();
    $('#estadoCot_id').val('');
    $('#modalEstadoCotizacion .modal-title').text('Nuevo Estado Cotización');
    $('#modalEstadoCotizacion').modal('show');
  });

  // ─── Editar ───────────────────────────────────────
  $('#tblEstadoCotizacion').on('click', '.btn-edit-estado', function () {
    const id = $(this).data('id');
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=mostrar',
      { id },
      r => {
        $('#estadoCot_id').val(r.id);
        $('#estadoCot_descripcion').val(r.descripcion);
        $('#modalEstadoCotizacion .modal-title').text('Editar Estado Cotización');
        $('#modalEstadoCotizacion').modal('show');
      },
      'json'
    );
  });

  // ─── Desactivar ───────────────────────────────────
  $('#tblEstadoCotizacion').on('click', '.btn-deactivate-estado', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Desactivar estado?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, desactivar'
    }).then(res => {
      if (res.isConfirmed) {
        $.post(
          BASE_URL + 'controlador/' + ctrl + '?op=desactivar',
          { id },
          resp => {
            Swal.fire('', resp.msg, resp.status);
            table.ajax.reload();
          },
          'json'
        );
      }
    });
  });

  // ─── Activar ──────────────────────────────────────
  $('#tblEstadoCotizacion').on('click', '.btn-activate-estado', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Activar estado?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, activar'
    }).then(res => {
      if (res.isConfirmed) {
        $.post(
          BASE_URL + 'controlador/' + ctrl + '?op=activar',
          { id },
          resp => {
            Swal.fire('', resp.msg, resp.status);
            table.ajax.reload();
          },
          'json'
        );
      }
    });
  });

  // ─── Guardar / Actualizar ─────────────────────────
  $('#formEstadoCotizacion').submit(function (e) {
    e.preventDefault();
    const op = $('#estadoCot_id').val() ? 'editar' : 'guardar';
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=' + op,
      $(this).serialize(),
      resp => {
        if (resp.status === 'success') {
          $('#modalEstadoCotizacion').modal('hide');
          Swal.fire('Éxito', resp.msg, 'success');
          table.ajax.reload();
        } else {
          Swal.fire('Error', resp.msg, 'error');
        }
      },
      'json'
    );
  });
});
