// vistas/js/planServicio.js
$(function(){
  function loadPlanes(){
    $.getJSON(BASE_URL+'controlador/PlanServicioController.php?op=combo',r=>{
      const opts=r.map(p=>`<option value="${p.plan_id}">${p.plan_desc}</option>`).join('');
      $('#formPlanesHoras select[name=plan_id],#formPlanesPrecios select[name=plan_id]').html(opts);
    });
  }

  function loadModelos(){
    $.getJSON(BASE_URL+'controlador/EquipoModeloController.php?op=combo',r=>{
      const opts=r.map(m=>`<option value="${m.id}">${m.nombre}</option>`).join('');
      $('#formPlanesPrecios select[name=modelo_equipo_id],#formPlanesPreciosServ select[name=modelo_equipo_id]').html(opts);
    });
  }

  function crud(cfg){
    const table=$(cfg.table).DataTable({
      ajax:{url:BASE_URL+'controlador/'+cfg.ctrl+'?op=listar',dataSrc:'data'}
    });
    $(cfg.btnNew).on('click',()=>{
      $(cfg.form)[0].reset();
      $(cfg.form+' [name=id]').val('');
      if(cfg.ctrl==='PlanServicioController.php'){
        $('#groupPlanId').hide();
        $('#groupPlanId input').prop('disabled',true);
      }
      $(cfg.modal+' .modal-title').text(cfg.title);
      $(cfg.modal).modal('show');
    });
    $(cfg.table).on('click','.btn-edit',function(){
      const id=$(this).data('id');
      $.post(BASE_URL+'controlador/'+cfg.ctrl+'?op=mostrar',{id},r=>{
        if(!r) return;
        Object.keys(r).forEach(k=>$(cfg.form+' [name='+k+']').val(r[k]));
        $(cfg.form+' [name=id]').val(id);
        if(cfg.ctrl==='PlanServicioController.php'){
          $('#groupPlanId').show();
          $('#groupPlanId input').prop('disabled',true);
        }
        $(cfg.modal+' .modal-title').text(cfg.title);
        $(cfg.modal).modal('show');
      },'json');
    });
    $(cfg.table).on('click','.btn-delete',function(){
      const id=$(this).data('id');
      Swal.fire({title:'¿Eliminar?',icon:'warning',showCancelButton:true})
        .then(res=>{ if(res.isConfirmed){
          $.post(BASE_URL+'controlador/'+cfg.ctrl+'?op=eliminar',{id},resp=>{
            Swal.fire('',resp.msg,resp.status); table.ajax.reload();
            if(cfg.ctrl==='PlanServicioController.php') loadPlanes();
          },'json');
        }});
    });
    $(cfg.form).on('submit',function(e){
      e.preventDefault();
      const op=$(cfg.form+' [name=id]').val()? 'editar':'guardar';
      $.post(BASE_URL+'controlador/'+cfg.ctrl+'?op='+op,$(this).serialize(),resp=>{
        if(resp.status==='success'){
          $(cfg.modal).modal('hide');
          Swal.fire('Éxito',resp.msg,'success');
          table.ajax.reload();
          if(cfg.ctrl==='PlanServicioController.php') loadPlanes();
        }else{
          Swal.fire('Error',resp.msg||'Ocurrió un error','error');
        }
      },'json');
    });
  }

  loadPlanes();
  loadModelos();
  crud({table:'#tblPlanServicio',form:'#formPlanServicio',modal:'#modalPlanServicio',btnNew:'#btnNewServ',ctrl:'PlanServicioController.php',title:'Plan Servicio'});
  crud({table:'#tblPlanesHoras',form:'#formPlanesHoras',modal:'#modalPlanesHoras',btnNew:'#btnNewHoras',ctrl:'PlanesHorasController.php',title:'Plan Horas'});
  crud({table:'#tblPlanesPrecios',form:'#formPlanesPrecios',modal:'#modalPlanesPrecios',btnNew:'#btnNewPrecios',ctrl:'PlanesPreciosController.php',title:'Plan Precio'});
  crud({table:'#tblPlanesPreciosServ',form:'#formPlanesPreciosServ',modal:'#modalPlanesPreciosServ',btnNew:'#btnNewPS',ctrl:'PlanesPreciosServiciosController.php',title:'Precios Servicio'});
});
