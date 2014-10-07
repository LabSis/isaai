<?php

/**
 * 
 *
 * @author Parisi Germán
 * @version 1.0
 */
class TipoCambio {
    private $_id;
    private $_nombre;
    public function __construct(){
        $this->_id = null;
        $this->_nombre = null;
    }
    
    public function get_id(){
        return $this->_id;
    }
    
    public function get_nombre(){
        return $this->_nombre;
    }
    
    public function set_id($id){
        $this->_id = $id;
    }
    
    public function set_nombre($nombre){
        $this->_nombre = $nombre;
    }
}

