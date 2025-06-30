<?php
// config/menu.php

$menu = [
    'dashboard' => [
        'icon' => 'fas fa-home',
        'items' => [
            ['label' => 'Principal', 'view' => 'dashboardSuperadmin']
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
