{include file='templates/inc/head.tpl'}
<body class="p1 bg--white" itemscope itemtype="http://schema.org/WebSite">
    <meta itemprop="url" content="{base_url|noscheme}" />
    {include file='templates/inc/header.tpl'}
    <form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" method="get" action="{path_for name='searchResults'}">
        <meta itemprop="target" content="{base_url}/search/?query={literal}{query}{/literal}" />
        <label for="query">Recherche</label>
        <input itemprop="query-input" type="text" id="query" name="query" placeholder="Nom ou numéro SIRET" />
        <input type="submit" value="Rechercher" />
    </form>
</body>
