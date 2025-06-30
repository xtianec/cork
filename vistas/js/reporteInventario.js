$(function () {
  const BASE = window.BASE_URL || '';
  const URL_REP = BASE + 'controlador/ReporteInventarioController.php';

  const dtButtons = [
    { extend: 'excel', className: 'btn btn-sm btn-outline-success', text: 'Excel' },
    { extend: 'csv',   className: 'btn btn-sm btn-outline-info',    text: 'CSV' },
    { extend: 'print', className: 'btn btn-sm btn-outline-primary',  text: 'Imprimir' }
  ];

  const tbl = $('#tblReporteInv').DataTable({
    ajax: { url: `${URL_REP}?op=listar`, dataSrc: 'data' },
    columns: [
      { data: 'linea' },
      { data: 'sublinea' },
      { data: 'marca' },
      { data: 'articulo' },
      { data: 'stock_actual', className: 'text-end' }
    ],
    dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: dtButtons,
    deferRender: true,
    scrollX: true,
    responsive: true
  });

  $('#qLinea,#qSub,#qMarca').on('input', () => {
    tbl.column(0).search($('#qLinea').val())
       .column(1).search($('#qSub').val())
       .column(2).search($('#qMarca').val())
       .draw();
  });
});
