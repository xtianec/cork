// vistas/js/contacto.js
$(function () {
  const ctrl  = 'ContactoController.php';
  const table = $('#tblContacto').DataTable({
    ajax: {
      url: BASE_URL + 'controlador/' + ctrl + '?op=listar',
      type: 'GET',
      dataSrc: 'data'
    }
  });

  // ─── Nuevo ─────────────────────────────────────────
  $('#btnNuevoContacto').on('click', () => {
    $('#formContacto')[0].reset();
    $('#contacto_id').val('');
    $('#modalContacto .modal-title').text('Nuevo Contacto');
    $('#modalContacto').modal('show');
  });

  // ─── Editar ────────────────────────────────────────
  $('#tblContacto').on('click', '.btn-edit-contacto', function () {
    const id = $(this).data('id');
    $.post(BASE_URL + 'controlador/' + ctrl + '?op=mostrar', { id }, r => {
      $('#contacto_id').val(r.id);
      $('#contacto_nombre').val(r.nombre);
      $('#contacto_cargo').val(r.cargo);
      $('#contacto_telefono').val(r.telefono);
      $('#contacto_email').val(r.email);
      $('#modalContacto .modal-title').text('Editar Contacto');
      $('#modalContacto').modal('show');
    }, 'json');
  });

  // ─── Desactivar ────────────────────────────────────
  $('#tblContacto').on('click', '.btn-deactivate-contacto', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Desactivar contacto?',
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
  $('#tblContacto').on('click', '.btn-activate-contacto', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Activar contacto?',
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
  $('#formContacto').on('submit', function (e) {
    e.preventDefault();
    const id = $('#contacto_id').val();
    const op = id ? 'editar' : 'guardar';
    $.post(
      BASE_URL + 'controlador/' + ctrl + '?op=' + op,
      $(this).serialize(),
      resp => {
        if (resp.status === 'success') {
          $('#modalContacto').modal('hide');
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
