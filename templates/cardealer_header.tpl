<div class="header">
    <span class="left"><b><{$smarty.const.MD_CARDEALER_TITLE}></b>&#58;&#160;</span>
    <span class="left"><{$smarty.const.MD_CARDEALER_DESC}></span><br>
</div>
<div class="head">
    <{if $adv != ''}>
        <div class="center"><{$adv}></div>
    <{/if}>
</div>
<br>
<ul class="nav nav-pills">
    <li class="active"><a href="<{$cardealer_url}>"><{$smarty.const.MD_CARDEALER_INDEX}></a></li>

    <li><a href="<{$cardealer_url}>/customer.php"><{$smarty.const.MD_CARDEALER_CUSTOMER}></a></li>
    <li><a href="<{$cardealer_url}>/part.php"><{$smarty.const.MD_CARDEALER_PART}></a></li>
    <li><a href="<{$cardealer_url}>/service.php"><{$smarty.const.MD_CARDEALER_SERVICE}></a></li>
    <li><a href="<{$cardealer_url}>/servpart.php"><{$smarty.const.MD_CARDEALER_SERVPART}></a></li>
    <li><a href="<{$cardealer_url}>/vehicle.php"><{$smarty.const.MD_CARDEALER_VEHICLE}></a></li>
    <li><a href="<{$cardealer_url}>/workorder.php"><{$smarty.const.MD_CARDEALER_WORKORDER}></a></li>
    <li><a href="<{$cardealer_url}>/workserv.php"><{$smarty.const.MD_CARDEALER_WORKSERV}></a></li>
</ul>

<br>
