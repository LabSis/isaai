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
    private $_descripcion;

    public function __construct() {
        $this->_id = null;
        $this->_nombre = null;
        $this->_descripcion = null;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_id($id) {
        $this->_id = $id;
    }

    public function set_nombre($nombre) {
        $this->_nombre = $nombre;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public static function determinar_tipo_cambio($cambio) {
        $tipo_cambio = new TipoCambio();
        $tipo_cambio->set_id(1); //TODO por defecto
        if ($cambio->is_maquina_nueva() == true) {
            $tipo_cambio->set_id(2);
        }
        $componentes_cambiados = $cambio->get_componentes_cambiados();
        foreach ($componentes_cambiados as $componente_cambiado) {
            $nombre_clase_componente = strtolower(get_class($componente_cambiado));
            switch ($nombre_clase_componente) {
                case("procesador"):
                    $tipo_cambio->set_id(3);
                    break;
                case("bios"):
                    $tipo_cambio->set_id(4);
                    break;
            }
            //falta comprobar que cambie tanto el procesador y la memoria pro ejemplo
        }
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT * FROM tipos_cambio WHERE id = {$tipo_cambio->_id}";
        $resultados = $conexion->consultar_simple($consulta);
        if (!empty($resultados)) {
            $tipo_cambio->set_nombre($resultados[0]['nombre']);
            $tipo_cambio->set_descripcion($resultados[0]['descripcion']);
        }
        return $tipo_cambio;
    }

}
