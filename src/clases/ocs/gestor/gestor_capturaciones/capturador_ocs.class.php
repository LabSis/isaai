<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorOcs implements Capturador {

    public function obtenerMaquina($id_maquina) {
        $maquina = new Maquina(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $maquina->set_procesadores(ProcesadorOcs::materializar($id_maquina));
        $maquina->set_bios(BiosOCS::materializar($id_maquina));
        return $maquina;
    }

}
