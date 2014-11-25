<div id="fondoNegro"></div>
<header>
    <div id="fondoCabecera">
        <h1 id="tituloPrincipal">Sistema de Alertas Automáticas</h1><!-- Inventario Seguro de Alertas Automatias en Ambientes Informativos de activos TI -->
        <?php $sesion = Sesion::get_instancia(); ?>
        <div id="seccionUsuario">
            <?php if ($sesion->activo() == true): ?>
                <p id="botonUsuario">
                    <?php echo $sesion->get_usuario()->get_nombre(); ?>
                </p>
                <ul id="menuSeccionUsuario">
                    <li>
                        Editar datos
                    </li>
                    <li>
                        Administrar cuentas
                    </li>
                    <li>
                        Cambiar rol
                    </li>
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
            Máquina nueva agregada: roadrunner, 17:33 27/10/14
        </h2>
    </div>
</header>