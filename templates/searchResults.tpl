{include file='templates/inc/head.tpl'}
<body class="p1">
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
                <td class="txt--right">{$result->address.zipcode|substr:0:2}</td>
                <td>{$result->address.city}</td>
            </tr>
        {/foreach}
    </table>
</body>
