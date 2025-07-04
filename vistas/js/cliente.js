(function($){
    'use strict';

    // Inicializa DataTable
    const table = $('#tblCliente').DataTable({
      ajax: {
        url:      BASE_URL + 'controlador/ClienteController.php',
        type:     'GET',
        data:     { op: 'listar' },
        dataSrc:  'data'
      },
      columns: [
        { data:'id' },{ data:'ruc' },{ data:'razon_social' },
        { data:'categoria' },{ data:'estado_label' },
        { data:'fecha_registro' },{ data:'acciones' }
      ],
      responsive:true,
      language:{
        loadingRecords:'Cargando...',
        zeroRecords:'No hay clientes',
        paginate:{ previous:'‹', next:'›' }
      }
    });

    // Helper AJAX
    function fetchData(op,data={},method='GET',dt='json'){
      return $.ajax({
        url:      BASE_URL + 'controlador/ClienteController.php',
        method, dataType: dt,
        data:     Object.assign({op},data)
      });
    }

    // Carga categorías
    function loadCategories(sel=''){
      fetchData('select',{},'GET','html')
        .done(html => $('select[name=categoria_id]').html(html).val(sel));
    }

    // Abre modal
    function openModal(data={}){
      const form = $('#formCliente')[0];
      form.reset();
      $(form).removeClass('was-validated');
      $('input[name=estado]').val(data.estado ?? 1);
      if(data.id){
        Object.entries(data).forEach(([k,v])=>
          $(`[name=${k}]`).val(v)
        );
      }
      loadCategories(data.categoria_id||'');
      $('#modalCliente .modal-title')
        .text(data.id? 'Editar Cliente':'Nuevo Cliente');
      $('#modalCliente').modal('show');
    }

    // Ubigeo Perú
    let ubigeo = null;
    fetch(BASE_URL + 'data/ubigeo_peru.json')
      .then(r => r.ok ? r.json() : null)
      .then(data => {
        if(!data) return;
        ubigeo = data;
        const deps = Object.keys(ubigeo).sort();
        deps.forEach(d => $('#lista-departamentos').append(`<option>${d}</option>`));
      })
      .catch(()=>{ /* dataset opcional */ });

    $('input[name=departamento]').on('input',function(){
      if(!ubigeo) return;
      const d = this.value,
            provs = ubigeo[d] ? Object.keys(ubigeo[d]).sort() : [];
      $('#lista-provincias').empty();
      provs.forEach(p => $('#lista-provincias').append(`<option>${p}</option>`));
      $('#lista-distritos').empty();
      $('input[name=distrito]').val('');
    });
    $('input[name=provincia]').on('input',function(){
      if(!ubigeo) return;
      const d = $('input[name=departamento]').val(),
            p = this.value,
            dist = ubigeo[d] && ubigeo[d][p] ? ubigeo[d][p] : [];
      $('#lista-distritos').empty();
      dist.sort().forEach(x => $('#lista-distritos').append(`<option>${x}</option>`));
    });

    // Botones tabla
    $('#btnNuevoCliente').click(()=> openModal());
    $('#tblCliente')
      .on('click','.btn-edit',       function(){
        fetchData('mostrar',{id:$(this).data('id')},'POST')
          .done(openModal);
      })
      .on('click','.btn-deactivate', function(){
        const id = $(this).data('id');
        Swal.fire({
          title:'¿Desactivar?', icon:'warning',
          showCancelButton:true, confirmButtonText:'Sí'
        }).then(r=> r.isConfirmed && fetchData('desactivar',{id},'POST')
          .done(res=>{
            Swal.fire('',res.msg,res.status);
            table.ajax.reload(null,false);
          }));
      })
      .on('click','.btn-activate',   function(){
        const id = $(this).data('id');
        Swal.fire({
          title:'¿Activar?', icon:'question',
          showCancelButton:true, confirmButtonText:'Sí'
        }).then(r=> r.isConfirmed && fetchData('activar',{id},'POST')
          .done(res=>{
            Swal.fire('',res.msg,res.status);
            table.ajax.reload(null,false);
          }));
      });

    // Submit formulario con validación
    $('#formCliente').on('submit',function(e){
      e.preventDefault(); e.stopPropagation();
      const form = this;
      if(!form.checkValidity()){
        $(form).addClass('was-validated');
        return;
      }
      const id = $('[name=id]').val(),
            op = id? 'editar':'guardar',
            data = $(form).serialize() + '&op=' + op;
      $.post(BASE_URL + 'controlador/ClienteController.php', data, 'json')
        .done(resp=>{
          Swal.fire(
            resp.status==='success'? '¡Éxito!':'Error',
            resp.msg, resp.status
          );
          if(resp.status==='success'){
            $('#modalCliente').modal('hide');
            table.ajax.reload(null,false);
          }
        })
        .fail(()=> Swal.fire('Error','Fallo en la petición','error'));
    });

  })(jQuery);