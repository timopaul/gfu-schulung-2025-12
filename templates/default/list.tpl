{extends file="layout.tpl"}

{block name="title"}Artikelliste{/block}

{block name="content"}

    <h2 class="pb-2">Aktuelle Beiträge</h2>

    <table class="table table-hover table-striped w-100 align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th class="w-100">Titel</th>
            <th>Autor</th>
            <th>Status</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        {foreach $articles as $article}
            <tr>
                <td>{$article.id}</td>
                <td>{$article.title}</td>
                <td class="text-nowrap">{$article.author}</td>
                <td>{$article.status}</td>
                <td class="actions">
                    <div class="btn-group">
                        <a class="btn btn-outline-primary text-nowrap"
                           href="article.php?id={$article.id}">
                            <i class="bi bi-eye"></i> Ansehen
                        </a>
                        <a class="btn btn-primary text-nowrap"
                           href="form.php?id={$article.id}">
                            <i class="bi bi-pencil"></i> Bearbeiten
                        </a>

                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item bg-danger text-white" type="button"
                                        data-bs-toggle="modal" data-bs-target="#confirmationModel-{$article.id}">
                                    <i class="bi bi-trash"></i> Löschen
                                </button>
                            </li>
                        </ul>
                    </div>
                    {include file="partials/modals/confirmation-article-delete.tpl" id=$article.id}
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>

{/block}