$(function(){
  const BASE = window.BASE_URL || '';
  const API  = BASE + 'controlador/ReporteSistemaController.php';

  const chart = new ApexCharts(document.querySelector('#chartReporte'), {
    chart: { type: 'line', height: 300 },
    series: [{ name: 'Registros', data: [] }],
    xaxis: { categories: [] }
  });
  chart.render();

  $('#btnFiltrar').on('click', function(){
    const mod = $('#selModulo').val();
    const inicio = $('#fInicio').val();
    const fin = $('#fFin').val();
    if(!mod || !inicio || !fin){
      alert('Completa el módulo y rango de fechas');
      return;
    }
    $.getJSON(API, { op:'estadisticas', mod:mod, inicio:inicio, fin:fin })
      .done(function(resp){
        const fechas = resp.data.map(r => r.fecha);
        const valores = resp.data.map(r => parseInt(r.total,10) || 0);
        chart.updateOptions({ xaxis: { categories: fechas } });
        chart.updateSeries([{ name:'Registros', data: valores }]);
      });
  });

  $('#btnFiltrar').click();
});
