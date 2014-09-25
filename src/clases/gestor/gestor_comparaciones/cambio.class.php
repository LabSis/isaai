<?php

/**
 * Esta clase representa un cambio en una máquina.
 * Contiene una referencia a la máquina en el estado anterior y al estado
 * actual. Además, contiene una lista de los componentes que cambiaron.
 *
 * @author Parisi Germán
 * @version 1.0
 */
class Cambio {

    private $_maquina_anterior;
    private $_maquina_actual;
    private $_componentes_cambiados;

    public function __construct() {
        $this->_maquina_actual = null;
        $this->_maquina_anterior = null;
        $this->_componentes_cambiados = array();
    }

    public function add_componente_cambiado($componente) {
        $this->_componentes_cambiados[] = $componente;
    }

    public function is_maquina_nueva() {
        return is_null($this->_maquina_anterior);
    }

    public function get_maquina_anterior() {
        return $this->_maquina_actual;
    }

    public function get_maquina_actual() {
        return $this->_maquina_actual;
    }

    public function get_componentes_cambiados() {
        return $this->_componentes_cambiados;
    }

    public function set_maquina_anterior($maquina_anterior) {
        $this->_maquina_anterior = $maquina_anterior;
    }

    public function set_maquina_actual($maquina_actual) {
        $this->_maquina_actual = $maquina_actual;
    }

    public function set_componentes_cambiados($componentes) {
        $this->_componentes_cambiados = $componentes;
    }

}
