$(function(){
  const base = window.BASE_URL || '';
  $.getJSON(base + 'controlador/DashboardRolController.php?op=usuarios')
    .done(data => {
      const labels = data.map(d => d.rol);
      const values = data.map(d => parseInt(d.total));
      const options = {
        chart: { type: 'bar', height: 350 },
        series: [{ name: 'Usuarios', data: values }],
        xaxis: { categories: labels }
      };
      const chart = new ApexCharts(document.querySelector('#chartUsuariosRol'), options);
      chart.render();
    });
});
