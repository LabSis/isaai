<?php

require_once 'config.php';
if (isset($_POST['btnIngresar'])) {
    // Controlador de inicio de sesión.
    if(InicioSesion::iniciar_sesion($_POST["txtNombre"], $_POST["txtClave"])!=false){
        echo "Ingreso!";
    }else{
        echo "Usuario incorrecto!";
    }
}
require_once 'tmpl/index.tmpl.php';