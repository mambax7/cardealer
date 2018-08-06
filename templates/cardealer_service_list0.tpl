<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Service</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CARDEALER_SERVICE_ITEMNUM}></th>
            <th><{$smarty.const.MD_CARDEALER_SERVICE_LABOR}></th>
            <th><{$smarty.const.MD_CARDEALER_SERVICE_TITLE}></th>
            <th><{$smarty.const.MD_CARDEALER_SERVICE_DESCRIPTION}></th>
            <th><{$smarty.const.MD_CARDEALER_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=service from=$service}>
            <tbody>
            <tr>

                <td><{$service.itemnum}></td>
                <td><{$service.labor}></td>
                <td><{$service.title}></td>
                <td><{$service.description}></td>
                <td>
                    <a href="service.php?op=view&itemnum=<{$service.itemnum}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/service.php?op=edit&itemnum=<{$service.itemnum}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/service.php?op=delete&itemnum=<{$service.itemnum}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
