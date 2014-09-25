<?php

/**
 * 
 *
 * @author Parisi Germán
 * @version 1.0
 */
class ComparadorMaquinas {

    private $_componentes_cambiados;

    function __construct() {
        $this->_componentes_cambiados = array();
    }

    /**
     * Retorna si estas dos máquinas son iguales o diferentes y en caso que
     * sean diferentes guarda los cambios en componentes_cambiados.
     * @param \Maquina $maquina1
     * @param \Maquina $maquina2
     * @return boolean
     */
    public function verificar_igualdad($maquina1, $maquina2) {
        assert(!is_null($maquina1));
        assert(!is_null($maquina2));

        /* Comparar las dos maquinas 1 y 2. y dejar los cambios en el array componentes_cambiados. */
        $iguales = true;

//        if ($maquina1->get_bios()->equals($maquina2->get_bios()) === false) {
//            $this->_componentes_cambiados[] = $maquina2->get_bios();
//            $iguales = false;
//        }
        for ($i = 0; $i < count($maquina1->get_procesadores()); $i++) {
            if(!$maquina1->get_procesador($i)->equals($maquina2->get_procesador($i))){
                $this->_componentes_cambiados[] = $maquina2->get_procesador($i);
            }
        }
        return $iguales;
    }

    public function get_componentes_cambiados() {
        return $this->_componentes_cambiados;
    }

}
