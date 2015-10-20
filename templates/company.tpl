{include file='templates/inc/head.tpl'}
<body class="p1">
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
                {$info->address.zipcode} {$info->address.city}
            </td>
        </tr>
        <tr>
            <th class="brdr--light-gray">Activité principale</th>
            <td class="brdr--light-gray">{$activity}</td>
        </tr>
    </table>
</body>
