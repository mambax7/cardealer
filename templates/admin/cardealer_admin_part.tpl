<{if $partRows > 0}>
    <div class="outer">
        <form name="select" action="part.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('partId[]');} else if (isOneChecked('partId[]')) {return true;} else {alert('<{$smarty.const.AM_PART_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1"/>
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const.AM_CARDEALER_SELECT}></option>
                    <option value="delete"><{$smarty.const.AM_CARDEALER_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>"/>
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>


            <table class="$part" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorpartnum}></th>
                    <th class="center"><{$selectorprice}></th>
                    <th class="center"><{$selectorstock}></th>
                    <th class="center"><{$selectortitle}></th>
                    <th class="center"><{$selectordescription}></th>
                    <th class="center"><{$selectorpicture}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <{foreach item=partArray from=$partArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="part_id[]" title="part_id[]" id="part_id[]" value="<{$partArray.part_id}>"/></td>
                        <td class='center'><{$partArray.partnum}></td>
                        <td class='center'><{$partArray.price}></td>
                        <td class='center'><{$partArray.stock}></td>
                        <td class='center'><{$partArray.title}></td>
                        <td class='center'><{$partArray.description}></td>
                        <td class='center'><{$partArray.picture}></td>


                        <td class="center width5"><{$partArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorpartnum}></th>
                    <th class="center"><{$selectorprice}></th>
                    <th class="center"><{$selectorstock}></th>
                    <th class="center"><{$selectortitle}></th>
                    <th class="center"><{$selectordescription}></th>
                    <th class="center"><{$selectorpicture}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $part</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
