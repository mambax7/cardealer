<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CARDEALER_ID}></th>
        <th><{$smarty.const.MB_CARDEALER_CUSTNUM}></th>
        <th><{$smarty.const.MB_CARDEALER_MAKE}></th>
        <th><{$smarty.const.MB_CARDEALER_MODEL}></th>
        <th><{$smarty.const.MB_CARDEALER_YEAR}></th>
        <th><{$smarty.const.MB_CARDEALER_PICTURES}></th>
        <th><{$smarty.const.MB_CARDEALER_SERIALNUM}></th>
    </tr>
    <{foreach item=vehicle from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$vehicle.id}>
                <{$vehicle.custnum}>
                <{$vehicle.make}>
                <{$vehicle.model}>
                <{$vehicle.year}>
                <{$vehicle.pictures}>
                <{$vehicle.serialnum}>
            </td>
        </tr>
    <{/foreach}>
</table>
