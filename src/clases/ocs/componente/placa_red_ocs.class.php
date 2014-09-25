<?php

/**
 * Esta clase materializará un registro de la tabla "networks" desde ocsweb en un 
 * objeto Placa de Red.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class PlacaRedOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT ipadress, macaddr, ipsubnet, ipmask,"
                . " ipgateway, description, type, speed FROM networks AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $placa_red = new PlacaRed(null, null, null, null, null, null, null, null, null, null);
        $placa_red->set_id(null);
        $placa_red->set_direccion_ip($resultado[0]['ipadress']);
        $placa_red->set_direccion_mac($resultado[0]['macaddr']);
        $placa_red->set_direccion_red($resultado[0]['ipsubnet']);
        $placa_red->set_direccion_dns($resultado[0]['']);
        $placa_red->set_mascara($resultado[0]['ipmask']);
        $placa_red->set_gateway($resultado[0]['ipgateway']);
        $placa_red->set_descripcion($resultado[0]['description']);
        $placa_red->set_tipo($resultado[0]['type']);
        $placa_red->set_velocidad($resultado[0]['speed']);
        return $placa_red;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
