<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Vehicle</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_ID}></th>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_CUSTNUM}></th>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_MAKE}></th>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_MODEL}></th>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_YEAR}></th>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_PICTURES}></th>
            <th><{$smarty.const.MD_CARDEALER_VEHICLE_SERIALNUM}></th>
            <th><{$smarty.const.MD_CARDEALER_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=vehicle from=$vehicle}>
            <tbody>
            <tr>

                <td><{$vehicle.id}></td>
                <td><{$vehicle.custnum}></td>
                <td><{$vehicle.make}></td>
                <td><{$vehicle.model}></td>
                <td><{$vehicle.year}></td>
                <td><img src="<{$xoops_url}>/uploads/cardealer/thumbs/<{$vehicle.pictures}>" style="max-width:100px" alt="vehicle"></td>
                <td><{$vehicle.serialnum}></td>
                <td>
                    <a href="vehicle.php?op=view&id=<{$vehicle.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/vehicle.php?op=edit&id=<{$vehicle.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/vehicle.php?op=delete&id=<{$vehicle.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
            </tbody>
        <{/foreach}>
    </table>
</div>
<{$pagenav}>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:cardealer_footer.tpl"}>
