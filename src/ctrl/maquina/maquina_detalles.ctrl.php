<?php

require_once '../../../config.php';

if (isset($_GET['id']) && isset($_GET['fecha_cambio'])) {
    $id_maquina = $_GET['id'];
    $fecha_cambio = $_GET['fecha_cambio'];
    $id_maquina_isaai = new IdMaquinaIsaai($id_maquina, $fecha_cambio);
    $capturador_isaai = new CapturadorIsaai();
    $maquina = $capturador_isaai->obtener_maquina($id_maquina_isaai);
    $template_componentes = array();
    $bios = $maquina->get_bios();
    $template_componentes['Bios'] = array(
        "Nombre" => $bios->get_nombre(),
        "Fabricante" => $bios->get_fabricante(),
        "Modelo" => $bios->get_modelo(),
        "Asset tag" => $bios->get_asset_tag(),
        "Version" => $bios->get_version(),
        "Número serie" => $bios->get_numero_serial()
    );
    $discos = $maquina->get_discos();
    foreach ($discos as $disco) {
        $template_componentes['Disco'] = array(
            "Nombre" => $disco->get_nombre(),
            "Fabricante" => $disco->get_fabricante(),
            "Modelo" => $disco->get_modelo(),
            "Descripcion" => $disco->get_descripcion(),
            "Tipo" => $disco->get_tipo(),
            "Tamaño" => $disco->get_tamanio(),
            "Firmware" => $disco->get_firmware(),
            "Número serie" => $disco->get_numero_serial()
        );
    }
}
require_once $global_ruta_servidor . '/tmpl/maquina/maquina_detalles.tmpl.php';
