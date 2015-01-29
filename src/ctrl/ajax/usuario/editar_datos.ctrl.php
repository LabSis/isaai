<?php

require_once '../../../../config.php';

$salida = '';
$salida .= '{' . PHP_EOL;
$sesion = Sesion::get_instancia();
if ($sesion->activo()) {
    $accion =  $_REQUEST['accion'];
    $datos = $_REQUEST['datos'];
    if ($accion === 'consultar') {
        $usuario = $sesion->get_usuario();
        $salida .= '"config":{"accion": "'.$accion.'"},' . PHP_EOL;
        $salida .= '"datos":' . to_json($usuario);
    } else if($accion === 'editar') {
        $salida .= '"config":{"accion": "'.$accion.'", ' . PHP_EOL;
        
        $json_usuario = json_decode($datos, true);
        $usuario_editado = new Usuario();
        $usuario_editado->set_id($json_usuario['id']);
        $usuario_editado->set_nombre_usuario($json_usuario['nombreUsuario']);
        //$usuario_editado->set_clave_usuario($json_usuario['clave_usuario']);
        //$usuario_editado->set_rol($json_usuario['id']);
        $usuario_editado->set_nombre($json_usuario['nombre']);
        $usuario_editado->set_apellido($json_usuario['apellido']);
        $usuario_editado->set_email($json_usuario['email']);
        $usuario_editado->set_telefono($json_usuario['telefono']);
        $usuario_editado->set_direccion($json_usuario['direccion']);
        $usuario_editado->set_fecha_alta($json_usuario['fechaAlta']);
        $usuario_editado->set_fecha_baja($json_usuario['fechaBaja']);
        
        $ok = Usuario::modificar($usuario_editado);
        
        if($ok){
            $sesion->actualizar();
        }
        
        $salida .= '"resultado" : "' . $ok . '"}, ' . PHP_EOL;
        $salida .= '"datos":' . to_json($usuario_editado);
         
    }
}
$salida .= '}' . PHP_EOL;

$file = fopen("../../../../log.txt", "w");
fwrite($file,  $salida);
fclose($file);

echo $salida;

function to_json($usuario) {
    $usuario_json = "";
    $usuario_json .= "{" . PHP_EOL;
    $usuario_json .= '"id":' . $usuario->get_id() . ',' . PHP_EOL;
    $usuario_json .= '"nombreUsuario": "' . $usuario->get_nombre_usuario() . '",' . PHP_EOL;
    //$salida = '"clave_usuario": "'.$usuario->get_clave_usuario() .'",' . PHP_EOL;
    //$usuario_json .= '"id_rol": ' . $usuario->get_rol()->get_id() . ',' . PHP_EOL;
    $usuario_json .= '"nombre": "' . $usuario->get_nombre() . '",' . PHP_EOL;
    $usuario_json .= '"apellido": "' . $usuario->get_apellido() . '",' . PHP_EOL;
    $usuario_json .= '"email": "' . $usuario->get_email() . '",' . PHP_EOL;
    $usuario_json .= '"telefono": "' . $usuario->get_telefono() . '",' . PHP_EOL;
    $usuario_json .= '"direccion": "' . $usuario->get_direccion() . '",' . PHP_EOL;
    $usuario_json .= '"fechaAlta": "' . $usuario->get_fecha_alta() . '",' . PHP_EOL;
    $usuario_json .= '"fechaBaja": "' . $usuario->get_fecha_baja() . '"' . PHP_EOL;
    $usuario_json .= "}" . PHP_EOL;
    return $usuario_json;
}
