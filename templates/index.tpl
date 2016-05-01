{include file='templates/inc/head.tpl'}
<body class="p1 bg--white measure" itemscope itemtype="http://schema.org/WebSite">
    <meta itemprop="url" content="{base_url|noscheme}" />
    {include file='templates/inc/header.tpl'}
    <form class="py1" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" method="GET" action="{path_for name='searchResults'}">
        <meta itemprop="target" content="{base_url}/search/?query={literal}{query}{/literal}" />
        <label for="query">Recherche</label>
        <input itemprop="query-input" type="text" id="query" name="query" placeholder="Nom ou numéro SIRET" />
        <input type="submit" value="Rechercher" />
    </form>
    <p>
        Les coopératives, mutuelles, fondations et associations sont des organisations basées sur des principes de solidarités et d'utilité sociale. Elles forment ce qu'on appelle l'économie sociale et solidaire (ESS), un mouvement qui recherche des modes de fonctionnements collectifs plus démocratiques, avec une lucrativité limitée.
    </p>
    <p>
        Ce site vous permet de recherche un organisme et d'obtenir des informations concernant sa forme juridique.
    </p>
</body>
</html>
