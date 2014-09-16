<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorOcs implements Capturador {

    public function obtenerMaquina($idMaquina) {
        $maquina = new Maquina(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $maquina->set_procesadores(ProcesadorOcs::materializar($idMaquina));
        //$maquina->set_bios(BiosOcs::materializar($idMaquina));
        return $maquina;
    }

}
