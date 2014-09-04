<?php

//especifico el charset
header('Content-Type: text/html; charset=utf-8');

$global_nombre_sitio = 'isaai';

//Impido que se pueda acceder este archivo
if (basename($_SERVER['PHP_SELF']) == 'config.php') {
    die('Acceso incorrecto a la aplicación.');
}

//Impido el almacenamiento de la caché
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

//Dependiendo de la configuración establezco si se mostrarán o no los errores.
$global_modo_desarrollo = true;
if ($global_modo_desarrollo) {
    error_reporting(E_ALL | E_STRICT);
} else {
    error_reporting(0);
}

//Rutas usadas
$global_ruta_servidor = dirname(__FILE__);
$global_ruta_web = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $global_nombre_sitio;

//Configura la zona horaria
date_default_timezone_set('America/Argentina/Catamarca');

//funcion para encontrar las clases
function __autoload($nombre_clase) {
    $clase = '';
    $caracteres = str_split($nombre_clase);
    for ($i = 0; $i < count($caracteres); $i++) {
        if (ctype_upper($caracteres[$i]) && $i !== 0) {
            $clase .= '_';
        }
        $clase .= strtolower($caracteres[$i]);
    }
    require_once  'src/clases/' . $clase . '.class.php';
}

//conexion con el ocs
Conexion::init('localhost','root','','ocsweb');