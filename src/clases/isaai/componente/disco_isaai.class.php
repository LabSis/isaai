<?php

/**
 * Esta clase materializará un registro de la tabla "discos", en la BD del ISAAI
 * en un objeto Disco.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class DiscoISAAI implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        //Consultas a la BD_ISAAI para materializar el objeto.
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $id_maquina = $_maquina->get_id();
        $resultado = $conexion->consultar('discos', 'id, fecha_cambio, nombre, fabricante, modelo, descripcion, tipo, tamanio, numero_serial, firmware', 'id=' . $id_maquina);
        //new Disco($_id, $_nombre, $_fabricante, $_modelo, $_descripcion, $_tipo, $_tamanio, $_numero_serial, $_firmware)
        $disco = new Disco($resultado['id'], null, null, null, null, null, null, null, null);
        $disco->set_descripcion($resultado['descripcion']);
        $disco->set_fabricante($resultado['fabricante']);
        $disco->set_firmware($resultado['firmware']);
        $disco->set_modelo($resultado['modelo']);
        $disco->set_nombre($resultado['nombre']);
        $disco->set_numero_serial($resultado['numero_serial']);
        $disco->set_tamanio($resultado['tamanio']);
        $disco->set_tipo($resultado['tipo']);
        $disco->set_fecha_cambio($resultado['fecha_cambio']);
        return $disco;
    }

}
