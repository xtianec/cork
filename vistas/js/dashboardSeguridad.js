$(function(){
  const base = window.BASE_URL || '';
  $.getJSON(base + 'controlador/DashboardModuloController.php?op=seguridad')
    .done(data => {
      $('#countUsuarios').text(data.usuarios || 0);
      $('#countRoles').text(data.roles || 0);
      $('#countPermisos').text(data.permisos || 0);
      $('#countModulos').text(data.modulos || 0);
    });
});
