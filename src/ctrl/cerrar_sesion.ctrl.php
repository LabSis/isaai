<?php

require_once '../../config.php';

if (Sesion::get_instancia()->activo()) {
    Sesion::get_instancia()->cerrar_sesion();
}

Util::ir_inicio();
