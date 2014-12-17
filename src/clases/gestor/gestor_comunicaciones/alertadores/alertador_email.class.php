<?php

/**
 * 
 * @author Parisi Germán
 * @version 1.0
 */
class AlertadorEmail implements Alertador {

    public function alertar($mensajes_x_usuarios) {
//        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
//        $consulta = "SELECT u.email, u.id_rol "
//                . "FROM usuarios AS u INNER JOIN roles AS r "
//                . "ON u.id_rol = r.id";
//        $resultados = $conexion->consultar_simple($consulta);
//        $lista_emails = array();
//        foreach ($mensajes as $mensaje) {
//            $cambio;
//            $tipos_cambio_x_roles = $mensaje->get_rol_x_tipos_cambio();
//            for ($i = 0; $i < count($resultados); $i++) {
//                foreach ($tipos_cambio_x_roles as $tipos_cambio_x_rol) {
//                    if ($resultados[$i]['id_rol'] == key($tipos_cambio_x_roles)) {
//                        $mail_usuario = $resultados[$i]['email'];
//                        /////$cambio ;
//                        Out::println("Envio email de cambio a emial: " . $mail_usuario_rol);
//                        Out::println("Mensaje: " . $mensaje_usuario_rol);
//                    }
//                }
//            }
        //$servidor->enviar_alertas();
//        }
    }

}
