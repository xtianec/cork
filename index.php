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

// Obtener la ruta solicitada
$url = $_GET['url'] ?? '';

// Si no viene por parámetro, intentar deducirla desde REQUEST_URI
if ($url === '') {
    $reqPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base    = rtrim(APP_URL, '/');

    // Detectar automáticamente el directorio base si no está especificado
    if ($base === '') {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    }

    if ($base !== '' && strpos($reqPath, $base) === 0) {
        $reqPath = substr($reqPath, strlen($base));
    }

    $url = trim($reqPath, '/');

    if ($url === '') {
        $url = 'home';
    }
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
    // Ajustar "op" para controladores de tipo script
    if (!isset($_REQUEST['op']) && $method !== 'index') {
        $_GET['op'] = $_REQUEST['op'] = $method;
    }

    require_once $controllerPath;

    // Verificar si la clase del controlador existe
    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        // Verificar si el método existe en el controlador
        if (method_exists($controller, $method)) {
            // Llamar al método con los parámetros
            call_user_func_array([$controller, $method], $params);
        } else {
            // Método no encontrado
            logError('Método no encontrado: ' . $controllerName . '->' . $method);
            echo 'Error 404: Método no encontrado';
        }
    } else {
        // Controlador de tipo script ya ejecutado al incluir el archivo
    }
} else {
    // Archivo del controlador no encontrado
    logError('Archivo del controlador no encontrado: ' . $controllerPath);
    echo 'Error 404: Página no encontrada';
}
