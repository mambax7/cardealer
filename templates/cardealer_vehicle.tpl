<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Vehicle </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CARDEALER_VEHICLE_ID}></td>
            <td><{$vehicle.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_VEHICLE_CUSTNUM}></td>
            <td><{$vehicle.custnum}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_VEHICLE_MAKE}></td>
            <td><{$vehicle.make}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_VEHICLE_MODEL}></td>
            <td><{$vehicle.model}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_VEHICLE_YEAR}></td>
            <td><{$vehicle.year}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_VEHICLE_PICTURES}></td>
            <td><img src="<{$xoops_url}>/uploads/cardealer/images/<{$vehicle.pictures}>" alt="vehicle"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_VEHICLE_SERIALNUM}></td>
            <td><{$vehicle.serialnum}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_ACTION}></td>
            <td>
                <!--<a href="vehicle.php?op=view&id=<{$vehicle.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="admin/vehicle.php?op=edit&id=<{$vehicle.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                    &nbsp;
                    <a href="admin/vehicle.php?op=delete&id=<{$vehicle.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                <{/if}>
            </td>
        </tr>
        </tbody>

    </table>
</div>
<div id="pagenav"><{$pagenav}></div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:cardealer_footer.tpl"}>
