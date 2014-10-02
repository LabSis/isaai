<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "perisfericos" de la base de datos del ISAAI.
 *
 * @author Milagros Zea
 * @version  1.0
 */
class PerisfericoIsaai implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $id_maquina = $_maquina->get_id();
        $resultado = $conexion->consultar('perifericos', 'id, fecha_cambio, nombre, fabricante, tipo, descripcion, interfaz', 'id=' . $id_maquina);
        //new Perisferico($_id, $_nombre, $_fabricante, $_tipo, $_descripcion, $_interfaz)
        $perisferico = new Periferico($resultado[0]['id'], null, null, null, null, null);
        $perisferico->set_descripcion($resultado[0]['descripcion']);
        $perisferico->set_fabricante($resultado[0]['fabricante']);
        $perisferico->set_interfaz($resultado[0]['interfaz']);
        $perisferico->set_nombre($resultado[0]['nombre']);
        $perisferico->set_tipo($resultado[0]['tipo']);
        $perisferico->set_fecha_cambio($resultado[$resultado[0]['fecha_cambio']]);
        return $perisferico;
    }

    public static function desmaterializar($maquina, $periferico) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'fabricante' => $periferico->get_fabricante(),
            'nombre' => $periferico->get_nombre(),
            'tipo' => $periferico->get_tipo(),
            'descripcion' => $periferico->get_descripcion(),
            'interfaz' => $periferico->get_interfaz()
        );
        return $conexion->insertar('perifericos', $datos_insercion);
    }

}
