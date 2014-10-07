<?php

/**
 * Esta clase representa un computadora con todos sus componentes, como por 
 * ejemplo procesador, bios, perisféricos, entre otros.
 *
 * @author Diego Barrionuevo, Milagros Zea Cardenas, Germán Parisi
 * @version 1.0
 */
class Maquina {

    /**
     *
     * @var String ID hash de la máquina (tal como se guarda en la base de 
     * datos ISAAI)
     */
    private $_id;
    private $_nombre;
    private $_sistema_operativo;
    private $_fecha_alta;
    private $_fecha_cambio;
    private $_fecha_sincronizacion;
    private $_bios;
    private $_discos;
    private $_memorias;
    private $_monitores;
    private $_perifericos;
    private $_placas_red;
    private $_placas_sonido;
    private $_placas_video;
    private $_procesadores;

    function __construct() {
        $this->_id = null;
        $this->_nombre = null;
        $this->_sistema_operativo = null;
        $this->_fecha_alta = null;
        $this->_fecha_cambio = null;
        $this->_fecha_sincronizacion = null;
        $this->_bios = null;
        $this->_discos = array();
        $this->_memorias = array();
        $this->_monitores = array();
        $this->_perifericos = array();
        $this->_placas_red = array();
        $this->_placas_sonido = array();
        $this->_placas_video = array();
        $this->_procesadores = array();
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_sistema_operativo() {
        return $this->_sistema_operativo;
    }

    public function get_fecha_alta() {
        return $this->_fecha_alta;
    }

    public function get_fecha_cambio() {
        return $this->_fecha_cambio;
    }

    public function get_fecha_sincronizacion() {
        return $this->_fecha_sincronizacion;
    }

    public function get_bios() {
        return $this->_bios;
    }

    public function get_discos() {
        return $this->_discos;
    }

    public function get_memorias() {
        return $this->_memorias;
    }

    public function get_monitores() {
        return $this->_monitores;
    }

    public function get_perifericos() {
        return $this->_perifericos;
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

    public function get_procesadores() {
        return $this->_procesadores;
    }

    public function get_procesador($i) {
        return $this->_procesadores[$i];
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_sistema_operativo($_sistema_operativo) {
        $this->_sistema_operativo = $_sistema_operativo;
    }

    public function set_fecha_alta($_fecha_alta) {
        $this->_fecha_alta = $_fecha_alta;
    }

    public function set_fecha_cambio($_fecha_cambio) {
        $this->_fecha_cambio = $_fecha_cambio;
    }

    public function set_fecha_sincronizacion($_fecha_sincronizacion) {
        $this->_fecha_sincronizacion = $_fecha_sincronizacion;
    }

    public function set_bios($_bios) {
        $this->_bios = $_bios;
    }

    public function set_discos($_discos) {
        $this->_discos = $_discos;
    }

    public function set_memorias($_memorias) {
        $this->_memorias = $_memorias;
    }

    public function set_monitores($_monitores) {
        $this->_monitores = $_monitores;
    }

    public function set_perifericos($_perifericos) {
        $this->_perifericos = $_perifericos;
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

    public function set_procesadores($_procesadores) {
        $this->_procesadores = $_procesadores;
    }

    //Falta insertar datos en la tabla de sistemas operativos!
    public function insertar() {
        /* $componentes_materializables = array(
          "bios" => 'BiosIsaai',
          "discos" => 'DiscoIsaai',
          "memorias" => 'MemoriaIsaai',
          "monitores" => 'MonitorIsaai',
          "perifericos" => 'PerisfericoIsaai',
          "placas_red" => 'PlacaRedIsaai',
          "placas_sonido" => 'PlacaSonidoIsaai',
          "placas_video" => 'PlacaVideoIsaai',
          "procesadores" => 'ProcesadorIsaai'
          ); */
        $componentes_materializables = array(
            "bios" => BiosIsaai,
            "discos" => DiscoIsaai,
            "memorias" => MemoriaIsaai,
            "monitores" => MonitorIsaai,
            "perifericos" => PerisfericoIsaai,
            "placas_red" => PlacaRedIsaai,
            "placas_sonido" => PlacaSonidoIsaai,
            "placas_video" => PlacaVideoIsaai,
            "procesadores" => ProcesadorIsaai
        );
        $componentes = array(
            "bios" => $this->_bios,
            "discos" => $this->_discos,
            "memorias" => $this->_memorias,
            "monitores" => $this->_monitores,
            "perifericos" => $this->_perifericos,
            "placas_red" => $this->_placas_red,
            "placas_sonido" => $this->_placas_sonido,
            "placas_video" => $this->_placas_video,
            "procesadores" => $this->_procesadores
        );
        $correspondencias = array($componentes_materializables, $componentes);
        return $this->insertar_filtrando_componentes($correspondencias);
    }

    //Al actualizar la maquina que cambio, debo insertar un nuevo registro en la 
    //base de datos isaai para la tabla maquinas y todas aquellas tabla de los 
    //componentes que hayan cambiado, unicamente de los que cambiaron, asi 
    //garantizo de no almacenar registro redundantes. El inconveniente con esta 
    //aproximacion seria de que para octener los componentes actuales de una maquina 
    //deberia complicar la consulta sobre las tablas de los componentes, es decir 
    //consultar las tablas de componentes y ordenarlos de manera creciente por 
    //fecha de cambio, para asi obtener los utlimos componentes
    public function actualizar_cambios_componentes($componentes_cambiados) {
        $componentes_materializables = array();
        $componentes = array();
        foreach ($componentes_cambiados as $componente_cambiado) {
            $nombre_clase_componente = strtolower(get_class($componente_cambiado));
            switch ($nombre_clase_componente) {
                case("bios"):
                    $componentes_materializables[$nombre_clase_componente] = BiosIsaai;
                    $componentes[$nombre_clase_componente] = $this->_bios;
                    break;
                case("disco"):
                    $componentes_materializables[$nombre_clase_componente] = DiscoIsaai;
                    $componentes[$nombre_clase_componente] = $this->_discos;
                    break;
                case("memoria"):
                    $componentes_materializables[$nombre_clase_componente] = MemoriaIsaai;
                    $componentes[$nombre_clase_componente] = $this->_memorias;
                    break;
                case("monitor"):
                    $componentes_materializables[$nombre_clase_componente] = MonitorIsaai;
                    $componentes[$nombre_clase_componente] = $this->_monitores;
                    break;
                case("periferico"):
                    $componentes_materializables[$nombre_clase_componente] = PerisfericoIsaai;
                    $componentes[$nombre_clase_componente] = $this->_perifericos;
                    break;
                case("placas_red"):
                    $componentes_materializables[$nombre_clase_componente] = PlacaRedIsaai;
                    $componentes[$nombre_clase_componente] = $this->_placas_red;
                    break;
                case("placas_sonido"):
                    $componentes_materializables[$nombre_clase_componente] = PlacaSonidoIsaai;
                    $componentes[$nombre_clase_componente] = $this->_placas_sonido;
                    break;
                case("placas_video"):
                    $componentes_materializables[$nombre_clase_componente] = PlacaVideoIsaai;
                    $componentes[$nombre_clase_componente] = $this->_placas_video;
                    break;
                case("procesador"):
                    $componentes_materializables[$nombre_clase_componente] = ProcesadorIsaai;
                    $componentes[$nombre_clase_componente] = $componente_cambiado;
                    break;
            }
        }
        $correspondencias = array($componentes_materializables, $componentes);
        return $this->insertar_filtrando_componentes($correspondencias);
    }

    private function insertar_filtrando_componentes($correspondencias) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $conexion->transaccion_comenzar();
        $ok = true;
        $datos_insercion = array(
            'id' => $this->_id,
            'fecha_cambio' => Util::convertir_fecha_a_mysql($this->_fecha_cambio),
            'id_sistema_operativo' => '1', //Evitar esto!
            'nombre' => $this->_nombre,
            'fecha_alta' => Util::convertir_fecha_a_mysql($this->_fecha_alta),
            'fecha_sincronizacion' => $this->_fecha_sincronizacion
        );
        $ok &= $conexion->insertar('maquinas', $datos_insercion);
        //Para no repetir los siguientes insert podrian crear un array de componentes_materializables 
        //y otro de los array seteados en la maquina, asi llamaria a un solo metodo que 
        //recorra ese array e inserte los componentes correspondientes
        $componentes_materializables = $correspondencias[0];
        $componentes = $correspondencias[1];
        foreach ($componentes as $clave_componente => $datos_componente) {
            $componente_materializable = $componentes_materializables[$clave_componente];
            if (is_array($datos_componente)) {
                for ($i = 0; $i < count($datos_componente); $i++) {
                    $ok &= $componente_materializable::desmaterializar($this, $datos_componente[$i]);
                }
            } else {
                Out::println("Quiero desmaterializar: " . get_class($datos_componente));
                $ok &= $componente_materializable::desmaterializar($this, $datos_componente);
            }
        }
        if ($ok) {
            $conexion->transaccion_confirmar();
        } else {
            $conexion->transaccion_revertir();
        }
        return $ok;
    }

}
