{extends file="layout.tpl"}

{block name="title"}
    {if (isset($values) && isset($values.id))}
        Artikel bearbeiten
    {else}
        Neuen Artikel erstellen
    {/if}
{/block}

{block name="content"}

    <h2>
        {if (isset($values) && isset($values.id))}
            Artikel bearbeiten
        {else}
            Neuen Artikel erstellen
        {/if}
    </h2>

    <div class="row">
        <div class="col-4 mx-auto">

            {if isset($errors)}
                <div class="alert alert-danger">
                    {if isset($errors.general)}
                        {$errors.general}
                    {else}
                        Bitte korrigieren Sie die Fehler im Formular.
                    {/if}
                </div>
            {/if}

            <form action="form.php" method="POST">

                {if (isset($values) && isset($values.id))}
                    <input type="hidden" name="id" value="{$values.id}">
                {/if}

                <div class="mb-3">
                    <label class="form-label" for="title">Titel:</label>
                    <input class="form-control{isset($errors) && isset($errors.title) ? ' is-invalid' : ''}"
                           value="{isset($values.title) ? $values.title : ''}"
                           type="text" id="title" name="title">
                    {if isset($errors) && isset($errors.title)}
                        <div class="invalid-feedback">{$errors.title}</div>
                    {/if}
                </div>

                <div class="mb-3">
                    <label class="form-label" for="author">Autor:</label>
                    <select class="form-select{isset($errors) && isset($errors.author_id) ? ' is-invalid' : ''}"
                            id="author" name="author_id">
                        <option value="" class="d-none">-- Bitte wähle einen Autor --</option>
                        {foreach $authors as $author}
                            <option value="{$author.id}"
                                    {isset($values.author_id) && $values.author_id === $author.id ? 'selected' : ''}
                            >{$author.name}</option>
                        {/foreach}
                    </select>
                    {if isset($errors) && isset($errors.author_id)}
                        <div class="invalid-feedback">{$errors.author_id}</div>
                    {/if}
                </div>

                <div class="mb-3">
                    <label class="form-label" for="text">Inhalt:</label>
                    <textarea class="form-control{isset($errors) && isset($errors.text) ? ' is-invalid' : ''}"
                              id="text" name="text">{isset($values.text) ? $values.text : ''}</textarea>
                    {if isset($errors) && isset($errors.text)}
                        <div class="invalid-feedback">{$errors.text}</div>
                    {/if}
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status">Status:</label>
                    <select class="form-select" id="status" name="status">
                        <option value="draft"
                                {(isset($values) && 'draft' == $values.status) ? 'selected' : ''}
                        >Entwurf</option>
                        <option value="published"
                                {(isset($values) && 'published' == $values.status) ? 'selected' : ''}
                        >Veröffentlicht</option>
                    </select>
                </div>

                <div class="mb-3 text-end">
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" type="reset">
                            <i class="bi bi-x-circle"></i> zurücksetzen
                        </button>
                        <button class="btn btn-primary text-white" type="submit">
                            <i class="bi bi-floppy"></i> Artikel speichern
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

{/block}