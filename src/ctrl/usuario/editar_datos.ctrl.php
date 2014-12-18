<?php

require_once '../../../config.php';

$sesion = Sesion::get_instancia();
$usuario = new Usuario();
if($sesion->activo()){
    $usuario = $sesion->get_usuario();
}
if(isset($_POST['btnAceptar'])){
    
    
}

require_once $global_ruta_servidor . '/tmpl/usuario/editar_datos.tmpl.php';