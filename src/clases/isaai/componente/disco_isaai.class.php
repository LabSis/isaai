<?php

/**
 * Esta clase materializará un registro de la tabla "discos", en la BD del ISAAI
 * en un objeto Disco.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class DiscoIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT d.nombre, d.fabricante, d.modelo, d.descripcion, "
                . "d.tipo, d.firmware, d.tamanio, d.numero_serial, d.fecha_cambio FROM discos AS d "
                . "INNER JOIN maquinas AS maquina ON "
                . "d.id_maquina = maquina.id AND d.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $discos = array();
        if (empty($resultados)) {
             $consulta = "SELECT d.nombre, d.fabricante, d.modelo, d.descripcion, "
                . "d.tipo, d.firmware, d.tamanio, d.numero_serial, d.fecha_cambio FROM discos AS d "
                . "INNER JOIN maquinas AS maquina ON "
                . "d.id_maquina = maquina.id WHERE d.fecha_cambio = ("
                     . " SELECT MAX(d2.fecha_cambio) FROM discos AS d2 "
                     . " WHERE d2.id_maquina = maquina.id"
                     . ")";
            $resultados = $conexion->consultar_simple($consulta);
        }
        for ($i = 0; $i < count($resultados); $i++) {
            $disco = new Disco();
            $disco->set_id(null);
            $disco->set_nombre($resultados[$i]['nombre']);
            $disco->set_fabricante($resultados[$i]['fabricante']);
            $disco->set_modelo($resultados[$i]['modelo']);
            $disco->set_descripcion($resultados[$i]['descripcion']);
            $disco->set_tipo($resultados[$i]['tipo']);
            $disco->set_firmware($resultados[$i]['firmware']);
            $disco->set_tamanio($resultados[$i]['tamanio']);
            $disco->set_numero_serial($resultados[$i]['numero_serial']);
//            $disco->set_fecha_cambio($resultados[$i]['fecha_cambio']);
            $discos[] = $disco;
        }
        return $discos;
    }

    public static function desmaterializar($maquina, $disco) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => $maquina->get_fecha_cambio(),
            'nombre' => $disco->get_nombre(),
            'fabricante' => $disco->get_fabricante(),
            'modelo' => $disco->get_modelo(),
            'descripcion' => $disco->get_descripcion(),
            'tipo' => $disco->get_tipo(),
            'tamanio' => $disco->get_tamanio(),
            'numero_serial' => $disco->get_numero_serial(),
            'firmware' => $disco->get_firmware()
        );
        return $conexion->insertar('discos', $datos_insercion);
    }

}
