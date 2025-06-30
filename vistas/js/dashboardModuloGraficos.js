$(function(){
  const base = window.BASE_URL || '';

  // Inicializa el gráfico
  const chart = new ApexCharts(document.querySelector('#modChart'), {
    chart: { type: 'bar' },
    series: [{ name: 'Total', data: [] }],
    xaxis: { categories: [] }
  });
  chart.render();

  function cargar(modulo) {
    $.getJSON(base + 'controlador/DashboardModuloController.php?op=' + modulo)
      .done(function(data){
        const labels = Object.keys(data);
        const valores = labels.map(k => parseInt(data[k], 10) || 0);
        chart.updateOptions({ xaxis: { categories: labels } });
        chart.updateSeries([{ name: 'Total', data: valores }]);
      });
  }

  $('#selectModulo').on('change', function(){
    cargar(this.value);
  });

  cargar($('#selectModulo').val());
});
