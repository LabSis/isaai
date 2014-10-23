<?php

require_once 'config.php';
$sesion = Sesion::get_instancia();
if (isset($_POST['btnIngresar'])) {
    if ($sesion->iniciar_sesion($_POST["txtNombre"], $_POST["txtClave"]) == true) {
        //Out::println($global_ruta_web . "/src/ctrl/principal.ctrl.php");
        Util::ir($global_ruta_web . "/src/ctrl/principal.ctrl.php");
    } else {
        $sesion->cargar_mensaje("Problemas al validar usuario", Sesion::TIPO_MENSAJE_ERROR);
    }
}
require_once 'tmpl/index.tmpl.php';
