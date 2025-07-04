<?php
// index.php

// Iniciar la sesión
session_start();

// Autoload de Composer (si está disponible)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Incluir archivos de configuración
require_once 'config/global.php';
require_once 'config/Utilidades.php';

// Obtener la URL desde el parámetro 'url'
// Si no viene especificada redirigimos al inicio de sesión
$url = $_GET['url'] ?? '';
if ($url === '') {
    header('Location: ' . APP_URL . 'login');
    exit();
}

// Separar la URL en segmentos
$url = explode('/', $url);

// Obtener el nombre del controlador (primer segmento)
$controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';

// Obtener el método (segundo segmento) o 'index' por defecto
$method = isset($url[1]) ? $url[1] : 'index';

// Obtener los parámetros adicionales
$params = array_slice($url, 2);

// Ruta al archivo del controlador
$controllerPath = 'controlador/' . $controllerName . '.php';

// Verificar si el archivo del controlador existe
if (file_exists($controllerPath)) {
    require_once $controllerPath;

    // Verificar si la clase del controlador existe
    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        // Verificar si el método existe en el controlador
        if (method_exists($controller, $method)) {
            // Llamar al método con los parámetros
            call_user_func_array([$controller, $method], $params);
            return;
        }

        // Método no encontrado
        logError('Método no encontrado: ' . $controllerName . '->' . $method);
        echo 'Error 404: Método no encontrado';
        return;
    }

    // Clase del controlador no encontrada
    logError('Controlador no encontrado: ' . $controllerName);
    echo 'Error 404: Controlador no encontrado';
    return;
}

// Si no existe controlador, intentamos cargar la vista directamente
$viewPath = 'vistas/' . ($url[0] ?? '') . '.php';
if (file_exists($viewPath)) {
    require_once $viewPath;
    return;
}

// Archivo del controlador no encontrado y no existe la vista
logError('Archivo del controlador no encontrado: ' . $controllerPath);
echo 'Error 404: Página no encontrada';
