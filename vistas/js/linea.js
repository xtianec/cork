// vistas/js/linea.js
$(function () {
  const ctrl  = 'LineaController.php';
  const table = $('#tbllistadoLinea').DataTable({
    ajax: {
      url: BASE_URL + 'controlador/' + ctrl + '?op=listar',
      type: 'GET',
      dataSrc: 'data'
    }
  });

  // ----- Nuevo -----
  $('#btnNuevoLinea').on('click', () => {
    $('#formLinea')[0].reset();
    $('#linea_id').val('');
    $('#modalLinea .modal-title').text('Nueva Línea');
    $('#modalLinea').modal('show');
  });

  // ----- Editar -----
  $('#tbllistadoLinea').on('click', '.btn-edit-linea', function () {
    const id = $(this).data('id');
    $.post(BASE_URL + 'controlador/' + ctrl + '?op=mostrar', { id }, r => {
      $('#linea_id').val(r.id);
      $('#linea_nombre').val(r.nombre);
      $('#modalLinea .modal-title').text('Editar Línea');
      $('#modalLinea').modal('show');
    }, 'json');
  });

  // ----- Desactivar -----
  $('#tbllistadoLinea').on('click', '.btn-deactivate-linea', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Desactivar línea?',
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

  // ----- Activar -----
  $('#tbllistadoLinea').on('click', '.btn-activate-linea', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Activar línea?',
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

  // ----- Guardar / Editar -----
  $('#formLinea').on('submit', function (e) {
    e.preventDefault();
    const id = $('#linea_id').val();
    const op = id ? 'editar' : 'guardar';
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=' + op,
      $(this).serialize(),
      resp => {
        if (resp.status === 'success') {
          $('#modalLinea').modal('hide');
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
