(function ($) {
  'use strict';
  const table = $('#tblProveedor').DataTable({
    ajax: {
      url: BASE_URL + 'controlador/ProveedorController.php',
      type: 'GET',
      data: { op: 'listar' },
      dataSrc: 'data'
    },
    columns: [
      { data: 0 },{ data: 1 },{ data: 2 },{ data: 3 },{ data: 4 },{ data: 5 },{ data: 6 }
    ],
    language: { loadingRecords: 'Cargando...', zeroRecords: 'No hay proveedores', paginate: { previous: '‹', next: '›' } },
    responsive: true,
    autoWidth: false
  });

  function fetchData(op, data = {}, method = 'POST', dt = 'json') {
    return $.ajax({
      url: BASE_URL + 'controlador/ProveedorController.php?op=' + op,
      method, data, dataType: dt
    });
  }

  function loadCategories(sel = '') {
    return $.get(BASE_URL + 'controlador/CategoriaProveedorController.php?op=select')
      .done(html => {
        $('select[name=categoria_id]').html(html).val(sel);
      });
  }

  let ubigeo = null;
  fetch(BASE_URL + 'data/ubigeo_peru.json')
    .then(r => r.json())
    .then(data => {
      ubigeo = data;
      const deps = Object.keys(data).sort();
      deps.forEach(d => $('#lista-departamentos').append(`<option>${d}</option>`));
    });

  $('input[name=departamento]').on('input', function () {
    const d = this.value;
    const provs = ubigeo && ubigeo[d] ? Object.keys(ubigeo[d]).sort() : [];
    $('#lista-provincias').empty();
    provs.forEach(p => $('#lista-provincias').append(`<option>${p}</option>`));
    $('#lista-distritos').empty();
    $('input[name=distrito]').val('');
  });

  $('input[name=provincia]').on('input', function () {
    const d = $('input[name=departamento]').val();
    const p = this.value;
    const dist = ubigeo && ubigeo[d] && ubigeo[d][p] ? ubigeo[d][p] : [];
    $('#lista-distritos').empty();
    dist.sort().forEach(x => $('#lista-distritos').append(`<option>${x}</option>`));
  });

  function openModal(data = {}) {
    const form = $('#formProveedor')[0];
    form.reset();
    $(form).removeClass('was-validated');
    if (data.id) Object.entries(data).forEach(([k, v]) => $(form).find(`[name="${k}"]`).val(v));
    loadCategories(data.categoria_id || '').always(() => {
      $('#modalProveedor .modal-title').text(data.id ? 'Editar Proveedor' : 'Nuevo Proveedor');
      $('#modalProveedor').modal('show');
    });
  }

  $('#btnNuevo').click(() => openModal());

  $('#tblProveedor').on('click', '.btn-edit', function () {
    fetchData('mostrar', { id: $(this).data('id') }).done(openModal);
  });

  $('#tblProveedor').on('click', '.btn-deactivate', function () {
    const id = $(this).data('id');
    Swal.fire({ title: '¿Desactivar proveedor?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Sí' })
      .then(r => { if (r.isConfirmed) fetchData('desactivar', { id }).done(x => { Swal.fire('', x.msg, x.status); table.ajax.reload(null, false); }); });
  });

  $('#tblProveedor').on('click', '.btn-activate', function () {
    const id = $(this).data('id');
    Swal.fire({ title: '¿Activar proveedor?', icon: 'question', showCancelButton: true, confirmButtonText: 'Sí' })
      .then(r => { if (r.isConfirmed) fetchData('activar', { id }).done(x => { Swal.fire('', x.msg, x.status); table.ajax.reload(null, false); }); });
  });

  $('#formProveedor').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    const form = this;
    if (!form.checkValidity()) { $(form).addClass('was-validated'); return; }
    const op = $('[name=id]').val() ? 'editar' : 'guardar';
    fetchData(op, $(form).serialize()).done(resp => {
      Swal.fire(resp.status === 'success' ? 'Éxito' : 'Error', resp.msg, resp.status);
      if (resp.status === 'success') { $('#modalProveedor').modal('hide'); table.ajax.reload(null, false); }
    });
  });
})(jQuery);
