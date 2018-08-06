<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CARDEALER_ID}></th>
        <th><{$smarty.const.MB_CARDEALER_PARTNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_ITEMNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_QUANTITY}></th>
    </tr>
    <{foreach item=servpart from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$servpart.id}>
                <{$servpart.partnum}>
                <{$servpart.itemnum}>
                <{$servpart.quantity}>
            </td>
        </tr>
    <{/foreach}>
</table>
