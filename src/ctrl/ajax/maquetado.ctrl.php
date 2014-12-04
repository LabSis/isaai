<?php

require_once '../../../config.php';

if(isset($_POST["operacion"])){
    $operacion = $_POST["operacion"];
    if($operacion == "ocultar_menu"){
        Sesion::get_instancia()->set_dato("ocultar_menu", $_POST["accion"]);
    }
}