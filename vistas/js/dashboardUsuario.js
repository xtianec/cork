$(function(){
  const base = window.BASE_URL || '';
  $.getJSON(base + 'controlador/DashboardUsuarioController.php?op=resumen')
    .done(data => {
      $('#countClientes').text(data.clientes || 0);
      $('#countProveedores').text(data.proveedores || 0);
      $('#countArticulos').text(data.articulos || 0);
      $('#countUsuarios').text(data.usuarios || 0);
    });
});
