<?php

/**
 * Encapsula la lógica de recuperación de una máquina única de la base de datos 
 * del HC.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class IdMaquinaHc extends IdMaquina {

    private $_id_maquina;
    private $_condicion_unicidad;
    private $_id_hash;

    function __construct($id_maquina) {
        $this->_id_maquina = $id_maquina;
        $this->_condicion_unicidad = null;
        $this->_id_hash = $id_maquina;
    }

    public function get_condicion_unicidad_sql() {
        $this->_condicion_unicidad = " 1=1 AND maquina.id = '{$this->_id_maquina}'";
        return $this->_condicion_unicidad;
    }

    public function get_id_hash() {
        return $this->_id_hash;
    }

}
