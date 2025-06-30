// vistas/js/equipomodelo.js
$(function () {
  const ctrl  = 'EquipoModeloController.php';
  const table = $('#tblEquipoModelo').DataTable({
    ajax: {
      url: BASE_URL + 'controlador/' + ctrl + '?op=listar',
      type: 'GET',
      dataSrc: 'data'
    }
  });

  // ─── Nuevo ─────────────────────────────────────────
  $('#btnNuevoEquipoModelo').click(() => {
    $('#formEquipoModelo')[0].reset();
    $('#equipoModelo_id').val('');
    $('#modalEquipoModelo .modal-title').text('Nuevo Equipo Modelo');
    $('#modalEquipoModelo').modal('show');
  });

  // ─── Editar ────────────────────────────────────────
  $('#tblEquipoModelo').on('click', '.btn-edit-equipomodelo', function () {
    const id = $(this).data('id');
    $.post(BASE_URL + 'controlador/' + ctrl + '?op=mostrar', { id }, r => {
      $('#equipoModelo_id').val(r.id);
      $('#equipoModelo_nombre').val(r.nombre);
      $('#modalEquipoModelo .modal-title').text('Editar Equipo Modelo');
      $('#modalEquipoModelo').modal('show');
    }, 'json');
  });

  // ─── Desactivar ────────────────────────────────────
  $('#tblEquipoModelo').on('click', '.btn-deactivate-equipomodelo', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Desactivar modelo?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, desactivar'
    }).then(res => {
      if (res.isConfirmed) {
        $.post(BASE_URL + 'controlador/' + ctrl + '?op=desactivar', { id }, resp => {
          Swal.fire('', resp.msg, resp.status);
          table.ajax.reload();
        }, 'json');
      }
    });
  });

  // ─── Activar ───────────────────────────────────────
  $('#tblEquipoModelo').on('click', '.btn-activate-equipomodelo', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Activar modelo?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, activar'
    }).then(res => {
      if (res.isConfirmed) {
        $.post(BASE_URL + 'controlador/' + ctrl + '?op=activar', { id }, resp => {
          Swal.fire('', resp.msg, resp.status);
          table.ajax.reload();
        }, 'json');
      }
    });
  });

  // ─── Guardar / Editar ─────────────────────────────
  $('#formEquipoModelo').submit(function (e) {
    e.preventDefault();
    const id = $('#equipoModelo_id').val();
    const op = id ? 'editar' : 'guardar';
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=' + op,
      $(this).serialize(),
      resp => {
        if (resp.status === 'success') {
          $('#modalEquipoModelo').modal('hide');
          Swal.fire('Éxito', resp.msg, 'success');
          table.ajax.reload();
        } else {
          Swal.fire('Error', resp.msg || 'Ocurrió un error', 'error');
        }
      },
      'json'
    );
  });
});
