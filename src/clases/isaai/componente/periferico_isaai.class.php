<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "perisfericos" de la base de datos del ISAAI.
 *
 * @author Milagros Zea
 * @version  1.0
 */
class PerifericoIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT p.nombre, p.fabricante, p.tipo, "
                . "p.descripcion, p.interfaz, p.fecha_cambio FROM perifericos AS p "
                . "INNER JOIN maquinas AS maquina ON "
                . "p.id_maquina = maquina.id AND p.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $perifericos = array();
        if (empty($resultados)) {
            $consulta = "SELECT p.nombre, p.fabricante, p.tipo, "
                    . "p.descripcion, p.interfaz, p.fecha_cambio FROM perifericos AS p "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "p.id_maquina = maquina.id AND p.fecha_cambio = maquina.fecha_cambio "
                    . "WHERE maquina.id = '{$id_maquina->get_id_hash()}' AND p.fecha_cambio = ("
                    . " SELECT MAX(p2.fecha_cambio) FROM perifericos AS p2 "
                    . " WHERE p2.id_maquina = maquina.id"
                    . ")";
            $resultados = $conexion->consultar_simple($consulta);
        }
        for ($i = 0; $i < count($resultados); $i++) {
            $periferico = new Periferico();
            $periferico->set_id(null);
            $periferico->set_nombre($resultados[$i]['nombre']);
            $periferico->set_fabricante($resultados[$i]['fabricante']);
            $periferico->set_tipo($resultados[$i]['tipo']);
            $periferico->set_descripcion($resultados[$i]['descripcion']);
            $periferico->set_interfaz($resultados[$i]['interfaz']);
//            $periferico->set_fecha_cambio($resultados[$resultados[$i]['fecha_cambio']]);
            $perifericos[] = $periferico;
        }
        return $perifericos;
    }

    public static function desmaterializar($maquina, $periferico) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => $maquina->get_fecha_cambio(),
            'fabricante' => $periferico->get_fabricante(),
            'nombre' => $periferico->get_nombre(),
            'tipo' => $periferico->get_tipo(),
            'descripcion' => $periferico->get_descripcion(),
            'interfaz' => $periferico->get_interfaz()
        );
        return $conexion->insertar('perifericos', $datos_insercion);
    }

}
