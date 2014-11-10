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
$global_ruta_web = 'http://' . $_SERVER['HTTP_HOST'] . substr(dirname(__FILE__), strpos(dirname(__FILE__), "htdocs") + strlen("htdocs"));

//Configura la zona horaria
date_default_timezone_set('America/Argentina/Cordoba');

//funcion para encontrar las clases
$global_paquetes = array('', 'util', 'componente', 'maquina', 'usuario',
    'gestor', 'gestor/gestor_capturaciones', 'gestor/gestor_comparaciones',
    'isaai', 'isaai/componente', 'isaai/gestor', 'isaai/gestor/gestor_capturaciones',
    'ocs', 'ocs/componente', 'ocs/gestor', 'ocs/gestor/gestor_capturaciones', 'socket',
    'gestor/gestor_comunicaciones', 'gestor/gestor_comunicaciones/alertadores',
    'sesion');

function __autoload($nombre_clase) {
    global $global_paquetes;
    global $global_ruta_servidor; //<-- Para poder encontrar los paquetes desde cualquier sitio!
    $clase = '';
    $caracteres = str_split($nombre_clase);
    for ($i = 0; $i < count($caracteres); $i++) {
        if (ctype_upper($caracteres[$i]) && $i !== 0) {
            $clase .= '_';
        }
        $clase .= strtolower($caracteres[$i]);
    }
    for ($i = 0; $i < count($global_paquetes); $i++) {
        $posible_archivo = $global_ruta_servidor . '/' . 'src/clases/' . $global_paquetes[$i] . '/' . $clase . '.class.php';
        if (file_exists($posible_archivo)) {
            require_once $posible_archivo;
            break;
        }
    }
}

//session_set_cookie_params(3600, $global_ruta_servidor . '/sesiones');
session_start();

define('CONEXION_ISAAI', 'isaai');
define('CONEXION_OCS', 'ocs');
Conexion::agregar_instancia(CONEXION_ISAAI, Conexion::init('localhost', 'root', '', 'isaai', true));
Conexion::agregar_instancia(CONEXION_OCS, Conexion::init('localhost', 'root', '', 'ocsweb', true));
