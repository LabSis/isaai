<?php

/**
 * 
 * @author Parisi Germán
 * @version 1.0
 */
class AlertadorWeb implements Alertador{
    public function alertar($cambio, $roles) {
        $servidor = Servidor::get_instancia();
        $servidor->enviar_alerta("ALERTA!!!!!!!!!!!!!!!!!!!!!!!. TE ESTAN ROBANDOOOOOOO!!!");
    }
}