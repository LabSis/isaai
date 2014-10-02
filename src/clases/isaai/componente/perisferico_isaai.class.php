<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "perisfericos" de la base de datos del ISAAI.
 *
 * @author Milagros Zea
 * @version  1.0
 */
class PerisfericoIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT p.nombre, p.fabricante, p.tipo, "
                . "p.descripcion, p.interfaz, p.fecha_cambio FROM perifericos AS p "
                . "INNER JOIN maquinas AS maquinas ON "
                . "p.id_maquina = maquinas.id AND p.fecha_cambio = maquinas.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $periferico = new Periferico();
        $periferico->set_id(null);
        $periferico->set_nombre($resultado[0]['nombre']);
        $periferico->set_fabricante($resultado[0]['fabricante']);
        $periferico->set_tipo($resultado[0]['tipo']);
        $periferico->set_descripcion($resultado[0]['descripcion']);
        $periferico->set_interfaz($resultado[0]['interfaz']);
        $periferico->set_fecha_cambio($resultado[$resultado[0]['fecha_cambio']]);
        return $periferico;
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
