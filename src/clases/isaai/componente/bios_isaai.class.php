<?php

/**
 * Esta clase materializará un registro desde la BD de ISAAI en un objeto Bios.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class BiosIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT b.nombre,  b.fabricante, b.modelo, b.asset_tag, "
                . "b.version, b.numero_serial, b.fecha_cambio FROM bios AS b "
                . "INNER JOIN maquinas AS maquina ON "
                . "b.id_maquina = maquina.id AND b.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $bios = new Bios();
        $bios->set_id(null);
        $bios->set_nombre($resultado[0]['nombre']);
        $bios->set_fabricante($resultado[0]['fabricante']);
        $bios->set_modelo($resultado[0]['modelo']);
        $bios->set_asset_tag($resultado[0]['asset_tag']);
        $bios->set_version($resultado[0]['version']);
        $bios->set_numero_serial($resultado[0]['numero_serial']);
//        $bios->set_fecha_cambio($resultado[0]['fecha_cambio']);
        return $bios;
    }

    public static function desmaterializar($maquina, $bios) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => $maquina->get_fecha_cambio(),
            'nombre' => $bios->get_nombre(),
            'fabricante' => $bios->get_fabricante(),
            'modelo' => $bios->get_modelo(),
            'asset_tag' => $bios->get_asset_tag(),
            'version' => $bios->get_version(),
            'numero_serial' => $bios->get_numero_serial()
        );
        return $conexion->insertar('bios', $datos_insercion);
    }

}
