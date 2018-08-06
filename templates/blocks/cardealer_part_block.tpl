<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CARDEALER_PARTNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_PRICE}></th>
        <th><{$smarty.const.MB_CARDEALER_STOCK}></th>
        <th><{$smarty.const.MB_CARDEALER_TITLE}></th>
        <th><{$smarty.const.MB_CARDEALER_DESCRIPTION}></th>
        <th><{$smarty.const.MB_CARDEALER_PICTURE}></th>
    </tr>
    <{foreach item=part from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$part.partnum}>
                <{$part.price}>
                <{$part.stock}>
                <{$part.title}>
                <{$part.description}>
                <{$part.picture}>
            </td>
        </tr>
    <{/foreach}>
</table>
