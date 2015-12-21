{include file='templates/inc/head.tpl'}
<body class="p1 bg--white">
    {include file='templates/inc/header.tpl'}
    <table>
        <tr>
            <th>Nom</th>
            <th>SIRET</th>
            <th>Département</th>
            <th>Ville</th>
        </tr>
        {foreach $results as $result}
            <tr class="brdr--light-gray">
                <td><a href="{urlFor name='company' options="siret.{$result->siret}"}">{$result->name}</a></td>
                <td>{$result->siret}</td>
                {if isset($result->address.zipcode)}
                    <td class="txt--right">{$result->address.zipcode|substr:0:2}</td>
                {/if}
                {if isset($result->address.city)}
                    <td>{$result->address.city}</td>
                {/if}
            </tr>
        {/foreach}
    </table>
</body>
