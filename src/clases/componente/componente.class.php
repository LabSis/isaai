<?php

/**
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
abstract class Componente {

    protected $_id;
    protected $_fecha_alta;

    function __construct($_id) {
        $this->_id = $_id;
        $this->_fecha_alta = null;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }

    public abstract function equals($componente);
}
