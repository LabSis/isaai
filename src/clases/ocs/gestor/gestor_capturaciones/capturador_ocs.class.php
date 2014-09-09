<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 */
class CapturadorOcs implements Capturador {

    public function obtenerMaquina() {
        $maquina = new Maquina(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $maquina->set_procesadores(ProcesadorOcs::materializar());
        return $maquina;
    }

}
