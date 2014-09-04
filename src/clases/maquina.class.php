<?php

/**
 * Description of maquina
 *
 * @author Diego Barrionuevo
 */
class Maquina {

    private $_procesador;

    function __construct($_procesador) {
        $this->_procesador = $_procesador;
    }

    public function get_procesador() {
        return $this->_procesador;
    }

    public function set_procesador($_procesador) {
        $this->_procesador = $_procesador;
    }

}
