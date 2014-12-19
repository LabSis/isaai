<?php

/**
 * Esta clase contiene los cambios ocurridos, cuyos tipos de cambios esten asociados
 * a un usuario.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class MensajeUsuario {

    private $_usuario;
    private $_cambios;
    private $_tipos_cambio_x_cambios;

    function __construct() {
        $this->_usuario = null;
        $this->_cambios = array();
        $this->_tipos_cambio_x_cambios = array();
    }

    public function get_usuario() {
        return $this->_usuario;
    }

    public function get_cambios() {
        return $this->_cambios;
    }

    public function get_tipos_cambio_x_cambios() {
        return $this->_tipos_cambio_x_cambios;
    }

    public function set_usuario($_usuario) {
        $this->_usuario = $_usuario;
    }

    public function set_cambios($_cambios) {
        $this->_cambios = $_cambios;
    }

    public function set_tipos_cambio_x_cambios($_tipos_cambio_x_cambios) {
        $this->_tipos_cambio_x_cambios = $_tipos_cambio_x_cambios;
    }

    public function add_cambio($cambio) {
        $this->_cambios[$cambio->get_maquina_actual()->get_id()] = $cambio;
    }

    /*     * Entralaza los dos array ($cambios y $tipos_cambio_x_cambio) a traves de 
     * su indice. 
     * @param type $tipos_cambio
     * @param type $cambio
     */

    public function add_tipos_cambio_x_cambio($tipos_cambio, $cambio) {
        if (key_exists($cambio->get_maquina_actual()->get_id(), $this->_cambios)) {
            $posicion = array_search($cambio, $this->get_cambios());
            $this->_tipos_cambio_x_cambios[$posicion] = $tipos_cambio;
        } else {
            $this->add_cambio($cambio);
            $posicion = array_search($cambio, $this->get_cambios());
            $this->_tipos_cambio_x_cambios[$posicion] = $tipos_cambio;
        }
    }

}
