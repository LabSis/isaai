<header>
    <div id="fondoCabecera">
        <h1 id="tituloPrincipal">Sistema de Alertas Automáticas</h1><!-- Inventario Seguro de Alertas Automatias en Ambientes Informativos de activos TI -->
        <?php $sesion = Sesion::get_instancia(); ?>
        <div id="seccionUsuario">
            <?php if ($sesion->activo() == true): ?>
                <p id="botonUsuario">
                    <?php echo $sesion->get_usuario()->get_nombre_usuario(); ?>
                </p>				
                <ul id="menuSeccionUsuario">
                    <?php if($sesion->get_usuario()->es_administrador()): ?>
						<li>
							<a href="<?php echo $global_ruta_web . "/src/ctrl/usuario/usuarios.ctrl.php"; ?>">
								Usuarios
							</a>
						</li>					
					<?php endif;?>
                    <li>
                        <a href="<?php echo $global_ruta_web . "/src/ctrl/cerrar_sesion.ctrl.php"; ?>">
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            <?php else: ?>
                <p id="botonUsuario">
                    <a href="<?php echo $global_ruta_web . "/index.php"; ?>">Iniciar sesión</a>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div id="cabeceraMensajes">
        <h2 id="mensajesAlerta">           
            <i class="fa fa-exclamation-triangle" id="iconoAlerta"></i>
        </h2>
    </div>
</header>
