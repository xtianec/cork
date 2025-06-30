// vistas/js/usuario.js
$(function(){
  const API = BASE_URL + 'controlador/UsuarioController.php';

  // 1) CSRF en cada POST
  $.ajaxSetup({
    beforeSend(xhr, settings){
      if (settings.type === 'POST') {
        xhr.setRequestHeader(
          'X-CSRF-Token',
          $('input[name=csrf_token]').val()
        );
      }
    }
  });

  // 2) Carga roles en el <select>
  function cargarRoles(selected = []) {
    return $.getJSON(API + '?op=roles').then(data => {
      const $sel = $('#formUsr select[name="roles[]"]');
      $sel.empty();
      data.forEach(r => {
        $sel.append(
          $('<option>').val(r.id).text(r.nombre)
        );
      });
      if (selected.length) {
        $sel.val(selected);
      }
    });
  }

  // 3) Inicializa DataTable
  const tbl = $('#tblUsr').DataTable({
    ajax: { url: API + '?op=listar', dataSrc: 'data' },
    columns: [
      { data: 'id' },
      { data: 'username' },
      { data: 'estado',
        render: e => e
          ? '<span class="badge badge-success">Activo</span>'
          : '<span class="badge badge-danger">Inactivo</span>'
      },
      { data: 'roles' },
      { data: null, orderable: false, className: 'text-center',
        render(row) {
          return `
            <button class="btn btn-sm btn-primary btn-edit" data-id="${row.id}">✎</button>
            <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">🗑️</button>
          `;
        }
      }
    ]
  });

  // 4) Nuevo Usuario
  $('#btnNuevoUsr').click(() => {
    $('#formUsr')[0].reset();
    $('#formUsr').removeClass('was-validated');
    cargarRoles().then(() => $('#modalUsr').modal('show'));
  });

  // 5) Editar Usuario
  $('#tblUsr').on('click', '.btn-edit', function(){
    const id = $(this).data('id');
    $.post(API + '?op=mostrar', { id }, user => {
      if (!user) return;
      $('#formUsr')[0].reset();
      $('#formUsr').removeClass('was-validated');
      $('#formUsr [name=id]').val(user.id);
      $('#formUsr [name=username]').val(user.username);
      $('#formUsr [name=estado]').val(user.estado);
      $('#formUsr [name=password]').val('');
      cargarRoles(user.roles)
        .then(() => $('#modalUsr').modal('show'));
    }, 'json');
  });

  // 6) Guardar / Actualizar
  $('#formUsr').submit(function(e){
    e.preventDefault();
    const form = this;
    form.classList.add('was-validated');
    if (!form.checkValidity()) return;

    const btn  = $('button[type=submit]', form);
    const spin = btn.find('.spinner-border').removeClass('d-none');
    btn.prop('disabled', true);

    const op = form.id.value ? 'editar' : 'guardar';
    $.post(API + `?op=${op}`, $(form).serialize(), res => {
      Swal.fire(
        res.status === 'success' ? '¡Éxito!' : 'Error',
        res.msg, res.status
      ).then(() => {
        if (res.status === 'success') {
          $('#modalUsr').modal('hide');
          tbl.ajax.reload(null,false);
        }
      });
    }, 'json')
    .fail(() => Swal.fire('Error','Fallo en la petición.','error'))
    .always(() => {
      btn.prop('disabled', false);
      spin.addClass('d-none');
    });
  });

  // 7) Eliminar
  $('#tblUsr').on('click', '.btn-delete', function(){
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Eliminar usuario?',
      icon:  'warning',
      showCancelButton: true
    }).then(r => {
      if (r.isConfirmed) {
        $.post(API + '?op=eliminar', { id }, res => {
          Swal.fire(
            res.status==='success'?'¡Eliminado!':'Error',
            res.msg, res.status
          ).then(()=> tbl.ajax.reload(null,false));
        }, 'json');
      }
    });
  });

});
