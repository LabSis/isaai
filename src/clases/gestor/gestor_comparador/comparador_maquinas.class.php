<?php

/**
 * 
 *
 * @author Parisi Germán
 * @version 1.0
 */
class ComparadorMaquinas {

    private $_componentes_cambiados;

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

        /*Comparar las dos maquinas 1 y 2. y dejar los cambios en el array componentes_cambiados.*/
        return true;
    }

    public function get_componentes_cambiados() {
        return $this->_componentes_cambiados;
    }

}

?>
