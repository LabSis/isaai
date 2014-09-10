<?php

/**
 * Esta clase materialzará un registro de la tabla "bios" desde ocsweb en un 
 * objeto bios
 *
 * @author Milagros Zea
 * @version 1.0
 */
class BiosOCS implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $consulta = $this->obtener_consulta($_maquina->get_sistema_operativo()->get_nombre(), $_maquina->get_sistema_operativo()->get_nombre(), $_maquina->get_sistema_operativo()->get_version());
        $resultado = $conexion->consultar_simple($consulta);
        //cargo el objeto bios...
        $bios = new Bios();
        $bios->set_nombre($resultado[0]['smanufacturer']);
        $bios->set_fabricante($resultado[0]['bmanufacturer']);
        $bios->setModelo($resultado[0]['smodel']);
        $bios->set_asset_tag($resultado[0]['assettag']);
        $bios->set_version($resultado[0]['bversion']);
        $bios->set_numero_serial($resultado[0]['ssn']);
        return $bios;
    }

    /**
     * Este consulta buscará a una máquina (que ya existe en la bs de isaai) 
     * según el nombre, el sistema operativo y la version del sistema operativo.
     * @param type $_nombre_maquina
     * @param type $_sistema_operativo
     * @param type $_version_sistema_operativo
     * @return type
     */
    private function obtener_consulta($_nombre_maquina, $_sistema_operativo, $_version_sistema_operativo) {
        return 'SELECT smanufacturer, bmanufacturer, smodel, assettag,'
                . ' bversion, ssn  FROM bios WHERE bios.hardware_id = '
                . '(SELECT id FROM hardware WHERE hardware.name ='
                . $_nombre_maquina . ' AND hardware.osname= ' . $_sistema_operativo
                . ' AND hardware.osversion= ' . $_version_sistema_operativo
                . ' AND hardware.lastcome = (SELECT MAX(hardware.lastcome) '
                . 'FROM hardware WHERE hardware.name = ' . $_nombre_maquina
                . ' AND hardware.osname= ' . $_sistema_operativo
                . ' AND hardware.osversion= ' . $_version_sistema_operativo . '))';
    }

}
