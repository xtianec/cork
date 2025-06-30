<?php
// config/menu.php

$menu = [
    'dashboard' => [
        'icon' => 'fas fa-home',
        'items' => [
            ['label' => 'Principal',   'view' => 'dashboardSuperadmin'],
            ['label' => 'Inventario',  'view' => 'dashboardInventario'],
            ['label' => 'Seguridad',   'view' => 'dashboardSeguridad'],
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

// Generar secci\xC3\xB3n "otros" autom\xC3\xA1ticamente con vistas faltantes
$viewDir = __DIR__ . '/../vistas';
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
