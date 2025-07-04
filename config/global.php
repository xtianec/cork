
<?php 
// global.php
// IP del servidor de base de datos
define("DB_HOST", "localhost");

// Nombre de la base de datos
define("DB_NAME", "pacific_compressor");

// Nombre de usuario de base de datos
define("DB_USERNAME", "root");

// Contraseña del usuario de base de datos
define("DB_PASSWORD", "");

// Codificación de caracteres
define("DB_ENCODE", "utf8");

// Nombre del proyecto
define("PRO_NOMBRE", "PACIFIC COMPRESSOR");
// URL base de la aplicación
// Detectar automáticamente la URL base de la aplicación
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
define('APP_URL', $basePath ? $basePath . '/' : '/');



?>
