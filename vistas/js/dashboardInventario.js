$(function(){
  const base = window.BASE_URL || '';
  $.getJSON(base + 'controlador/DashboardModuloController.php?op=inventario')
    .done(data => {
      $('#countArticulos').text(data.articulos || 0);
      $('#countMovimientos').text(data.movimientos || 0);
      $('#countMarcas').text(data.marcas || 0);
      $('#countLineas').text(data.lineas || 0);
    });
});
