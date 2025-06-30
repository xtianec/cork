<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$name = $_SESSION['full_name'] ?? 'Usuario';
$role = ucfirst($_SESSION['user_role'] ?? '');
?>
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item theme-brand flex-row text-center">
            <li class="nav-item theme-logo">
                <a href="<?= APP_URL ?>dashboardSuperadmin">
                    <img src="<?= APP_URL ?>app/template/images/LOGO_FONDO_TRANSPARENTE.png" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text"><a href="#" class="nav-link">PACIFIC</a></li>
        </ul>
        <ul class="navbar-item flex-row ms-auto">
            <li class="nav-item dropdown user-profile-dropdown">
                <a class="nav-link dropdown-toggle user" href="#" data-bs-toggle="dropdown">
                    <img src="<?= APP_URL ?>app/template/images/LOGO_FONDO_TRANSPARENTE.png" alt="avatar">
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item text-center">
                        <strong><?= htmlspecialchars($name) ?></strong><br><small><?= $role ?></small>
                    </div>
                    <div class="dropdown-item"><a href="<?= APP_URL ?>logout"><i class="fas fa-sign-out-alt"></i> Salir</a></div>
                </div>
            </li>
        </ul>
    </header>
</div>

<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse"><i class="fas fa-bars"></i></a>
        <ul class="navbar-nav flex-row">
            <li>
                <h3 class="page-title"><?= $pageTitle ?? 'Panel' ?></h3>
            </li>
        </ul>
    </header>
</div>
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">DataTables</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Alternative Pagination</span></li>
                        </ol>
                    </nav>

                </div>
            </li>
        </ul>
    </header>
</div>
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>