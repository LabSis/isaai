<?php

/**
 * Description of IdMaquinaIsaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class IdMaquinaIsaai extends IdMaquina {

    private $_id_maquina;
    private $_condicion_unicidad;
    private $_id_hash;

    function __construct($id_maquina) {
        $this->_id_maquina = $id_maquina;
        $this->_condicion_unicidad = null;
        $this->_id_hash = $id_maquina;
    }

    public function get_condicion_unicidad_sql() {
        
    }

    public function get_id_hash() {
        return $this->_id_hash;
    }

//put your code here
}
