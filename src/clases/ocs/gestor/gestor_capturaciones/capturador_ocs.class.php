<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorOcs implements Capturador {

    public function obtener_maquina($id_maquina_ocs) {
        $maquina = new Maquina(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $maquina->set_procesadores(ProcesadorOcs::materializar($id_maquina_ocs));
        return $maquina;
    }

}
