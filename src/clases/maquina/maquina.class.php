<?php

/**
 * Esta clase representa un computadora con todos sus componentes, como por 
 * ejemplo procesador, bios, perisféricos, entre otros.
 *
 * @author Diego Barrionuevo, Milagros Zea Cardenas
 * @version 1.0
 */
class Maquina {

    private $_id;
    private $_fecha_alta;
    private $_nombre_maquina;
    private $_fecha_ultimo_contacto;
    private $_procesadores;
    private $_bios;
    private $_placas_red;
    private $_placas_sonido;
    private $_placas_video;
    private $_memorias;
    private $_perisfericos;
    private $_discos;
    private $_monitores;
    private $_sistema_operativo;

    function __construct($_id, $_fecha_alta, $_nombre_maquina, $_fecha_ultimo_contacto, $_procesadores, $_bios, $_placas_red, $_placas_sonido, $_placas_video, $_memorias, $_perisfericos, $_discos, $_monitores, $_sistema_operativo) {
        $this->_id = $_id;
        $this->_fecha_alta = $_fecha_alta;
        $this->_nombre_maquina = $_nombre_maquina;
        $this->_fecha_ultimo_contacto = $_fecha_ultimo_contacto;
        $this->_procesadores = $_procesadores;
        $this->_bios = $_bios;
        $this->_placas_red = $_placas_red;
        $this->_placas_sonido = $_placas_sonido;
        $this->_placas_video = $_placas_video;
        $this->_memorias = $_memorias;
        $this->_perisfericos = $_perisfericos;
        $this->_discos = $_discos;
        $this->_monitores = $_monitores;
        $this->_sistema_operativo = $_sistema_operativo;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function get_nombre_maquina() {
        return $this->_nombre_maquina;
    }

    public function get_fecha_ultimo_contacto() {
        return $this->_fecha_ultimo_contacto;
    }

    public function get_procesadores() {
        return $this->_procesadores;
    }

    public function get_bios() {
        return $this->_bios;
    }

    public function get_placas_red() {
        return $this->_placas_red;
    }

    public function get_placas_sonido() {
        return $this->_placas_sonido;
    }

    public function get_placas_video() {
        return $this->_placas_video;
    }

    public function get_memorias() {
        return $this->_memorias;
    }

    public function get_perisfericos() {
        return $this->_perisfericos;
    }

    public function get_discos() {
        return $this->_discos;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }

    public function set_nombre_maquina($_nombre_maquina) {
        $this->_nombre_maquina = $_nombre_maquina;
    }

    public function set_fecha_ultimo_contacto($_fecha_ultimo_contacto) {
        $this->_fecha_ultimo_contacto = $_fecha_ultimo_contacto;
    }

    public function set_procesadores($_procesadores) {
        $this->_procesadores = $_procesadores;
    }

    public function set_bios($_bios) {
        $this->_bios = $_bios;
    }

    public function set_placas_red($_placas_red) {
        $this->_placas_red = $_placas_red;
    }

    public function set_placas_sonido($_placas_sonido) {
        $this->_placas_sonido = $_placas_sonido;
    }

    public function set_placas_video($_placas_video) {
        $this->_placas_video = $_placas_video;
    }

    public function set_memorias($_memorias) {
        $this->_memorias = $_memorias;
    }

    public function set_perisfericos($_perisfericos) {
        $this->_perisfericos = $_perisfericos;
    }

    public function set_discos($_discos) {
        $this->_discos = $_discos;
    }

    public function get_monitores() {
        return $this->_monitores;
    }

    public function set_monitores($_monitores) {
        $this->_monitores = $_monitores;
    }

    public function get_sistema_operativo() {
        return $this->_sistema_operativo;
    }

    public function set_sistema_operativo($_sistema_operativo) {
        $this->_sistema_operativo = $_sistema_operativo;
    }

    public function insertar() {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $conexion->transaccion_comenzar();
        $ok = true;
        $ok &= ProcesadorIsaai::desmaterializar($this->_procesadores);
        $datos_insercion = array(
            'id' => $this->_id,
            'fecha_cambio' => '2014-06-10',
            'id_sistema_operativo' => $this->_sistema_operativo->get_id(),
            'nombre_maquina' => $this->_sistema_operativo->get_id(),
            'fecha_alta' => $this->_sistema_operativo->get_id(),
            'fecha_ultimo_contacto' => $this->_sistema_operativo->get_id()
        );
        $ok &= $conexion->insertar('maquina', $datos_insercion);
        if ($ok) {
            $conexion->transaccion_confirmar();
        } else {
            $conexion->transaccion_revertir();
        }
        return $ok;
    }

}
