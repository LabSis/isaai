<?php

//especifico el charset
header('Content-Type: text/html; charset=utf-8');

$global_nombre_sitio = 'isaai';

//Impido que se pueda acceder este archivo
if (basename($_SERVER['PHP_SELF']) == 'config.php') {
    die('Acceso incorrecto a la aplicación.');
}

//Config de bases de datos:
//BD HardwareCollector
$config_bd_hc = array(
    "ip_servidor" => "localhost",
    "nombre_bd" => "hc_bd",
    "usuario" => "root",
    "clave" => "",
    "mostrar_errores" => true
);
//BD ISAAI
$config_bd_isaai = array(
    "ip_servidor" => "localhost",
    "nombre_bd" => "isaai",
    "usuario" => "root",
    "clave" => "",
    "mostrar_errores" => true
);

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
//$global_ruta_web = 'http://' . $_SERVER['HTTP_HOST'] . '/isaai';
$global_ruta_web = str_replace("\\", "/", $global_ruta_web);

//Configura la zona horaria
date_default_timezone_set('America/Argentina/Cordoba');

//funcion para encontrar las clases
$global_paquetes = array('', 'util', 'componente', 'maquina', 'usuario',
    'gestor', 'gestor/gestor_capturaciones', 'gestor/gestor_comparaciones',
    'isaai', 'isaai/componente', 'isaai/gestor', 'isaai/gestor/gestor_capturaciones',
    'ocs', 'ocs/componente', 'ocs/gestor', 'ocs/gestor/gestor_capturaciones',
    'hc', 'hc/componente', 'hc/gestor', 'hc/gestor/gestor_capturaciones',
    'socket',
    'gestor/gestor_comunicaciones', 'gestor/gestor_comunicaciones/alertadores');

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
define('CONEXION_HC', 'hc');
define('RUTA_API_AULAS', 'http://localhost/labsis_api_aulas');

Conexion::agregar_instancia(CONEXION_ISAAI, Conexion::init($config_bd_isaai["ip_servidor"], $config_bd_isaai["usuario"], $config_bd_isaai["clave"], $config_bd_isaai["nombre_bd"], $config_bd_isaai["mostrar_errores"]));
Conexion::agregar_instancia(CONEXION_HC, Conexion::init($config_bd_hc["ip_servidor"], $config_bd_hc["usuario"], $config_bd_hc["clave"], $config_bd_hc["nombre_bd"], $config_bd_hc["mostrar_errores"]));
