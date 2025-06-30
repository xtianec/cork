/* =====================================================================
   Almacén – Movimientos  · Versión estable · 30-jun-2025
   ===================================================================== */
$(function () {

  /* ───────────────  END-POINTS  ─────────────── */
  const BASE = window.BASE_URL || '';
  const URL_MOV = BASE + 'controlador/AlmacenMovimientoController.php';
  const URL_ART = BASE + 'controlador/ArticuloController.php';
  const URL_TIPO = BASE + 'controlador/TipoMovimientoAlmacenController.php';
  const kardexURL = id => `${URL_MOV}?op=kardex&articulo_id=${id}`;
  
  const exportCfg = {
    /*  ⭐  Solo lo que está filtrado y ordenado en pantalla  */
    exportOptions: {
      columns: ':visible',
      modifier: { search: 'applied', order: 'applied' }
    }
  };
  /* ───────────────  Botones estándar  ─────────────── */
  const dtButtons = [
    { extend: 'excel', className: 'btn btn-sm btn-outline-success', text: 'Excel', ...exportCfg },
    { extend: 'csv', className: 'btn btn-sm btn-outline-info', text: 'CSV', ...exportCfg },
    { extend: 'print', className: 'btn btn-sm btn-outline-primary', text: 'Imprimir', ...exportCfg }
  ];

  function postJSON(url, data) {
    return $.post(url, data, null, 'json')
      .fail(() => Swal.fire({ icon: 'error', title: 'Error de comunicación' }));
  }

  /* ───────────────  FILTRO GLOBAL DE FECHAS (DT) ─────────────── */
  $.fn.dataTable.ext.search.push((settings, data) => {
    const id = settings.nTable.id;
    if (id !== 'tblMov' && id !== 'tblKardex') return true;

    const f = data[1].substr(0, 10);                 // col 1 = fecha
    const min = id === 'tblMov' ? $('#minDate').val() : $('#kMinDate').val();
    const max = id === 'tblMov' ? $('#maxDate').val() : $('#kMaxDate').val();
    return (!min || f >= min) && (!max || f <= max);
  });

  /* ───────────────  DATATABLES  ─────────────── */
  const tblMov = $('#tblMov').DataTable({
    ajax: { url: `${URL_MOV}?op=listar`, dataSrc: 'data' },
    order: [[1, 'desc']],
    columns: [
      { data: 'id' }, { data: 'fecha' }, { data: 'articulo' }, { data: 'tipo_movimiento' },
      { data: 'entrada', className: 'text-end' },
      { data: 'salida', className: 'text-end' },
      { data: 'precio_unitario', className: 'text-end' },
      { data: 'referencia' },
      { data: 'acciones', orderable: false, className: 'text-center' }
    ],
    dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: dtButtons,
    deferRender: true, scrollX: true, responsive: true
  });


  const tblKdx = $('#tblKardex').DataTable({
    ajax: { url: kardexURL(0), dataSrc: 'data' },
    columns: [
      { data: 'id' }, { data: 'fecha' }, { data: 'tipo_movimiento' },
      { data: 'entrada', className: 'text-end' },
      { data: 'salida', className: 'text-end' },
      { data: 'saldo', className: 'text-end' }
    ],
    dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>tr",
    buttons: dtButtons,
    paging: false, info: false, scrollX: true, responsive: true
  });

  const tblInv = $('#tblInv').DataTable({
    ajax: { url: `${URL_MOV}?op=inventario`, dataSrc: 'data' },
    columns: [
      { data: 'linea' }, { data: 'sublinea' }, { data: 'marca' },
      { data: 'articulo' },
      { data: 'stock_actual', className: 'text-end' }
    ],
    dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: dtButtons,
    deferRender: true, scrollX: true, responsive: true
  });

  /* filtro rápido por texto en Inventario */
  $('#qLinea,#qSub,#qMarca').on('input', () => {
    tblInv.column(0).search($('#qLinea').val())
      .column(1).search($('#qSub').val())
      .column(2).search($('#qMarca').val())
      .draw();
  });

  /* recarga tras CRUD */
  const refreshTables = () => {
    tblMov.ajax.reload(null, false);
    tblInv.ajax.reload(null, false);
    const id = $('#selArt').val();
    if (id) tblKdx.ajax.url(kardexURL(id)).load();
  };

  /* ───────────────  CARGA DE COMBOS  ─────────────── */
  const loadLineas = () => {
    $.getJSON(`${URL_ART}?op=lineas`, d => {
      $('#selLinea').html(`<option value="0">- Todas -</option>
        ${d.map(o => `<option value="${o.id}">${o.text}</option>`).join('')}`);
    });
  };
  const loadSublineas = linea => {
    $.getJSON(`${URL_ART}?op=sublineas&linea_id=${linea}`, d => {
      $('#selSub').html(`<option value="0">- Todas -</option>
        ${d.map(o => `<option value="${o.id}">${o.text}</option>`).join('')}`);
    });
  };
  const loadMarcas = () => {
    $.getJSON(`${URL_ART}?op=marcas`, d => {
      $('#selMarca').html(`<option value="0">- Todas -</option>
        ${d.map(o => `<option value="${o.id}">${o.text}</option>`).join('')}`);
    });
  };
  const loadTipos = () => {
    $.getJSON(`${URL_TIPO}?op=listar`, d => {
      $('select[name=tipo_movimiento_id]').html(
        d.data.map(o => `<option value="${o.id}">${o.nombre}</option>`)
      );
    });
  };

  /* ───────────────  SELECT2 · Artículo  ─────────────── */
  function initSelectArticulo() {
    const $sel = $('select[name=articulo_id]');
    if ($sel.data('select2')) return;                    // ya está

    $sel.select2({
      dropdownParent: $('#modalMov'),
      width: '100%',
      allowClear: true,
      minimumInputLength: 0,
      ajax: {
        url: URL_ART,
        dataType: 'json',
        delay: 250,
        data: p => ({
          op: 'searchArt',
          q: p.term || '',
          linea_id: $('#selLinea').val() || 0,
          sublinea_id: $('#selSub').val() || 0,
          marca_id: $('#selMarca').val() || 0,
          page: p.page || 1
        }),
        processResults: d => ({
          results: d.results ?? d,
          pagination: { more: d.more || false }
        })
      }
    });
  }

  /* ───────────────  SELECT2 · Kardex  ─────────────── */
  /* ───────────────  SELECT2 · Kardex  ─────────────── */
  function initSelectKardex() {
    $('#selArt').select2({
      width: '100%',
      placeholder: 'Buscar artículo…',
      allowClear: true,
      minimumInputLength: 0,
      ajax: {
        url: URL_ART,
        dataType: 'json',
        delay: 250,
        data: p => ({
          op: 'searchArt',
          q: p.term || '',
          page: p.page || 1          // ← paginación
        }),
        /* ⬇️  ADAPTAMOS el JSON a lo que Select2 espera */
        processResults: (d, params) => ({
          results: d.results ?? d,   // array real
          pagination: { more: d.more || false }
        })
      }
    })

      /* recargar tabla al elegir artículo */
      .on('select2:select', e => {
        const id = e.params.data.id || 0;
        tblKdx.ajax.url(kardexURL(id)).load();
      })
      /* limpiar tabla si se borra la selección */
      .on('select2:clear', () => tblKdx.clear().draw());
  }


  /* ───────────────  EVENTOS DE CASCADA  ─────────────── */
  $('#selLinea').on('change', function () {
    loadSublineas(this.value || 0);             // recarga sub-líneas
    const $art = $('select[name=articulo_id]');
    $art.val(null).trigger('change.select2');   // limpia
    $art.select2('open');                       // muestra lista
  });

  $('#selSub,#selMarca').on('change', function () {
    const $art = $('select[name=articulo_id]');
    $art.val(null).trigger('change.select2');
  });

  /* filtros de fecha */
  $('#minDate,#maxDate').on('change', () => tblMov.draw());
  $('#kMinDate,#kMaxDate').on('change', () => tblKdx.draw());

  /* ───────────────  MODAL NUEVO / EDITAR  ─────────────── */
  $('#btnNuevoMov').on('click', () => {
    $('#formMov')[0].reset();
    $('#formMov [name=id]').val('');
    $('#selLinea,#selSub,#selMarca').val('0');
    loadSublineas(0); loadTipos();
    $('#modalMov').modal('show');
  });

  $('#tblMov').on('click', '.btn-edit', function () {
    const id = $(this).data('id');
    postJSON(URL_MOV, { op: 'mostrar', id }).done(r => {
      $('#selLinea').val(r.linea_id || 0);
      loadSublineas(r.linea_id || 0);
      $('#selSub').val(r.sublinea_id || 0);
      $('#selMarca').val(r.marca_id || 0);
      loadTipos();

      /* llena campos */
      Object.entries(r).forEach(([k, v]) => {
        if (k !== 'articulo_id') $(`[name=${k}]`).val(v);
      });

      /* artículo seleccionado */
      const $art = $('select[name=articulo_id]');
      if (!$art.data('select2')) initSelectArticulo();
      setTimeout(() => {
        $art.append(`<option value="${r.articulo_id}">${r.articulo}</option>`)
          .val(r.articulo_id).trigger('change');
      }, 100);

      $('#modalMov').modal('show');
      });
  });

  /* guardar / actualizar */
  $('#formMov').on('submit', function (e) {
    e.preventDefault();
    const edit = !!$('[name=id]').val();
    const data = $(this).serialize() + `&op=${edit ? 'editar' : 'guardar'}`;
    const $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true).find('.spinner-border').removeClass('d-none');

    postJSON(URL_MOV, data).done(res => {
      Swal.fire({ icon: res.status, title: res.msg });
      if (res.status === 'success') {
        $('#modalMov').modal('hide');
        refreshTables();
      }
    }).always(() => $btn.prop('disabled', false)
        .find('.spinner-border').addClass('d-none'));
  });

  /* eliminar */
  $('#tblMov').on('click', '.btn-delete', function () {
    const id = $(this).data('id');
    Swal.fire({ title: '¿Eliminar?', icon: 'warning', showCancelButton: true })
        .then(r => {
          if (!r.isConfirmed) return;
          postJSON(`${URL_MOV}?op=eliminar`, { id }).done(res => {
            Swal.fire({ icon: res.status, title: res.msg });
            if (res.status === 'success') refreshTables();
          });
        });
  });

  /* ---------- autocompletar precio ---------- */
  function setPrecio() {
    const artId = $('select[name=articulo_id]').val();
    const tipo = $('select[name=tipo_movimiento_id]').val(); // 1-Ingreso, 2-Salida, 3-Devolución
    if (!artId || !tipo) return;

    postJSON(URL_ART + '?op=info', { id: artId }).done(r => {
      let precio = 0;
      if (tipo === '1') precio = r.precio_costo ?? 0; // Ingreso
      else if (tipo === '2') precio = r.precio_venta ?? 0; // Salida
      else if (tipo === '3') precio = 0;                    // Devolución
      $('input[name=precio_unitario]').val(precio);
    });
  }
  /* dispara al cambiar artículo o tipo */
  $(document)
    .on('change', 'select[name=articulo_id]', setPrecio)
    .on('change', 'select[name=tipo_movimiento_id]', setPrecio);

  /* ───────────────  INICIALIZACIÓN  ─────────────── */
  loadLineas(); loadMarcas(); loadTipos();
  initSelectArticulo();           // solo una vez
  initSelectKardex();             // buscador del Kardex
});
