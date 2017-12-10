<?php

require_once 'config.php';
$sesion = Sesion::get_instancia();
if($sesion->activo()){
    Util::ir('src/ctrl/maquina/maquinas.ctrl.php');
}
if (filter_has_var(INPUT_POST, 'btnIngresar')) {
    $usuario = filter_input(INPUT_POST, 'txtNombre', FILTER_SANITIZE_STRING);
    $clave = filter_input(INPUT_POST, 'txtClave', FILTER_SANITIZE_STRING);
    if ($sesion->iniciar_sesion($usuario, $clave) === true) {
        Util::ir($global_ruta_web . "/src/ctrl/maquina/maquinas.ctrl.php");
    } else {
        $sesion->cargar_mensaje("Problemas al validar usuario", Sesion::TIPO_MENSAJE_ERROR);
    }
}
require_once 'tmpl/index.tmpl.php';
