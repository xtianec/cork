// vistas/js/equipotipo.js
$(function () {
  const ctrl  = 'EquipoTipoController.php';
  const table = $('#tblEquipoTipo').DataTable({
    ajax: {
      url: BASE_URL + 'controlador/' + ctrl + '?op=listar',
      type: 'GET',
      dataSrc: 'data'
    }
  });

  // ─── Nuevo ─────────────────────────────────────────
  $('#btnNuevo').click(() => {
    $('#formEquipoTipo')[0].reset();
    $('#id').val('');
    $('#modalEquipoTipo .modal-title').text('Nuevo Tipo de Equipo');
    $('#modalEquipoTipo').modal('show');
  });

  // ─── Editar ────────────────────────────────────────
  $('#tblEquipoTipo').on('click', '.editar', function () {
    const id = $(this).data('id');
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=mostrar',
      { id },
      r => {
        $('#id').val(r.id);
        $('#nombre').val(r.nombre);
        $('#modalEquipoTipo .modal-title').text('Editar Tipo de Equipo');
        $('#modalEquipoTipo').modal('show');
      },
      'json'
    );
  });

  // ─── Desactivar ────────────────────────────────────
  $('#tblEquipoTipo').on('click', '.desactivar', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Desactivar tipo de equipo?',
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

  // ─── Activar ───────────────────────────────────────
  $('#tblEquipoTipo').on('click', '.activar', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Activar tipo de equipo?',
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

  // ─── Guardar (insert/update) ───────────────────────
  $('#formEquipoTipo').submit(function (e) {
    e.preventDefault();
    // El controlador usa 'guardar' para insertar y para actualizar cuando viene id
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=guardar',
      $(this).serialize(),
      resp => {
        if (resp.status === 'success') {
          $('#modalEquipoTipo').modal('hide');
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
