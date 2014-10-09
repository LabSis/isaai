<?php

/**
 * Description of IdMaquinaIsaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class IdMaquinaIsaai extends IdMaquina {

    private $_id_maquina;
    private $_fecha_cambio;

    /**
     *
     * @var string Condición sql que debe ponerse en una cláusula where para 
     * obtener la máquina correcta, en la consulta que posea este where la tabla 
     * maquinas debe debe tener un alias 'maquina' para evitar anbigüedades
     */
    private $_condicion_unicidad;
    private $_id_hash;

    //se espera que venga en formato AAAA_MM_DD
    function __construct($id_maquina, $fecha_cambio) {
        $this->_id_maquina = $id_maquina;
        $this->_fecha_cambio = $fecha_cambio;
        $this->_condicion_unicidad = null;
        $this->_id_hash = $id_maquina;
    }

    public function get_condicion_unicidad_sql() {
        $this->_condicion_unicidad = " 1=1 AND maquina.id = '{$this->_id_maquina}' AND maquina.fecha_cambio = '{$this->_fecha_cambio}'";
        //$this->_condicion_unicidad = " 1=1 AND maquina.id = '{$this->_id_maquina}' AND maquina.fecha_cambio = "
        //        . "(SELECT MAX(fecha_cambio) FROM maquinas WHERE id = '{$this->_id}')";
        return $this->_condicion_unicidad;
    }

    public function get_id_hash() {
        return $this->_id_hash;
    }

//put your code here
}
