{include file='templates/inc/head.tpl'}
<body class="p1">
    {include file='templates/inc/header.tpl'}
    <h2>{$info->name}</h2>
    <strong>{$category}</strong>
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
    </table>
    <p>
        {$types.$category.description}
    </p>
</body>
