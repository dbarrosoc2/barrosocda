<div class="modal fade no-auto-show modalPregunta" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?= isset($modalPreguntaTitle) ? $modalPreguntaTitle : "" ?></h5>
        </div>
        <div class="modal-body">
            <p>
                <?= isset($modalPreguntaDescription) ? $modalPreguntaDescription : "" ?>
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary modalPreguntaContinuar">Continuar</button>
        </div>
        </div>
    </div>
</div>