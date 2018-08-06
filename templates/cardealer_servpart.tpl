<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Servpart </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CARDEALER_SERVPART_ID}></td>
            <td><{$servpart.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_SERVPART_PARTNUM}></td>
            <td><{$servpart.partnum}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_SERVPART_ITEMNUM}></td>
            <td><{$servpart.itemnum}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_SERVPART_QUANTITY}></td>
            <td><{$servpart.quantity}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_ACTION}></td>
            <td>
                <!--<a href="servpart.php?op=view&id=<{$servpart.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="admin/servpart.php?op=edit&id=<{$servpart.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                    &nbsp;
                    <a href="admin/servpart.php?op=delete&id=<{$servpart.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
