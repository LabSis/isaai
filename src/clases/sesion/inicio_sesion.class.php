<?php

/**
 * Controlador para validar el inicio de sesion de un usuario.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class InicioSesion {

    /**
     * Dado un nombre de usuario y una clave, verifica que el usuario este 
     * registrado en el sistema y que la clave sea correcta. Si esto se 
     * cumple devuelve el usuario, de lo contrario false ó 0
     * @param type $nombre_usuario
     * @param type $clave
     */
    public static function iniciar_sesion($nombre_usuario, $clave) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT * FROM usuarios as u WHERE u.nombre_usuario = '" . $nombre_usuario
                . "' and u.clave_usuario = 'MD5(" . $clave . ")'";
        $resultado = $conexion->consultar_simple($consulta);
        if ($resultado != false) {
            $usuario = new Usuario();
            $usuario->set_nombre_usuario($nombre_usuario);
            $usuario->set_clave_usuario($clave);
            $usuario->set_nombre($resultado[0]['nombre']);
            $usuario->set_apellido($resultado[0]['apellido']);
            $usuario->set_email($resultado[0]['email']);
            $usuario->set_telefono($resultado[0]['telefono']);
            $usuario->set_direccion($resultado[0]['direccion']);
            $usuario->set_fecha_alta($resultado[0]['fecha_alta']);
            $usuario->set_fecha_baja($resultado[0]['fecha_baja']);
            return $usuario;
        } else {
            return false;
        }
    }

}
