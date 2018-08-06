<{include file="db:cardealer_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Part</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CARDEALER_PART_PARTNUM}></th>
            <th><{$smarty.const.MD_CARDEALER_PART_PRICE}></th>
            <th><{$smarty.const.MD_CARDEALER_PART_STOCK}></th>
            <th><{$smarty.const.MD_CARDEALER_PART_TITLE}></th>
            <th><{$smarty.const.MD_CARDEALER_PART_DESCRIPTION}></th>
            <th><{$smarty.const.MD_CARDEALER_PART_PICTURE}></th>
            <th><{$smarty.const.MD_CARDEALER_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=part from=$part}>
            <tbody>
            <tr>

                <td><{$part.partnum}></td>
                <td><{$part.price}></td>
                <td><{$part.stock}></td>
                <td><{$part.title}></td>
                <td><{$part.description}></td>
                <td><img src="<{$xoops_url}>/uploads/cardealer/thumbs/<{$part.picture}>" style="max-width:100px" alt="part"></td>
                <td>
                    <a href="part.php?op=view&partnum=<{$part.partnum}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/part.php?op=edit&partnum=<{$part.partnum}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/part.php?op=delete&partnum=<{$part.partnum}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
