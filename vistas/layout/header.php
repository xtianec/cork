<?php require_once __DIR__.'/../../config/global.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= $pageTitle ?? 'Panel' ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" href="<?= APP_URL ?>app/template/images/LOGO_FONDO_TRANSPARENTE.png">

  <!-- ::::::::::::::::::::::  CORK núcleo  :::::::::::::::::::::: -->
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/assets/css/loader.css">
  <script src="<?= APP_URL ?>app/template/cork/assets/js/loader.js"></script>

  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/assets/css/plugins.css">
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/assets/css/dark/menu.css">
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/assets/css/dark/components.css">

  <!-- ::::::::::::::::::::  Select2 LOCAL  ::::::::::::::::::::: -->
  <!-- ★ se quita la URL CDN que daba 404 y se deja SOLO la copia local -->
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/plugins/select2/select2.min.css">

  <!-- ::::::::::::::::::::  DataTables  :::::::::::::::::::::::: -->
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/plugins/table/datatable/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="<?= APP_URL ?>app/template/cork/plugins/table/datatable/button-ext/buttons.bootstrap5.min.css">

  <!-- ::::::::::::::::::::  Plugins externos  ::::::::::::::::: -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- ::::::::::::::::::::  jQuery  :::::::::::::::::::::::::::: -->
  <script src="<?= APP_URL ?>app/template/cork/assets/js/libs/jquery-3.1.1.min.js"></script>

  <!-- ::::::::::  Select2 JS (después de jQuery, antes de tu código)  -->
  <script src="<?= APP_URL ?>app/template/cork/plugins/select2/select2.min.js"></script>
</head>
<body>
<div id="load_screen"><div class="loader"><div class="loader-content"><div class="spinner-grow"></div></div></div></div>
<div class="app-container app-theme-dark">
