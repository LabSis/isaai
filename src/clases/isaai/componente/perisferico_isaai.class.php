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
        $resultado = $conexion->consultar('perisfericos', 'id, fecha_cambio, nombre, fabricante, tipo, descripcion, interfaz', 'id=' . $id_maquina);
        //new Perisferico($_id, $_nombre, $_fabricante, $_tipo, $_descripcion, $_interfaz)
        $perisferico = new Perisferico($resultado['id'], null, null, null, null, null);
        $perisferico->set_descripcion('descripcion');
        $perisferico->set_fabricante('fabricante');
        $perisferico->set_interfaz('interfaz');
        $perisferico->set_nombre('nombre');
        $perisferico->set_tipo('tipo');
        $perisferico->set_fecha_cambio($resultado['fecha_cambio']);
        return $perisferico;
    }

}
