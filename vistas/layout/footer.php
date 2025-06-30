    </div>
</div>
</div>
</div><!-- /.app-container -->

<!-- ==========  FOOTER DE SCRIPTS  ========== -->
   <script src="<?= APP_URL ?>app/template/cork/bootstrap/js/popper.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?= APP_URL ?>app/template/cork/assets/js/app.js"></script>
    <script> $(App.init); </script>
    <script src="<?= APP_URL ?>app/template/cork/assets/js/custom.js"></script>

    <!-- ::::::::::::::::::::  DataTables  ::::::::::::::::::::: -->
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/datatables.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/jszip.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/pdfmake.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/buttons.print.min.js"></script>

    <!-- ::::::::::::::::::::  SweetAlert / Toastify  ::::::::: -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Tu helper genérico (si lo usas) -->
    <script src="<?= APP_URL ?>vistas/js/crud-helper.js"></script>

    <!-- Scripts específicos inyectados por las vistas -->
    <?= $pageScripts ?? '' ?>
    </body>

    </html>
