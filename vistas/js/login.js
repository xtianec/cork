$(function(){
  $('#formLogin').submit(function(e){
    e.preventDefault();
    const btn = $('button[type=submit]', this);
    btn.prop('disabled', true);
    $.post(BASE_URL + 'controlador/AuthController.php?op=login', $(this).serialize(), function(res){
      if(res.status === 'success') {
        window.location.href = BASE_URL + 'dashboardSuperadmin';
      } else {
        alert(res.msg || 'Error');
      }
    }, 'json')
    .fail(function(){ alert('Error en la petición'); })
    .always(function(){ btn.prop('disabled', false); });
  });
});
