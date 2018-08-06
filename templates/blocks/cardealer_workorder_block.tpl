<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CARDEALER_ID}></th>
        <th><{$smarty.const.MB_CARDEALER_CUSTNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_CARNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_COST}></th>
        <th><{$smarty.const.MB_CARDEALER_ORDERDATE}></th>
        <th><{$smarty.const.MB_CARDEALER_STATUS}></th>
    </tr>
    <{foreach item=workorder from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$workorder.id}>
                <{$workorder.custnum}>
                <{$workorder.carnum}>
                <{$workorder.cost}>
                <{$workorder.orderdate}>
                <{$workorder.status}>
            </td>
        </tr>
    <{/foreach}>
</table>
