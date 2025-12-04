<div class="modal" tabindex="-1" id="confirmationModel{block name="id"}{/block}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bestätigung erforderlich</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {block name="modal_body"}
                    <p>Bist du dir sicher, dass du diesen Eintrag unwiederruflich löschen möchtest?</p>
                {/block}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Abbrechen</button>
                <a href="{block name="href"}{/block}" class="btn btn-primary">Löschen</a>
            </div>
        </div>
    </div>
</div>