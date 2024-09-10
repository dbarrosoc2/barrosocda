<a 
href="<?= $itemTrabajoURL ?>" target="<?php echo $itemTrabajoURL !== "#!" && $itemTrabajoURL !== "" ? "_blank" : ""?>" 
class="trabajos-block__contenedor--item">
    <div class="trabajos-block__contenedor--item--icono">
        <i class="bi bi-hospital"></i>
    </div>
    <div class="trabajos-block__contenedor--item--texto">
         <?= $itemTrabajoTitle ?>
    </div>
</a>