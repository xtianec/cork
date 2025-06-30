(function($){
  'use strict';
  const table = $('#tblTipoMov').DataTable({
    ajax: {
      url:    BASE_URL + 'controlador/TipoMovimientoAlmacenController.php',
      data:   {op:'listar'},
      dataSrc:'data'
    },
    columns: [
      { data:'id' },
      { data:'nombre' },
      { data:'created_at' },
      { data:'updated_at' },
      { data:'acciones', className:'text-center' }
    ],
    responsive:true,
    language:{ loadingRecords:'Cargando...', zeroRecords:'No hay datos' }
  });

  function openModal(data={}){
    const f = $('#formTipo')[0]; f.reset(); $(f).removeClass('was-validated');
    if(data.id){
      $('[name=id]').val(data.id);
      $('[name=nombre]').val(data.nombre);
      $('#modalTipo .modal-title').text('Editar Tipo');
    } else {
      $('[name=id]').val('');
      $('#modalTipo .modal-title').text('Nuevo Tipo');
    }
    $('#modalTipo').modal('show');
  }

  $('#btnNuevoTipo').click(()=> openModal());
  $('#tblTipoMov')
    .on('click','.btn-edit', function(){
      const id = $(this).data('id');
      $.post(BASE_URL + 'controlador/TipoMovimientoAlmacenController.php', {op:'mostrar', id}, res=> openModal(res), 'json');
    })
    .on('click','.btn-delete', function(){
      const id = $(this).data('id');
      Swal.fire({ title:'Eliminar?', icon:'warning', showCancelButton:true, confirmButtonText:'Sí' })
        .then(r=>{ if(r.isConfirmed){
          $.post(BASE_URL + 'controlador/TipoMovimientoAlmacenController.php', {op:'eliminar', id}, res=>{
            Swal.fire('', res.msg, res.status);
            table.ajax.reload();
          }, 'json');
        }});
    });

  $('#formTipo').submit(function(e){
    e.preventDefault(); e.stopPropagation();
    if(this.checkValidity()===false){ $(this).addClass('was-validated'); return; }
    const op   = $('[name=id]').val() ? 'editar' : 'guardar';
    const data = $(this).serialize() + '&op=' + op;
    $.post(BASE_URL + 'controlador/TipoMovimientoAlmacenController.php', data, res=>{
      Swal.fire(res.status==='success'?'¡Éxito!':'Error', res.msg, res.status);
      if(res.status==='success'){
        $('#modalTipo').modal('hide');
        table.ajax.reload();
      }
    }, 'json');
  });
})(jQuery);