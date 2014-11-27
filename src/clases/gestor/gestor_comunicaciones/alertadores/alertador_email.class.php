<?php

/**
 * 
 * @author Parisi Germán
 * @version 1.0
 */
class AlertadorEmail implements Alertador {

    public function alertar($cambio, $roles) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT u.email, u.id_rol "
                . "FROM usuarios AS u INNER JOIN roles AS r "
                . "ON u.id_rol = r.id";
        $resultados = $conexion->consultar_simple($consulta);
        $lista_emails = array();
        //Out::print_array($roles);
        $mensaje_rol;
        for ($i = 0; $i < count($resultados); $i++) {
            for ($j = 0; $j < count($roles); $j++) {
                //$mensaje_rol="\n".$roles[$j]->get_nombre();
                if ($resultados[$i]['id_rol'] == $roles[$j]->get_id()) {
                    $lista_emails[] = $resultados[$i]['email'];
                    $mensaje_rol="\n".$roles[$j]->get_descripcion();
                    //Out::print_array($cambio->get_maquina_actual());
                    //Out::println("Envio email de cambio a emial: ".$resultados[$i]['email']);
                }
            }
            Out::println($mensaje_rol);
        }
        //$servidor->enviar_alertas();
    }

}
