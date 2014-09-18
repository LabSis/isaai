<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "perisfericos" de la base de datos del ISAAI.
 *
 * @author Milagros Zea
 * @version  1.0
 */
class PerisfericoISAAI implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $id_maquina = $_maquina->get_id();
        $resultado = $conexion->consultar('perifericos', 'id, fecha_cambio, nombre, fabricante, tipo, descripcion, interfaz', 'id=' . $id_maquina);
        //new Perisferico($_id, $_nombre, $_fabricante, $_tipo, $_descripcion, $_interfaz)
        $perisferico = new Perisferico($resultado[0]['id'], null, null, null, null, null);
        $perisferico->set_descripcion($resultado[0]['descripcion']);
        $perisferico->set_fabricante($resultado[0]['fabricante']);
        $perisferico->set_interfaz($resultado[0]['interfaz']);
        $perisferico->set_nombre($resultado[0]['nombre']);
        $perisferico->set_tipo($resultado[0]['tipo']);
        $perisferico->set_fecha_cambio($resultado[$resultado[0]['fecha_cambio']]);
        return $perisferico;
    }

}
