/* =====================================================================
   SEGURIDAD · Front-end (jQuery + DataTables/Buttons — sin libs extras)
   08-jul-2025
   ===================================================================== */
$(function () {

  /*────────── ENDPOINTS ──────────*/
  const API = {
    usr : BASE_URL + 'UsuarioController.php',
    rol : BASE_URL + 'RolController.php',
    per : BASE_URL + 'PermisoController.php',
    mod : BASE_URL + 'ModuloController.php',
    rp  : BASE_URL + 'RolPermisoController.php'
  };

  /*────────── CSRF global ──────────*/
  $.ajaxSetup({
    beforeSend : (xhr, s) => {
      if (s.type === 'POST')
        xhr.setRequestHeader('X-CSRF-Token', $('[name=csrf_token]').val());
    }
  });

  /*────────── Helpers UI ──────────*/
  const badge = e => +e
    ? '<span class="badge bg-success">Activo</span>'
    : '<span class="badge bg-danger">Inactivo</span>';

  /* Botones export */
  const btnExport = [
    {extend:'excel', className:'btn btn-sm btn-outline-success', text:'Excel',
      exportOptions:{columns:':visible',modifier:{search:'applied'}}},
    {extend:'csv',   className:'btn btn-sm btn-outline-info',    text:'CSV',
      exportOptions:{columns:':visible',modifier:{search:'applied'}}},
    {extend:'print', className:'btn btn-sm btn-outline-primary', text:'Imprimir',
      exportOptions:{columns:':visible',modifier:{search:'applied'}}}
  ];
  const dtDom =
    "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>";

  /* ════════════════════════════════════════════════════════════
     POBLAR SELECTs (módulo / rol)  para el grid de accesos usuario
     ════════════════════════════════════════════════════════════ */
  function loadSelectModulo(cb){
    $.getJSON(API.mod+'?op=listar', d=>{
      const $m = $('#selModuloUsr').empty()
                     .append('<option value="">— Módulo —</option>');
      (d.data??d).forEach(o=>$m.append(
        `<option value="${o.id}">${o.nombre}</option>`));
      cb&&cb();
    });
  }
  function loadSelectRoles(){
    $.getJSON(API.rol+'?op=listar', d=>{
      const $r = $('#selRolUsr').empty()
                     .append('<option value="">— Rol —</option>');
      (d.data??d).forEach(o=>$r.append(
        `<option value="${o.id}">${o.nombre}</option>`));
    });
  }

  /* ═══════════════  Grid temporal de accesos (usuario)  ═══════════════ */
  let accesos = [];           // [{modulo_id,modulo,rol_id,rol}]
  function refreshGrid(){
    const tb = $('#tblAccesosUsr tbody').empty();
    accesos.forEach((a,i)=>{
      tb.append(`<tr>
        <td>${a.modulo}</td>
        <td>${a.rol}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-danger" data-i="${i}">
            <i class="fa fa-times"></i></button></td></tr>`);
    });
    $('input[name=accesos_json]').val(JSON.stringify(accesos));   // hidden
  }

  /* añadir acceso */
  $('#btnAddAcceso').on('click',()=>{
    const mID=$('#selModuloUsr').val(),
          rID=$('#selRolUsr').val();
    if(!mID || !rID) return;
    const mTx=$('#selModuloUsr option:selected').text(),
          rTx=$('#selRolUsr option:selected').text();
    /* evita duplicado módulo */
    accesos = accesos.filter(a=>a.modulo_id!=mID);
    accesos.push({modulo_id:+mID,modulo:mTx,rol_id:+rID,rol:rTx});
    refreshGrid();
  });

  /* quitar acceso de la tabla */
  $('#tblAccesosUsr').on('click','button',function(){
    accesos.splice($(this).data('i'),1);
    refreshGrid();
  });

  /* ═══════════════  Factoría CRUD  ═══════════════ */
  function makeCrud(cfg){

    const dt = $(cfg.table).DataTable({
      ajax   : { url:cfg.api+'?op=listar', dataSrc:r=>r.data??r },
      columns: [
        ...cfg.cols,
        { data:null, orderable:false, width:130,
          render:r=>{
            const act = +r.estado===1;
            const toggle = cfg.toggle
              ? `<button class="btn btn-sm ${act?'btn-warning':'btn-success'} btn-tg"
                         title="${act?'Desactivar':'Activar'}"
                         data-id="${r.id}" data-act="${act?1:0}">
                   <i class="fa ${act?'fa-ban':'fa-check'}"></i></button>`
              : '';
            return toggle + `
              <button class="btn btn-sm btn-primary btn-ed" data-id="${r.id}" title="Editar">
                <i class="fa fa-edit"></i></button>
              <button class="btn btn-sm btn-danger btn-del" data-id="${r.id}" title="Eliminar">
                <i class="fa fa-trash"></i></button>`;
          }}
      ],
      dom:dtDom, buttons:btnExport, responsive:true,
      deferRender:true, scrollX:true
    });

    /*── Nuevo ──*/
    $(cfg.btnNew).on('click',()=>{
      const $f=$(cfg.form); $f[0].reset(); $f.removeClass('was-validated');
      $f.find('[name=id]').val('');
      cfg.init && cfg.init('new', {});
      $(cfg.modal).modal('show');
    });

    /*── Editar ──*/
    $(cfg.table).on('click','.btn-ed',function(){
      $.post(cfg.api+'?op=mostrar',{id:$(this).data('id')},data=>{
        const $f=$(cfg.form); $f[0].reset(); $f.removeClass('was-validated');
        Object.entries(data).forEach(([k,v])=>$f.find(`[name=${k}]`).val(v));
        cfg.init && cfg.init('edit', data);
        $(cfg.modal).modal('show');
      },'json');
    });

    /*── Guardar ──*/
    $(cfg.form).on('submit',function(e){
      e.preventDefault(); this.classList.add('was-validated');
      if(!this.checkValidity()) return;
      const op  = this.id.value ? 'editar':'guardar',
            btn = $('button[type=submit]',this).prop('disabled',true),
            spn = btn.find('.spinner-border').removeClass('d-none');
      $.post(cfg.api+`?op=${op}`, $(this).serialize(), res=>{
        Swal.fire(res.status==='success'?'Bien':'Error',res.msg,res.status)
            .then(()=>{ if(res.status==='success'){ $(cfg.modal).modal('hide'); dt.ajax.reload(null,false);} });
      },'json').always(()=>{ btn.prop('disabled',false); spn.addClass('d-none'); });
    });

    /*── Eliminar ──*/
    $(cfg.table).on('click','.btn-del',function(){
      Swal.fire({title:'¿Eliminar?',icon:'warning',showCancelButton:true})
          .then(r=>{ if(r.isConfirmed){
             $.post(cfg.api+'?op=eliminar',{id:$(this).data('id')},
               ()=>dt.ajax.reload(null,false));
          }});
    });

    /*── Toggle (solo donde procede) ──*/
    if(cfg.toggle){
      $(cfg.table).on('click','.btn-tg',function(){
        const id=$(this).data('id'), est=$(this).data('act')?0:1;
        $.post(cfg.api+'?op=cambiarEstado',{id,estado:est},
          ()=>dt.ajax.reload(null,false));
      });
    }
    return dt;
  }

  /*────────── CRUD · Módulos (toggle) ──────────*/
  makeCrud({
    btnNew:'#btnNewMod', modal:'#modalModulo', form:'#formModulo',
    table:'#dtMod', api:API.mod, toggle:true,
    cols:[
      {data:'id'},{data:'nombre'},{data:'ruta'},{data:'estado',render:badge}
    ]
  });

  /*────────── CRUD · Roles ──────────*/
  const dtRol = makeCrud({
    btnNew:'#btnNewRol', modal:'#modalRol', form:'#formRol',
    table:'#dtRol', api:API.rol,
    cols:[{data:'id'},{data:'nombre'},{data:'estado',render:badge}]
  });

  /* doble clic en fila Rol → gestor permisos */
  $('#dtRol').on('dblclick','tr',function(){
    const r = dtRol.row(this).data(); if(!r) return;
    openPermisosRol(r.id,r.nombre);
  });

  /*────────── CRUD · Permisos ──────────*/
  function fillModSelect(sel){
    $.getJSON(API.mod+'?op=listar', d=>{
      const $s=$('#formPermiso select[name=modulo_id]').empty();
      (d.data??d).forEach(m=>$s.append(
        `<option value="${m.id}">${m.nombre}</option>`));
      $s.val(sel||'');
    });
  }
  makeCrud({
    btnNew:'#btnNewPer', modal:'#modalPermiso', form:'#formPermiso',
    table:'#dtPerm', api:API.per,
    cols:[
      {data:'id'},{data:'modulo'},{data:'accion'},{data:'estado',render:badge}
    ],
    init:(mode,row)=>fillModSelect(mode==='edit'?row.modulo_id:0)
  });

  /*────────── CRUD · Usuarios ──────────*/
  function fillRoles(checkeds){
    $.getJSON(API.rol+'?op=listar', d=>{
      const $c=$('#rolesContainer').empty();
      (d.data??d).forEach(r=>{
        $c.append(`<label class="me-3">
          <input type="checkbox" name="roles[]" value="${r.id}"
            ${checkeds.includes(r.id)?'checked':''}> ${r.nombre}
        </label>`);
      });
    });
  }

  makeCrud({
    btnNew:'#btnNewUsr', modal:'#modalUsuario', form:'#formUsuario',
    table:'#dtUsr', api:API.usr,
    cols:[
      {data:'id'},{data:'username'},{data:'email'},
      {data:'estado',render:badge},{data:'roles'}
    ],
    init:(mode,row)=>{
      /* accesos por módulo/rol */
      accesos = mode==='edit' ? (row.accesos||[]) : [];
      loadSelectModulo(()=>refreshGrid());
      loadSelectRoles();
      refreshGrid();

      /* roles antiguos (generales) */
      fillRoles(mode==='edit' ? (row.roles||[]) : []);
      $('#password')[mode==='new'?'attr':'removeAttr']('required','required').val('');
    }
  });

  /* validación extra email */
  $(document).on('input','[name=email]',function(){
    this.setCustomValidity(this.validity.typeMismatch?'Correo inválido':'');
  });

  /* visor de contraseña */
  $('#togglePwd').on('click',function(){
    const $pw=$('#password');
    $pw.attr('type',$pw.attr('type')==='password'?'text':'password');
    $(this).find('i').toggleClass('fa-eye fa-eye-slash');
  });

  /* feedback de roles (checkbox) */
  $('#formUsuario').on('submit',()=>{
    $('#rolesFeedback').toggleClass(
      'd-none', $('input[name="roles[]"]:checked').length>0);
  });

  /*────────── Gestor permisos ↔ Rol ──────────*/
  function openPermisosRol(rid,rname){
    $('#permRolTitle').text('Permisos: '+rname);
    const dt = $('#dtPermRol').DataTable({
      destroy:true, paging:false, searching:false, info:false,
      ajax:{url:API.rp+'?op=listar&rol_id='+rid,
            dataSrc:r=>r.data??r},
      columns:[
        {data:'permiso'},
        {data:null,orderable:false,render:d=>
          `<button class="btn btn-sm btn-danger" data-id="${d.permiso_id}">
             <i class="fa fa-times"></i></button>`}
      ]
    });

    /* llenar combo permisos */
    $('#selPermRol').empty();
    $.getJSON(API.per+'?op=listar', p=>{
      (p.data??p).forEach(v=>$('#selPermRol')
        .append(`<option value="${v.id}">${v.modulo} / ${v.accion}</option>`));
    });

    $('#btnAddPermRol').off('click').on('click',()=>{
      const pid=$('#selPermRol').val(); if(!pid) return;
      $.post(API.rp+'?op=asignar',{rol_id:rid,permiso_id:pid},
        ()=>dt.ajax.reload());
    });

    $('#dtPermRol').off('click').on('click','button',function(){
      $.post(API.rp+'?op=quitar',{rol_id:rid,permiso_id:$(this).data('id')},
        ()=>dt.ajax.reload());
    });

    $('#modalPermRol').modal('show');
  }

});
