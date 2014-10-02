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
        $consulta = "SELECT n.ipaddress, n.macaddr, n.ipsubnet, n.ipmask, "
                . " n.ipgateway, n.description, n.type, n.speed FROM networks AS n INNER JOIN hardware AS hardware ON "
                . " n.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $placas_red = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $placa_red = new PlacaRed();
            $placa_red->set_id(null);
            $placa_red->set_direccion_ip($resultados[$i]['ipaddress']);
            $placa_red->set_direccion_mac($resultados[$i]['macaddr']);
            $placa_red->set_direccion_red($resultados[$i]['ipsubnet']);
            $placa_red->set_direccion_dns(null);
            $placa_red->set_mascara($resultados[$i]['ipmask']);
            $placa_red->set_gateway($resultados[$i]['ipgateway']);
            $placa_red->set_descripcion($resultados[$i]['description']);
            $placa_red->set_tipo($resultados[$i]['type']);
            $placa_red->set_velocidad($resultados[$i]['speed']);
            $placas_red[] = $placa_red;
        }
        return $placas_red;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
