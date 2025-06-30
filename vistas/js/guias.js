$(function(){
  const tblGuias=$('#tblGuias').DataTable({
    ajax:'controlador/GuiaRemisionController.php?op=listar',
    columns:[
      {data:'id'},
      {data:null,render:d=>`${d.serie}-${d.numero}`},
      {data:'fecha_emision'},
      {data:'cliente'},
      {data:'motivo_traslado'},
      {data:null,render:d=>`<button class="btn btn-sm btn-danger eliminar" data-id="${d.id}">Eliminar</button>`}
    ]
  });

  $('#btnNuevaGuia').click(()=>$('#modalGuia').modal('show'));

  $('#formGuia').submit(e=>{
    e.preventDefault();
    $.post('controlador/GuiaRemisionController.php?op=guardar', $(e.target).serialize(),res=>{
      Swal.fire('¡Éxito!',res.msg,res.status);
      if(res.status=='success'){$('#modalGuia').modal('hide');tblGuias.ajax.reload();}
    },'json');
  });

  $('#tblGuias').on('click','.eliminar',function(){
    const id=$(this).data('id');
    Swal.fire({
      title:'¿Eliminar Guía?',icon:'warning',showCancelButton:true
    }).then(r=>{
      if(r.isConfirmed)$.post('controlador/GuiaRemisionController.php?op=eliminar',{id},res=>{
        tblGuias.ajax.reload();
      },'json');
    });
  });
});