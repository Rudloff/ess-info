{include file='templates/inc/head.tpl'}
<body class="p1 bg--white">
    {include file='templates/inc/header.tpl'}
    <form method="post" action="{urlFor name='searchResults'}">
        <label for="query">Recherche</label>
        <input type="text" id="query" name="query" placeholder="Nom ou numéro SIRET" />
        <input type="submit" value="Rechercher" />
    </form>
</body>
