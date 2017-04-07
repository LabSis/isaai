<?php

require_once '../../../../config.php';

$salida = '';
$salida .= '{' . PHP_EOL;
$sesion = Sesion::get_instancia();
if ($sesion->activo()) {
    $resultado = "false";
    $datos = $_REQUEST['datos'];
    $usuario_sesion = $sesion->get_usuario();
    $json_datos_usuario = json_decode($datos, true);
    if (md5($json_datos_usuario['claveActual']) === $usuario_sesion->get_clave_usuario()) {
        if ($json_datos_usuario['nuevaClave'] !== $json_datos_usuario['claveActual']) {
            if ($json_datos_usuario['nuevaClave'] === $json_datos_usuario['repeticionNuevaClave']) {
                //todo bien, trato de actualizar en la base de datos
                $conexion = Conexion::get_instacia(CONEXION_ISAAI);
                $usuario_auxiliar = new Usuario();
                $usuario_auxiliar->set_id($usuario_sesion->get_id());
                $usuario_auxiliar->set_clave_usuario($json_datos_usuario['nuevaClave']);
                if(Usuario::actualizar($usuario_auxiliar)){
                    $resultado = "true";
                    $sesion->actualizar();
                }
            }
        }
    }
    $salida .= '"resultado": "' . $resultado . '"' . PHP_EOL;
}
$salida .= '}';
echo $salida;
