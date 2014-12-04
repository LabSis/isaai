<aside id="menuPrincipal" <?php if (Sesion::get_instancia()->get_dato("ocultar_menu") == "ocultar") echo "class='oculto'"; ?>>
    <ul>
        <li>
            <a href="#" id="btnSincronizar"><i class="fa fa-refresh fa-fw icono"></i><span class="spnTextMenu">Sincronizar</span></a>
        </li>
        <li>
            <a href="<?php echo $global_ruta_web; ?>/src/ctrl/maquina/maquinas.ctrl.php"><i class="fa fa-desktop fa-fw icono"></i><span class="spnTextMenu">Máquinas</span></a>
        </li>
        <li>
            <a href="<?php echo $global_ruta_web; ?>/src/ctrl/componente/componentes.ctrl.php"><i class="fa fa-cube fa-fw icono"></i><span class="spnTextMenu">Componentes</span></a>
        </li>
        <li>
            <a href="#"><i class="fa fa-cog fa-fw icono"></i><span class="spnTextMenu">Configurar</span></a>
        </li>
    </ul>
    <div id="seccionOcultarMostrarMenu">
        <i class="fa fa-arrow-left icono iconoBoton"></i>
    </div>
</aside>