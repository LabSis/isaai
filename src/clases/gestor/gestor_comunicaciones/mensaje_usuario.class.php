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
    
    function __construct($_usuario, $_cambios, $_tipos_cambio_x_cambios) {
        $this->_usuario = $_usuario;
        $this->_cambios = $_cambios;
        $this->_tipos_cambio_x_cambios = $_tipos_cambio_x_cambios;
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



}
