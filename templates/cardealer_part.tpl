<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Part </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CARDEALER_PART_PARTNUM}></td>
            <td><{$part.partnum}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_PART_PRICE}></td>
            <td><{$part.price}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_PART_STOCK}></td>
            <td><{$part.stock}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_PART_TITLE}></td>
            <td><{$part.title}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_PART_DESCRIPTION}></td>
            <td><{$part.description}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_PART_PICTURE}></td>
            <td><img src="<{$xoops_url}>/uploads/cardealer/images/<{$part.picture}>" alt="part"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CARDEALER_ACTION}></td>
            <td>
                <!--<a href="part.php?op=view&partnum=<{$part.partnum}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="admin/part.php?op=edit&partnum=<{$part.partnum}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                    &nbsp;
                    <a href="admin/part.php?op=delete&partnum=<{$part.partnum}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
