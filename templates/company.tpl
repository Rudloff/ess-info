{include file='templates/inc/head.tpl'}
<body class="p1 bg--white measure">
    {include file='templates/inc/header.tpl'}
    <h2>{$info->name}</h2>
    <strong>{$category}</strong>{if $info->removed} (radié){/if}
    <table>
        <tr>
            <th class="brdr--light-gray">SIRET</th>
            <td class="brdr--light-gray">{$info->siret}</td>
        </tr>
        <tr>
            <th class="brdr--light-gray">Adresse</th>
            <td class="brdr--light-gray">
                {foreach $info->address.lines as $line}
                    {$line}<br/>
                {/foreach}
                {if isset($info->address.zipcode)}
                    {$info->address.zipcode}
                {/if}
                {$info->address.city}
            </td>
        </tr>
        <tr>
            <th class="brdr--light-gray">Activité principale</th>
            <td class="brdr--light-gray">{$activity}</td>
        </tr>
        <tr>
            <th class="brdr--light-gray">Catégorie</th>
            {if isset($types.$category.ess)}
                {if $types.$category.ess}
                    <td class="brdr--light-gray bg--green fnt--white"><abbr title="Économie sociale et solidaire">ESS</abbr></td>
                {else}
                    <td class="brdr--light-gray bg--red fnt--white">Privé hors <abbr title="Économie sociale et solidaire">ESS</abbr></td>
                {/if}
            {elseif isset($types.$category.public) && $types.$category.public}
                <td class="brdr--light-gray bg--blue fnt--white">Public</td>
            {else}
                <td class="brdr--light-gray">Autre</td>
            {/if}
        </tr>
        <tr>
            <td colspan="2" class="brdr--light-gray">
                <a target="_blank" href="{$url}">Fiche Infogreffe</a>
            </td>
        </tr>
    </table>
    <p>
        {if isset($types.$category.description)}
            {$types.$category.description}
        {/if}
    </p>
</body>
</html>
