<{if $servpartRows > 0}>
    <div class="outer">
        <form name="select" action="servpart.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('servpartId[]');} else if (isOneChecked('servpartId[]')) {return true;} else {alert('<{$smarty.const.AM_SERVPART_SELECTED_ERROR}>'); return false;}">
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


            <table class="$servpart" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectorpartnum}></th>
                    <th class="center"><{$selectoritemnum}></th>
                    <th class="center"><{$selectorquantity}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <{foreach item=servpartArray from=$servpartArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="servpart_id[]" title="servpart_id[]" id="servpart_id[]" value="<{$servpartArray.servpart_id}>"/></td>
                        <td class='center'><{$servpartArray.id}></td>
                        <td class='center'><{$servpartArray.partnum}></td>
                        <td class='center'><{$servpartArray.itemnum}></td>
                        <td class='center'><{$servpartArray.quantity}></td>


                        <td class="center width5"><{$servpartArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectorpartnum}></th>
                    <th class="center"><{$selectoritemnum}></th>
                    <th class="center"><{$selectorquantity}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $servpart</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
