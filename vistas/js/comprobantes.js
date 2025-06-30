$(function () {
  const BASE = `${BASE_URL}controlador/ComprobanteElectronicoController.php`;
  const detalles = [];
  let tbl;

  /*----------------- 1. DataTable ------------------*/
  tbl = $('#tblComprobantes').DataTable({
    ajax : { url: BASE+'?op=listar', dataSrc:'data' },
    columns:[
      {data:'id'},
      {data:'tipo_comprobante'},
      {data:null, render:r=>`${r.serie}-${r.numero.toString().padStart(8,'0')}`},
      {data:'razon_social'},
      {data:'fecha_emision'},
      {data:'total', className:'text-right', render: $.fn.dataTable.render.number(',', '.', 2)},
      {data:'estado'},
      {data:null, orderable:false, render:r=>`
        <button class="btn btn-sm btn-danger btnAnular"
                data-id="${r.id}" ${r.estado!=='Generado'?'disabled':''}>
          <i class="fa fa-ban"></i>
        </button>`}
    ],
    language:{ url:`${BASE_URL}app/template/json/datatables-es.json` }
  });

  /*-------------- 2. Abrir modal -------------------*/
  $('#btnNuevo').on('click', () => {
    $('#formComprobante')[0].reset();
    detalles.length = 0;
    $('#detalles').empty();
    $('#stock_disp').text('');
    $('#articulo_id').val(null).trigger('change');
    $('#modalComprobante').modal('show');
  });

  /*-------------- 3. Select2 artículos -------------*/
  $('#articulo_id').select2({
    width:'100%',
    placeholder:'Buscar artículo…',
    ajax:{
      url :`${BASE_URL}controlador/ArticuloController.php`,
      dataType:'json',
      delay:250,
      data:p=>({op:'searchStock',q:p.term}),
      processResults:data=>data
    }
  })
  .on('select2:select', e=>{
    const id = e.params.data.id;
    $.post(`${BASE_URL}controlador/ArticuloController.php`,
           {op:'info',id}, info=>{
      $('#precio_unitario').val(info.precio_venta);
      $('#stock_disp').text(`Stock: ${info.stock_actual}`);
    },'json');
  });

  /*-------------- 4. Buscar RUC --------------------*/
  $('#cliente_ruc').on('blur',function(){
    const ruc = this.value.trim();
    if(!ruc) return;
    $('#rucSpinner').removeClass('d-none');
    $.getJSON(`${BASE_URL}controlador/ClienteController.php`,
              {op:'buscarPorRuc',ruc})
      .always(()=>$('#rucSpinner').addClass('d-none'))
      .done(res=>$('#cliente_nombre').val(res.razon_social || ''))
      .fail(()=>Swal.fire('ERROR','RUC no encontrado','error'));
  });

  /*-------------- 5. Agregar ítem ------------------*/
  $('#addItem').click(()=>{
    const art   = $('#articulo_id').val();
    const cant  = +$('#cantidad').val();
    const precio= +$('#precio_unitario').val();
    if(!art || !cant || !precio) return;

    const disp  = +$('#stock_disp').text().replace(/\D/g,'') || 0;
    if(cant>disp){ Swal.fire('ERROR','Cantidad > stock','error'); return; }

    const sub = +(cant*precio).toFixed(2);
    detalles.push({articulo_id:art,cantidad:cant,precio_unitario:precio});

    $('#detalles').append(`
      <tr>
        <td>${art}</td><td>${cant}</td><td>${precio.toFixed(2)}</td><td>${sub.toFixed(2)}</td>
        <td><button class="btn btn-xs btn-link text-danger del">&times;</button></td>
      </tr>`);
    $('#cantidad,#precio_unitario').val('');
    $('#stock_disp').text('');
    $('#articulo_id').val(null).trigger('change');
  });

  /*-------------- 6. Quitar ítem -------------------*/
  $('#detalles').on('click','.del',function(){
    const idx=$(this).closest('tr').index();
    detalles.splice(idx,1);
    $(this).closest('tr').remove();
  });

  /*-------------- 7. Guardar -----------------------*/
  $('#formComprobante').submit(e=>{
    e.preventDefault();
    if(!detalles.length){ Swal.fire('ERROR','Sin ítems','error'); return; }

    const fd = new FormData(e.target);
    fd.append('detalles',JSON.stringify(detalles));

    $.ajax({
      url:BASE+'?op=guardar',type:'POST',
      data:fd,processData:false,contentType:false,dataType:'json'
    }).done(r=>{
      Swal.fire(r.status.toUpperCase(),r.msg,r.status);
      if(r.status==='success'){
        $('#modalComprobante').modal('hide');
        tbl.ajax.reload();
      }
    });
  });

  /*-------------- 8. Anular ------------------------*/
  $('#tblComprobantes').on('click','.btnAnular',function(){
    const id=$(this).data('id');
    Swal.fire({title:'¿Anular?',icon:'warning',showCancelButton:true})
      .then(res=>{
        if(!res.isConfirmed) return;
        $.post(BASE+'?op=anular',{id},r=>{
          Swal.fire(r.status.toUpperCase(),r.msg,r.status);
          tbl.ajax.reload();
        },'json');
      });
  });
});
