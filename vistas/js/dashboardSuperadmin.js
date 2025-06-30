$(function(){
  const base = window.BASE_URL || '';
  $.getJSON(base + 'controlador/DashboardSuperadminController.php?op=resumen')
    .done(data => {
      $('#countClientes').text(data.clientes || 0);
      $('#countProveedores').text(data.proveedores || 0);
      $('#countArticulos').text(data.articulos || 0);
      $('#countUsuarios').text(data.usuarios || 0);

      const opciones = {
        chart: {
          type: 'bar',
          height: 300
        },
        series: [{
          name: 'Total',
          data: [data.clientes, data.proveedores, data.articulos, data.usuarios]
        }],
        xaxis: {
          categories: ['Clientes', 'Proveedores', 'Artículos', 'Usuarios']
        }
      };
      const grafico = new ApexCharts(document.querySelector('#chartResumen'), opciones);
      grafico.render();
    });
});
