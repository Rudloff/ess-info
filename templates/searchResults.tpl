{include file='templates/inc/head.tpl'}
<body class="p1 bg--white measure">
    {include file='templates/inc/header.tpl'}
    <div class="grd py1">
        <form class="grd-row" method="GET" action="{path_for name='searchResults'}">
            <input class="grd-row-col-5-6" title="Recherche" itemprop="query-input" type="text" id="query" name="query" placeholder="Nom ou numéro SIRET" value="{$query}" />
            <input class="grd-row-col-1-6" type="submit" value="Rechercher" style="margin-top:0;" />
        </form>
    </div>
    {if !(empty($results))}
        <table>
            <tr>
                <th>Nom</th>
                <th>SIRET</th>
                <th>Département</th>
                <th>Ville</th>
                <th>Actif</th>
            </tr>
            {foreach $results as $result}
                <tr class="brdr--light-gray">
                    <td><a href="{path_for name='company' data=['siret'=>$result->siret]}">{$result->name}</a></td>
                    <td>{$result->siret}</td>
                    {if isset($result->address.zipcode)}
                        <td class="txt--right">{$result->address.zipcode|substr:0:2}</td>
                    {else}
                        <td></td>
                    {/if}
                    {if isset($result->address.city)}
                        <td>{$result->address.city}</td>
                    {else}
                        <td></td>
                    {/if}
                    {if $result->removed}
                        <td class="fnt--red">❌</td>
                    {else}
                        <td class="fnt--green">✔</td>
                    {/if}
                </tr>
            {/foreach}
        </table>
    {else}
        <div class="txt--center">Aucun résultat</div>
    {/if}
</body>
</html>
