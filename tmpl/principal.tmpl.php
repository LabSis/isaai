<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-AR">
    <head>
        <?php require_once dirname(__FILE__) . '/marco/head.tmpl.php' ?>
    </head>
    <body>
        <?php require_once  dirname(__FILE__) . '/marco/cabecera.tmpl.php' ?>
        <main>
            <aside id="menuPrincipal">
                <ul>
                    <li>
                        Máquinas
                    </li>
                    <li>
                        Componentes
                    </li>
                    <li>
                        Sincronizar
                    </li>
                    <li>
                        Configurar
                    </li>
                </ul>
            </aside>
            <div id="contenido">
                
            </div>
            <div class="clearer"></div>
        </main>
        <?php require_once $global_ruta_servidor . '/tmpl/marco/pie_pagina.tmpl.php' ?>
    </body>
</html>