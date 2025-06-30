(() => {
  'use strict';

  const tabs = [
    { id: 'estadoCotizacion',   ctrl: 'EstadoCotizacionController.php' },
    { id: 'estadoDocumento',    ctrl: 'EstadoDocumentoController.php' },
    { id: 'estadoEquipos',      ctrl: 'EstadoEquiposController.php' },
    { id: 'estadoOrdenCompra',  ctrl: 'EstadoOrdenCompraController.php' },
    { id: 'estadoOrdenTrabajo', ctrl: 'EstadoOrdenTrabajoController.php' }
  ];

  const capitalize = s => s.charAt(0).toUpperCase() + s.slice(1);

  // AJAX genérico
  const xhr = (ctrl, op, data = {}, method = 'GET', type = 'json') =>
    $.ajax({ url: `${BASE_URL}controlador/${ctrl}?op=${op}`, method, data, dataType: type });

  // Fabrica handler activar/desactivar
  const toggleFactory = (ctrl, action, table) => function () {
    const id = $(this).data('id');
    Swal.fire({
      title: action === 'desactivar' ? '¿Desactivar?' : '¿Activar?',
      icon:  action === 'desactivar' ? 'warning' : 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí'
    }).then(r => {
      if (!r.isConfirmed) return;
      xhr(ctrl, action, { id }, 'POST')
        .then(resp => {
          Swal.fire('', resp.msg, resp.status);
          table.ajax.reload(null, false);
        });
    });
  };

  // Abre modal para create/edit
  const openModal = (id, data = {}) => {
    const Uc = capitalize(id);
    const $mod = $(`#modal${Uc}`);
    const $f = $(`#form${Uc}`)[0];
    $f.reset();
    $(`#${id}_id`).val(data.id || '');
    $(`#${id}_descripcion`).val(data.descripcion || data.nombre || '');

    $mod.find('.modal-title')
        .text(data.id ? `Editar ${Uc}` : `Nuevo ${Uc}`);
    $mod.modal('show');
  };

  // Inicializa cada tabla + modal
  tabs.forEach(({ id, ctrl }) => {
    const Uc = capitalize(id);
    const table = $(`#tbl${Uc}`).DataTable({
      processing: true,
      responsive: true,
      ajax: { url: `${BASE_URL}controlador/${ctrl}?op=listar`, dataSrc: 'data' },
      language: { loadingRecords:'Cargando…', zeroRecords:'Sin registros',
                  paginate:{previous:'«',next:'»'} }
    });

    // Nuevo
    $(`#btnNuevo${Uc}`).click(() => openModal(id));

    // Editar
    $(`#tbl${Uc}`).on('click','.btn-edit', function(){
      const idv = $(this).data('id');
      xhr(ctrl,'mostrar',{id:idv},'POST').then(rec => openModal(id, rec));
    });

    // Desactivar / Activar
    $(`#tbl${Uc}`)
      .on('click','.btn-deactivate', toggleFactory(ctrl,'desactivar',table))
      .on('click','.btn-activate',   toggleFactory(ctrl,'activar',   table));

    // Guardar / Actualizar
    $(`#form${Uc}`).submit(function(e){
      e.preventDefault();
      const $btn = $(this).find('button[type=submit]');
      const orig = $btn.html();
      const isEd = !!$(`#${id}_id`).val();
      const op   = isEd ? 'editar' : 'guardar';
      const str  = $(this).serialize();

      $btn.prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');

      xhr(ctrl,op,str,'POST')
        .then(res => {
          $btn.prop('disabled',false).html(orig);
          if(res.status==='success'){
            $(`#modal${Uc}`).modal('hide');
            Swal.fire('Éxito',res.msg,'success');
            table.ajax.reload(null,false);
          } else {
            Swal.fire('Error',res.msg,'error');
          }
        })
        .fail(()=> {
          $btn.prop('disabled',false).html(orig);
          Swal.fire('Error','Servicio no disponible','error');
        });
    });

    // Auto-focus
    $(`#modal${Uc}`).on('shown.bs.modal',()=>{
      $(`#${id}_descripcion`).trigger('focus');
    });
  });
})();
