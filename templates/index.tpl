{include file='templates/inc/head.tpl'}
<body class="p1">
    <h1 class="txt--center">ESS info</h1>
    <form method="post" action="{urlFor name='searchResults'}">
        <label for="query">Recherche</label>
        <input type="text" id="query" name="query" placeholder="Nom ou numéro SIRET" />
        <input type="submit" />
    </form>
</body>
