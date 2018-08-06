<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CARDEALER_CUSTNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_CUSTNAME}></th>
        <th><{$smarty.const.MB_CARDEALER_CUSTADDR}></th>
    </tr>
    <{foreach item=customer from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$customer.custnum}>
                <{$customer.custname}>
                <{$customer.custaddr}>
            </td>
        </tr>
    <{/foreach}>
</table>
