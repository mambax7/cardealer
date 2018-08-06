<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CARDEALER_ITEMNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_LABOR}></th>
        <th><{$smarty.const.MB_CARDEALER_TITLE}></th>
        <th><{$smarty.const.MB_CARDEALER_DESCRIPTION}></th>
    </tr>
    <{foreach item=service from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$service.itemnum}>
                <{$service.labor}>
                <{$service.title}>
                <{$service.description}>
            </td>
        </tr>
    <{/foreach}>
</table>
