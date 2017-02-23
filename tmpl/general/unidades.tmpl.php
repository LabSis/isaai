<?php if (strtolower($nombre_tempate_componente) === "disco" && strtolower($nombre_propiedad) === "tamaño"): ?>
    <span class="unidades">
        (bytes)
    </span>
<?php endif; ?>
<?php if (strtolower($nombre_tempate_componente) === "memoria"): ?>
    <?php if (strtolower($nombre_propiedad) === "capacidad"): ?>
        <span class="unidades">
            (bytes)
        </span>
    <?php endif; ?>
    <?php if (strtolower($nombre_propiedad) === "velocidad"): ?>
        <span class="unidades">
            (MHz)
        </span>
    <?php endif; ?>
<?php endif; ?>
<?php if (strtolower($nombre_tempate_componente) === "procesador"): ?>
    <?php if (strtolower($nombre_propiedad) === "tipo"): ?>
        <span class="unidades">
            (bits)
        </span>
    <?php endif; ?>
    <?php if (strtolower($nombre_propiedad) === "velocidad"): ?>
        <span class="unidades">
            (MHz)
        </span>
    <?php endif; ?>
<?php endif; ?>