{extends file="layout.tpl"}

{block name="title"}Artikel: {$article.title}{/block}

{block name="content"}

    <h2>Artikel: {$article.title}</h2>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{$article.title}</h5>
        </div>
        <div class="card-body">
            {foreach $paragraphs as $paragraph}
                <p class="card-text">{$paragraph}</p>
            {/foreach}

            <a href="{$smarty.env.PROJECT_URL}/articles" class="card-link">Zurück zur Artikelliste</a>
            <a href="{$smarty.env.PROJECT_URL}/article/edit/{$article.id}" class="card-link">Artikel bearbeiten</a>
        </div>
        <div class="card-footer">
            Erstellt am {$article.created_at|date_format:"%d.%m.%Y %H:%M"} von {$author.name}
        </div>
    </div>
{/block}