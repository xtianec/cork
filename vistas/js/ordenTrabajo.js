$(function () {
  initCrud({
    controller: 'OrdenTrabajoController.php',
    tableId: 'tblOrdenTrabajo',
    modalId: 'modalOrdenTrabajo',
    formId: 'formOrdenTrabajo'
  });

  $('#modalOrdenTrabajo').on('show.bs.modal', function () {
    $.get(window.BASE_URL + 'controlador/OrdenTrabajoController.php?op=selectProyecto', function (r) {
      $('select[name=proyecto_id]').html(r);
    });
    $.get(window.BASE_URL + 'controlador/OrdenTrabajoController.php?op=selectEstado', function (r) {
      $('select[name=estado_id]').html(r);
    });
  });
});
