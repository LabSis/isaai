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
        for ($i = 0; $i < count($resultados); $i++) {
            for ($j = 0; $j < count($roles); $j++) {
                if ($resultados[$i]['id_rol'] == $roles[$j]->get_id()) {
                    $lista_emails[] = $resultados[$i]['email'];
                }
            }
        }
        //$servidor->enviar_alertas();
    }

}
