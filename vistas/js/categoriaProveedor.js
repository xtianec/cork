$(function () {
  const base = window.BASE_URL;
  const ctrl = 'CategoriaProveedorController.php';

  const table = $('#tblCategoriaProveedor').DataTable({
    ajax: {
      url: base + 'controlador/' + ctrl + '?op=listar',
      type: 'GET',
      dataSrc: 'data'
    }
  });

  $('#btnNuevo').on('click', function () {
    $('#formCategoriaProveedor')[0].reset();
    $('#categoria_id').val('');
    $('#modalCategoriaProveedor .modal-title').text('Nueva Categoría');
    $('#modalCategoriaProveedor').modal('show');
  });

  $('#tblCategoriaProveedor').on('click', '.btn-edit', function () {
    const id = $(this).data('id');
    $.post(base + 'controlador/' + ctrl + '?op=mostrar', { id }, function (r) {
      if (r) {
        $('#categoria_id').val(r.id);
        $('#categoria_nombre').val(r.nombre);
        $('#modalCategoriaProveedor .modal-title').text('Editar Categoría');
        $('#modalCategoriaProveedor').modal('show');
      }
    }, 'json');
  });

  $('#tblCategoriaProveedor').on('click', '.btn-deactivate', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Desactivar categoría?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, desactivar'
    }).then(res => {
      if (res.isConfirmed) {
        $.post(base + 'controlador/' + ctrl + '?op=desactivar', { id }, function (resp) {
          Swal.fire('', resp.msg, resp.status);
          table.ajax.reload();
        }, 'json');
      }
    });
  });

  $('#tblCategoriaProveedor').on('click', '.btn-activate', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Activar categoría?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, activar'
    }).then(res => {
      if (res.isConfirmed) {
        $.post(base + 'controlador/' + ctrl + '?op=activar', { id }, function (resp) {
          Swal.fire('', resp.msg, resp.status);
          table.ajax.reload();
        }, 'json');
      }
    });
  });

  $('#formCategoriaProveedor').on('submit', function (e) {
    e.preventDefault();
    const id = $('#categoria_id').val();
    const op = id ? 'editar' : 'guardar';
    $.post(base + 'controlador/' + ctrl + '?op=' + op, $(this).serialize(), function (resp) {
      if (resp.status === 'success') {
        $('#modalCategoriaProveedor').modal('hide');
        Swal.fire('Éxito', resp.msg, 'success');
        table.ajax.reload();
      } else {
        Swal.fire('Error', resp.msg || 'Ocurrió un error', 'error');
      }
    }, 'json');
  });
});
