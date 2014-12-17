<?php

/**
 * Cada alertador debe implementar esta interfaz.
 * 
 * @author Parisi Germán
 * @version 1.0
 */
interface Alertador {
    /**
     * Este método debe generar la alerta por el medio correspondiente.
     * @param \Mensaje $mensajes Es un colección de mensajes, cada uno contiene 
     * el cambio, los roles a los cuales se debe alertar y con sus tipos de cambio.
     */
    public function alertar($mensajes_usuarios);
}