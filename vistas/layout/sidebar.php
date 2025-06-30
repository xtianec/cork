<?php $current = basename($_SERVER['PHP_SELF'], '.php'); ?>

<div class="sidebar-wrapper sidebar-theme">
  <nav id="sidebar">
    <div class="shadow-bottom"></div>

    <ul class="list-unstyled menu-categories" id="accordionExample">

      <!-- DASHBOARD -->
      <li class="menu <?= $current==='dashboardSuperadmin' ? 'active' : '' ?>">
        <a href="#menuDash" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <div><i class="fas fa-home"></i><span>Dashboard</span></div>
          <div><i class="fas fa-chevron-right"></i></div>
        </a>
        <ul id="menuDash"
            class="submenu list-unstyled collapse <?= $current==='dashboardSuperadmin' ? 'show' : '' ?>"
            data-parent="#accordionExample">
          <li class="<?= $current==='dashboardSuperadmin' ? 'active' : '' ?>">
            <a href="<?= APP_URL ?>dashboardSuperadmin"> Principal </a>
          </li>
        </ul>
      </li>

      <!-- ADMINISTRACIÓN -->
      <li class="menu">
        <a href="#menuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <div><i class="fas fa-folder"></i><span>Administración</span></div>
          <div><i class="fas fa-chevron-right"></i></div>
        </a>
        <ul id="menuAdmin" class="submenu list-unstyled collapse" data-parent="#accordionExample">
          <li><a href="<?= APP_URL ?>cliente">Cliente</a></li>
          <li><a href="<?= APP_URL ?>proveedor">Proveedor</a></li>
          <!-- … resto … -->
        </ul>
      </li>

      <!-- INVENTARIO -->
      <li class="menu">
        <a href="#menuInvent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <div><i class="fas fa-dolly"></i><span>Gestion</span></div>
          <div><i class="fas fa-chevron-right"></i></div>
        </a>
        <ul id="menuInvent" class="submenu list-unstyled collapse" data-parent="#accordionExample">
          <li><a href="<?= APP_URL ?>inventario">Inventario</a></li>
          <li><a href="<?= APP_URL ?>estados">Estados</a></li>
        </ul>
      </li>

      <!-- SALIR -->
      <li class="menu">
        <a href="<?= APP_URL ?>logout">
          <div><i class="fas fa-sign-out-alt"></i><span>Salir</span></div>
        </a>
      </li>

    </ul>
  </nav>
</div>



<main class="main-content" id="content">
                <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
