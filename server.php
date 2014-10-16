<?php

require_once 'config.php';
require_once 'src/clases/socket/servidor.class.php';
$servidor = Servidor::get_instancia();
$servidor->iniciar();
$servidor->recibir_cliente();