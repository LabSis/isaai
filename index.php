<?php

require_once 'config.php';

$gestor_capturaciones = new GestorCapturaciones();
$gestor_capturaciones->obtener_listas();
