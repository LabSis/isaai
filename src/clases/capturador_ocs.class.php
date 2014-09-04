<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 */
class CapturadorOcs implements Capturador {

    public function obtenerMaquina() {
        $procesadorOcs = new ProcesadorOcs();
        $procesador = $procesadorOcs->materializar();
        $maquina = new Maquina($procesador);
        return $maquina;
    }

}
