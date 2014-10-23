<?php if (Sesion::get_instancia()->hay_mensajes()): ?>
    <?php foreach (Sesion::get_instancia()->get_mensajes() as $tipo_mensaje => $mensajes_por_tipo): ?>
        <?php if (!empty($mensajes_por_tipo)): ?>
            <div class="mensaje mensaje<?php echo ucfirst($tipo_mensaje); ?>">
                <?php if (count($mensajes_por_tipo) === 1): ?>
                    <p>
                        <?php echo $mensajes_por_tipo[0]; ?>
                    </p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($mensajes_por_tipo as $texto_mensaje) : ?>
                            <li>
                                <?php echo $texto_mensaje; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php Sesion::get_instancia()->limpiar_mensajes(); ?>
<?php endif; ?>