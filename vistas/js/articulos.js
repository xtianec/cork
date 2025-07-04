// vistas/js/articulos.js
; (function ($) {
  'use strict';

  // URL base inyectada en la vista antes de este script
  const BASE_URL = window.BASE_URL || '';
  const ENDPOINTS = {
    marca: 'MarcaController.php',
    linea: 'LineaController.php',
    sublinea: 'SublineaController.php',
    unidad: 'UnidadMedidaController.php',
    articulo: 'ArticuloController.php'
  };

  const selectors = {
    $table: $('#tblArticulos'),
    $form: $('#formArticulo'),
    $tabLista: $('#tab-lista'),
    $tabRegistro: $('#tab-registro'),
    $btnNuevo: $('#btnNuevoArticulo'),
    $selMarca: $('#marca_id'),
    $selLinea: $('#linea_id'),
    $selSublinea: $('#sublinea_id'),
    $selUnidad: $('#unidad_medida_id'),
    $imgPreview: $('#imgPreview'),
    $fileInput: $('#imagen'),
    $tblPartes: $('#tblPartes tbody'),
    $btnAddParte: $('#btnAddParte'),
    $btnCancel: $('#btnCancel')
  };

  /**
   * Caché de opciones para los <select>.
   * Evita repetir llamadas AJAX cuando los datos ya fueron cargados.
   */
  const selectCache = { marca: '', linea: '', unidad: '', sublinea: {} };

  /**
   * Llena un <select> con opciones del backend utilizando caché.
   */
  function fillSelect($sel, tipo, params = {}, placeholder, selected = '') {
    const key = tipo === 'sublinea' ? (params.linea_id || 0) : tipo;
    const cached = tipo === 'sublinea' ? selectCache.sublinea[key] : selectCache[tipo];
    $sel.empty().append($('<option>').val('').text(placeholder));
    if (cached) {
      $sel.append(cached);
      if (selected) $sel.val(selected);
      return $.Deferred().resolve();
    }

    const url = `${BASE_URL}controlador/${ENDPOINTS[tipo]}?op=select`;
    return $.get(url, params)
      .done(html => {
        if (tipo === 'sublinea') selectCache.sublinea[key] = html;
        else selectCache[tipo] = html;
        $sel.append(html);
        if (selected) $sel.val(selected);
      })
      .fail(xhr => console.error(`Error cargando select ${tipo}:`, xhr));
  }

  function updateParteIndexes() {
    selectors.$tblPartes.find('tr').each(function (i) {
      $(this).find('td').eq(0).text(i + 1);
    });
  }

  function addParteRow(value = '') {
    const $tr = $('<tr>');
    $tr.append('<td></td>');
    $tr.append(`<td><input type="text" name="partes[]" class="form-control form-control-sm" value="${value}"></td>`);
    $tr.append('<td><button type="button" class="btn btn-sm btn-danger btn-del-parte">&times;</button></td>');
    selectors.$tblPartes.append($tr);
    updateParteIndexes();
  }


  /**
   * Muestra el formulario: limpia o carga datos
   */
  function showForm(data = {}) {
    selectors.$form[0].reset();
    selectors.$form.find('[name=id]').val(data.id || '');
    selectors.$form.find('[name=parte_id]').val(data.parte_id || '');
    selectors.$imgPreview.hide();
    selectors.$fileInput.next('.custom-file-label').text('Selecciona archivo…');
    selectors.$tblPartes.empty();
    (data.partes || []).forEach(p => addParteRow(p));
    updateParteIndexes();
    // Rellenar inputs de texto y números
    ['codigo', 'numero_parte', 'nombre', 'descripcion', 'stock_minimo', 'stock_maximo', 'precio_costo', 'precio_venta'].forEach(name => {
      const $f = selectors.$form.find(`[name="${name}"]`);
      if ($f.length && data[name] !== undefined) $f.val(data[name]);
    });
    // Carga de selects en paralelo
    $.when(
      fillSelect(selectors.$selMarca, 'marca', {}, '-- Selecciona Marca --', data.marca_id),
      fillSelect(selectors.$selLinea, 'linea', {}, '-- Selecciona Línea --', data.linea_id),
      fillSelect(selectors.$selSublinea, 'sublinea', { linea_id: data.linea_id }, '-- Selecciona Sub-línea --', data.sublinea_id),
      fillSelect(selectors.$selUnidad, 'unidad', {}, '-- Selecciona U. Medida --', data.unidad_medida_id)
    ).always(() => {
      if (data.imagen) selectors.$imgPreview.attr('src', BASE_URL + data.imagen).show();
      selectors.$tabRegistro.tab('show');
    });
  }

  $(function () {
    // Inicializar DataTable
    const table = selectors.$table.DataTable({
      ajax: {
        url: `${BASE_URL}controlador/${ENDPOINTS.articulo}`,
        data: { op: 'listar' },
        dataSrc: 'data',
        error: xhr => console.error('DataTable AJAX error:', xhr.responseText)
      },
      columns: [
        { data: 0 }, { data: 1 }, { data: 2 }, { data: 3, orderable: false },
        { data: 4 }, { data: 5 }, { data: 6 }, { data: 7 },
        { data: 8 }, { data: 9 }, { data: 10 }, { data: 11, orderable: false }
      ],
      columnDefs: [
        { targets: [8, 9], className: 'text-end' },
        { targets: 11, className: 'text-center' }
      ],
      language: { loadingRecords: 'Cargando...', zeroRecords: 'No hay artículos', paginate: { previous: '‹', next: '›' } },
      responsive: true,
      autoWidth: false
    });

    // Precargar selects principales
    fillSelect(selectors.$selMarca, 'marca', {}, '-- Selecciona Marca --');
    fillSelect(selectors.$selLinea, 'linea', {}, '-- Selecciona Línea --');
    fillSelect(selectors.$selUnidad, 'unidad', {}, '-- Selecciona U. Medida --');

    // Facilitar número: seleccionar contenido al foco
    selectors.$form.find('input[type=number]').on('focus', function () { this.select(); });

    // Botón Nuevo artículo
    selectors.$btnNuevo.click(() => showForm());
    selectors.$btnAddParte.click(() => addParteRow());
    selectors.$tblPartes.on('click', '.btn-del-parte', function () {
      $(this).closest('tr').remove();
      updateParteIndexes();
    });

    // Botón Editar artículo
    selectors.$table.on('click', '.btn-edit', function () {
      const id = $(this).data('id');
      $.post(`${BASE_URL}controlador/${ENDPOINTS.articulo}?op=mostrar`, { id }, 'json')
        .done(showForm)
        .fail(xhr => console.error('Error al obtener artículo:', xhr));
    });

    // Botón Cancelar
    selectors.$btnCancel.click(function (e) {
      e.preventDefault();
      selectors.$tabLista.tab('show');
    });
    // Cambiar sublínea al cambiar línea
    selectors.$selLinea.change(() => fillSelect(selectors.$selSublinea, 'sublinea', { linea_id: selectors.$selLinea.val() }, '-- Selecciona Sub-línea --'));

    // Preview nombre de archivo e imagen
    selectors.$fileInput.change(function () {
      const file = this.files[0];
      $(this).next('.custom-file-label').text(file ? file.name : 'Selecciona archivo…');
      if (file) {
        const reader = new FileReader();
        reader.onload = e => selectors.$imgPreview.attr('src', e.target.result).show();
        reader.readAsDataURL(file);
      } else {
        selectors.$imgPreview.hide();
      }
    });

    // Validación base antes de AJAX
    function validateForm() {
      const codigo = selectors.$form.find('[name=codigo]').val().trim();
      const nombre = selectors.$form.find('[name=nombre]').val().trim();
      if (!codigo) { Swal.fire('Atención', 'El código es obligatorio', 'warning'); return false; }
      if (!nombre) { Swal.fire('Atención', 'El nombre es obligatorio', 'warning'); return false; }
      if (!selectors.$selMarca.val()) { Swal.fire('Atención', 'Debe seleccionar una marca', 'warning'); return false; }
      if (!selectors.$selLinea.val()) { Swal.fire('Atención', 'Debe seleccionar una línea', 'warning'); return false; }
      if (!selectors.$selUnidad.val()) { Swal.fire('Atención', 'Debe seleccionar unidad de medida', 'warning'); return false; }
      // Validar números no negativos
      let isValid = true;
      ['stock_minimo', 'stock_maximo', 'precio_costo', 'precio_venta'].forEach(name => {
        const val = parseFloat(selectors.$form.find(`[name="${name}"]`).val());
        if (isNaN(val) || val < 0) {
          Swal.fire('Atención', `El valor de ${name.replace('_', ' ')} no puede ser negativo`, `warning`);
          isValid = false;
        }
      });
      return isValid;
    }

    // Guardar/editar artículo
    selectors.$form.submit(function (e) {
      e.preventDefault();
      if (!validateForm()) return;
      const op = selectors.$form.find('[name=id]').val() ? 'editar' : 'guardar';
      $.ajax({
        url: `${BASE_URL}controlador/${ENDPOINTS.articulo}?op=${op}`,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: 'json'
      }).done(resp => {
        Swal.fire(resp.status === 'success' ? '¡Éxito!' : 'Error', resp.msg, resp.status);
        if (resp.status === 'success') { table.ajax.reload(null, false); selectors.$tabLista.tab('show'); }
      });
    });

    // Activar/desactivar artículo
    selectors.$table.on('click', '.btn-deactivate, .btn-activate', function () {
      const isDeactivate = $(this).hasClass('btn-deactivate');
      const action = isDeactivate ? 'desactivar' : 'activar';
      Swal.fire({ title: isDeactivate ? '¿Desactivar artículo?' : '¿Activar artículo?', icon: isDeactivate ? 'warning' : 'question', showCancelButton: true, confirmButtonText: 'Sí' })
        .then(r => {
          if (r.isConfirmed) {
            const id = $(this).data('id');
            $.post(`${BASE_URL}controlador/${ENDPOINTS.articulo}?op=${action}`, { id }, 'json')
              .done(x => { Swal.fire('', x.msg, x.status); table.ajax.reload(null, false); });
          }
        });
    });
  });
})(jQuery);
