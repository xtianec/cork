(() => {
  'use strict';

  const modules = [
    { key: 'linea',        ctrl: 'LineaController.php' },
    { key: 'sublinea',     ctrl: 'SublineaController.php', hasParent: true },
    { key: 'marca',        ctrl: 'MarcaController.php' },
    { key: 'tipoArt',      ctrl: 'TipoArticuloController.php' },
    { key: 'unidadMedida', ctrl: 'UnidadMedidaController.php' }
  ];

  const capitalize = s => s.charAt(0).toUpperCase() + s.slice(1);

  const fetchData = (ctrl, op, data = {}, method = 'GET', dataType = 'json') =>
    $.ajax({ url: `${BASE_URL}controlador/${ctrl}?op=${op}`, method, data, dataType });

  const loadParentOptions = selected => {
    return $.ajax({
      url: `${BASE_URL}controlador/LineaController.php`,
      method: 'GET',
      data: { op: 'select' },
      dataType: 'html'
    }).done(html => {
      $('#sublinea_linea_id').html(html);
      if (selected) $('#sublinea_linea_id').val(selected);
    });
  };

  const toggleActiveFactory = (ctrl, action, table) => function () {
    const id = $(this).data('id');
    Swal.fire({
      title: action === 'desactivar' ? '¿Desactivar?' : '¿Activar?',
      icon:  action === 'desactivar' ? 'warning' : 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí'
    }).then(res => {
      if (!res.isConfirmed) return;
      fetchData(ctrl, action, { id }, 'POST')
        .then(resp => {
          Swal.fire('', resp.msg, resp.status);
          table.ajax.reload(null, false);
        });
    });
  };

  const openModal = (key, data = {}) => {
    const Uc    = capitalize(key);
    const $mod  = $(`#modal${Uc}`);
    const $form = $(`#form${Uc}`)[0];
    $form.reset();

    const descVal = data.descripcion ?? data.nombre ?? '';

    $(`#${key}_id`).val(data.id || '');
    $(`#${key}_descripcion`).val(descVal);

    const show = () => {
      $mod.find('.modal-title')
          .text(data.id ? `Editar ${Uc}` : `Nuevo ${Uc}`);
      $mod.modal('show');
    };

    if (key === 'sublinea') {
      loadParentOptions(data.linea_id).then(show);
    } else {
      show();
    }
  };

  const initModule = ({ key, ctrl, hasParent = false }) => {
    const Uc = capitalize(key);
    const table = $(`#tbl${Uc}`).DataTable({
      processing: true,
      responsive: true,
      ajax: {
        url: `${BASE_URL}controlador/${ctrl}?op=listar`,
        type: 'GET',
        dataSrc: 'data'
      },
      language: {
        loadingRecords: 'Cargando...',
        zeroRecords:    'Sin registros',
        paginate: { previous: '&laquo;', next: '&raquo;' }
      }
    });

    $(`#btnNuevo${Uc}`).on('click', () => openModal(key));

    // EDITAR: ahora usando POST para traer el registro
    $(`#tbl${Uc}`).on('click', '.btn-edit', function () {
      const id = $(this).data('id');
      fetchData(ctrl, 'mostrar', { id }, 'POST')
        .then(record => openModal(key, record));
    });

    $(`#tbl${Uc}`)
      .on('click', '.btn-deactivate', toggleActiveFactory(ctrl, 'desactivar', table))
      .on('click', '.btn-activate',   toggleActiveFactory(ctrl, 'activar',    table));

    $(`#form${Uc}`).on('submit', function (e) {
      e.preventDefault();
      const $btn     = $('button[type="submit"]', this);
      const original = $btn.html();
      const isEdit   = !!$(`#${key}_id`).val();
      const op       = isEdit ? 'editar' : 'guardar';
      const data     = $(this).serialize();

      $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

      fetchData(ctrl, op, data, 'POST')
        .then(resp => {
          $btn.prop('disabled', false).html(original);
          if (resp.status === 'success') {
            $(`#modal${Uc}`).modal('hide');
            Swal.fire('Éxito', resp.msg, 'success');
            table.ajax.reload(null, false);
          } else {
            Swal.fire('Error', resp.msg, 'error');
          }
        })
        .fail(() => {
          $btn.prop('disabled', false).html(original);
          Swal.fire('Error', 'Servicio no disponible', 'error');
        });
    });

    $(`#modal${Uc}`).on('shown.bs.modal', () =>
      $(`#${key}_descripcion`).trigger('focus')
    );

    if (hasParent) {
      $('#btnNuevoSublinea').on('click', () => loadParentOptions());
      $(`#tbl${Uc}`).on('click', '.btn-edit', () => loadParentOptions());
    }
  };

  modules.forEach(initModule);

})();
