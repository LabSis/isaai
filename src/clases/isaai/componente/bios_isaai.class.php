<?php

/**
 * Esta clase materializará un registro desde la BD de ISAAI en un objeto Bios.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class BiosISAAI implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        //Consultas a la BD_ISAAI para materializar el objeto.
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $id_maquina = $_maquina->get_id();
        $resultado = $conexion->consultar('bios', 'id, fecha_cambio, nombre, fabricante, modelo, asset_tag, version, numero_serial', 'id=' . $id_maquina);
        //new Bios($_id, $_nombre, $_fabricante, $modelo, $_asset_tag, $_version, $_numero_serial)
        $bios = new Bios($resultado['id'], null, null, null, null, null, null);
        $bios->setModelo($resultado['modelo']);
        $bios->set_asset_tag($resultado['asset_tag']);
        $bios->set_fabricante($resultado['fabricante']);
        $bios->set_nombre($resultado['nombre']);
        $bios->set_numero_serial($resultado['numero_serial']);
        $bios->set_version($resultado['version']);
        $bios->set_fecha_cambio($resultado['fecha_cambio']);
        return $bios;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
