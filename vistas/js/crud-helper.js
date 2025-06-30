function initCrud(opts) {
  const base = window.BASE_URL || '';
  const ctrl = opts.controller;
  const tableId = '#' + opts.tableId;
  const $table = $(tableId);

  // Función para iniciar el DataTable una vez que conozcamos las columnas
  function startTable(initialData, columns) {
    const table = $table.DataTable({
      ajax: {
        url: base + 'controlador/' + ctrl + '?op=listar',
        type: 'GET',
        dataSrc: 'data'
      },
      data: initialData,
      columns: columns
    });

    // --- Manejadores de eventos CRUD ---
    $('#btnNuevo').on('click', function () {
      $('#' + opts.formId)[0].reset();
      $('#' + opts.formId + ' [name="id"]').val('');
      $('#' + opts.modalId + ' .modal-title').text('Nuevo');
      $('#' + opts.modalId).modal('show');
    });

    $(tableId).on('click', '.btn-edit', function () {
      const id = $(this).data('id');
      $.post(base + 'controlador/' + ctrl + '?op=mostrar', { id }, function (r) {
        if (r) {
          Object.keys(r).forEach(k => {
            $('#' + opts.formId + ' [name="' + k + '"]').val(r[k]);
          });
          $('#' + opts.modalId + ' .modal-title').text('Editar');
          $('#' + opts.modalId).modal('show');
        }
      }, 'json');
    });

    $(tableId).on('click', '.btn-deactivate', function () {
      const id = $(this).data('id');
      Swal.fire({
        title: '¿Desactivar registro?',
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

    $(tableId).on('click', '.btn-activate', function () {
      const id = $(this).data('id');
      Swal.fire({
        title: '¿Activar registro?',
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

    $('#' + opts.formId).on('submit', function (e) {
      e.preventDefault();
      const idVal = $('#' + opts.formId + ' [name="id"]').val();
      const op = idVal ? 'editar' : 'guardar';
      $.post(base + 'controlador/' + ctrl + '?op=' + op, $(this).serialize(), function (resp) {
        if (resp.status === 'success') {
          $('#' + opts.modalId).modal('hide');
          Swal.fire('Éxito', resp.msg, 'success');
          table.ajax.reload();
        } else {
          Swal.fire('Error', resp.msg || 'Ocurrió un error', 'error');
        }
      }, 'json');
    });
  }

  // Si la tabla no tiene cabecera, obtenemos la primera fila para construirla
  if ($table.find('thead th').length === 0) {
    $.getJSON(base + 'controlador/' + ctrl + '?op=listar')
      .done(resp => {
        const data = resp.data || [];
        const cols = [];
        if (data.length) {
          for (let i = 0; i < data[0].length; i++) {
            cols.push({ data: i, title: '' });
          }
          const headHtml = cols.map(c => `<th>${c.title}</th>`).join('');
          $table.find('thead').html('<tr>' + headHtml + '</tr>');
        }
        startTable([], cols);
      })
      .fail(() => startTable([], []));
  } else {
    const cols = [];
    $table.find('thead th').each(function (i) {
      cols.push({ data: i });
    });
    startTable([], cols);
  }

}
