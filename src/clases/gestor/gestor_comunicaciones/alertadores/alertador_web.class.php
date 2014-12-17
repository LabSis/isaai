<?php

/**
 * 
 * @author Parisi Germán
 * @version 1.0
 */
class AlertadorWeb implements Alertador{
    public function alertar($mensajes_x_usuarios) {
        $servidor = Servidor::get_instancia();
        $servidor->enviar_alerta("ALERTA!!!!!!!!!!!!!!!!!!!!!!!. TE ESTAN ROBANDOOOOOOO!!!");
    }
}