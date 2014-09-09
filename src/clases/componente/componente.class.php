<?php

/**
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
abstract class Componente {

    protected $_id;
    protected $_fecha_sincronizacion;
    protected $_fecha_cambio;

    function __construct($_id) {
        $this->_id = $_id;
        $this->_fecha_sincronizacion = null;
        $this->_fecha_cambio = null;
    }
    
    public abstract function equals($componente);

}
