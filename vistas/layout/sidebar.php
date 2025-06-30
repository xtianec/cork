<?php
// vistas/layout/sidebar.php

require_once __DIR__ . '/../../config/global.php';

$menu = [
    'dashboard' => [
        'icon' => 'fas fa-home',
        'items' => [
            ['label' => 'Principal', 'view' => 'dashboardSuperadmin'],
            ['label' => 'Administrador', 'view' => 'dashboardAdmin'],
            ['label' => 'Usuario', 'view' => 'dashboardUsuario'],
            ['label' => 'Principal',   'view' => 'dashboardSuperadmin'],
            ['label' => 'Inventario',  'view' => 'dashboardInventario'],
            ['label' => 'Seguridad',   'view' => 'dashboardSeguridad'],
            ['label' => 'Roles',       'view' => 'dashboardRoles'],
            ['label' => 'Gráficos por Módulo', 'view' => 'dashboardModuloGraficos']
        ]
    ],
    'administracion' => [
        'icon' => 'fas fa-folder',
        'items' => [
            ['label' => 'Cliente', 'view' => 'cliente'],
            ['label' => 'Proveedor', 'view' => 'proveedor'],
            ['label' => 'Artículos', 'view' => 'articulos'],
            ['label' => 'Unidad Medida', 'view' => 'unidadMedida'],
            ['label' => 'Categoría Cliente', 'view' => 'categoriaCliente'],
            ['label' => 'Categoría Proveedor', 'view' => 'categoriaProveedor']
        ]
    ],
    'inventario' => [
        'icon' => 'fas fa-dolly',
        'items' => [
            ['label' => 'Inventario', 'view' => 'inventario'],
            ['label' => 'Reporte Inventario', 'view' => 'reporteInventario'],
            ['label' => 'Estados', 'view' => 'estados']
        ]
    ],
    'seguridad' => [
        'icon' => 'fas fa-lock',
        'items' => [
            ['label' => 'Usuarios', 'view' => 'usuario'],
            ['label' => 'Roles', 'view' => 'rol'],
            ['label' => 'Permisos', 'view' => 'permiso'],
            ['label' => 'Módulos', 'view' => 'modulo']
        ]
    ],
    'logout' => [
        'icon' => 'fas fa-sign-out-alt',
        'url'  => APP_URL . 'logout'
    ]
];

$viewDir = realpath(__DIR__ . '/..');
$allViews = array_map(function ($path) {
    return basename($path, '.php');
}, glob($viewDir . '/*.php'));

$existing = [];
foreach ($menu as $section) {
    if (isset($section['items'])) {
        foreach ($section['items'] as $item) {
            $existing[] = $item['view'];
        }
    }
}

$otherViews = [];
foreach ($allViews as $view) {
    if (!in_array($view, $existing)) {
        $label = ucwords(trim(preg_replace('/(?<!^)([A-Z])/', ' $1', $view)));
        $otherViews[] = ['label' => $label, 'view' => $view];
    }
}

if ($otherViews) {
    $menu['otros'] = [
        'icon' => 'fas fa-th-large',
        'items' => $otherViews
    ];
}

$current = basename($_SERVER['PHP_SELF'], '.php');
?>
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
<?php
foreach ($menu as $key => $section) {
    if (isset($section['items'])) {
        $activeSection = false;
        foreach ($section['items'] as $it) {
            if ($it['view'] === $current) {
                $activeSection = true;
                break;
            }
        }
        $sectionId = 'menu_' . $key;
        ?>
            <li class="menu <?= $activeSection ? 'active' : '' ?>">
                <a href="#<?= $sectionId ?>" data-toggle="collapse" aria-expanded="<?= $activeSection ? 'true' : 'false' ?>" class="dropdown-toggle">
                    <div><i class="<?= $section['icon'] ?>"></i><span><?= ucfirst($key) ?></span></div>
                    <div><i class="fas fa-chevron-right"></i></div>
                </a>
                <ul id="<?= $sectionId ?>" class="submenu list-unstyled collapse <?= $activeSection ? 'show' : '' ?>" data-parent="#accordionExample">
        <?php
        foreach ($section['items'] as $item) {
            $isActive = $item['view'] === $current ? 'active' : '';
            echo "<li class=\"$isActive\"><a href=\"" . APP_URL . $item['view'] . "\">" . htmlspecialchars($item['label']) . "</a></li>";
        }
        ?>
                </ul>
            </li>
        <?php
    } else {
        ?>
            <li class="menu">
                <a href="<?= $section['url'] ?>">
                    <div><i class="<?= $section['icon'] ?>"></i><span><?= ucfirst($key) ?></span></div>
                </a>
            </li>
        <?php
    }
}
?>
        </ul>
    </nav>
</div>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
