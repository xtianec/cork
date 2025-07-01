$(function(){
  const base = window.BASE_URL || '';
  $.getJSON(base + 'controlador/DashboardModuloController.php?op=inventario')
    .done(data => {
      $('#countArticulos').text(data.articulos || 0);
      $('#countMovimientos').text(data.movimientos || 0);
      $('#countMarcas').text(data.marcas || 0);
      $('#countLineas').text(data.lineas || 0);
    });

  // Gráfico de artículos por marca
  $.getJSON(base + 'controlador/DashboardModuloController.php?op=articulos_marca')
    .done(datos => {
      const etiquetas = datos.map(d => d.marca);
      const valores = datos.map(d => parseInt(d.total));
      const opciones = {
        chart: { type: 'donut', height: 350 },
        series: valores,
        labels: etiquetas
      };
      const grafico = new ApexCharts(document.querySelector('#chartArticulosMarca'), opciones);
      grafico.render();
    });
});
