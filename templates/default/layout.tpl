<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/layout.css">
    <script src="styles/bootstrap.bundle.min.js"></script>

    <title>{block name="title"}{/block}</title>
</head>
<body>

<div class="bg-secondary">
    <div class="container">
        {include file="partials/header.tpl"}
    </div>
</div>

<div class="container">

    <main class="py-5">
        {block name="content"}{/block}
    </main>

    {include file="partials/footer.tpl"}

</div>
</body>
</html>