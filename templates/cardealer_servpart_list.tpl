<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Servpart</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CARDEALER_SERVPART_ID}></th>
            <th><{$smarty.const.MD_CARDEALER_SERVPART_PARTNUM}></th>
            <th><{$smarty.const.MD_CARDEALER_SERVPART_ITEMNUM}></th>
            <th><{$smarty.const.MD_CARDEALER_SERVPART_QUANTITY}></th>
            <th><{$smarty.const.MD_CARDEALER_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=servpart from=$servpart}>
            <tbody>
            <tr>

                <td><{$servpart.id}></td>
                <td><{$servpart.partnum}></td>
                <td><{$servpart.itemnum}></td>
                <td><{$servpart.quantity}></td>
                <td>
                    <a href="servpart.php?op=view&id=<{$servpart.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/servpart.php?op=edit&id=<{$servpart.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/servpart.php?op=delete&id=<{$servpart.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
