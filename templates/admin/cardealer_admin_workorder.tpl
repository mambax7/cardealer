<{if $workorderRows > 0}>
    <div class="outer">
        <form name="select" action="workorder.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('workorderId[]');} else if (isOneChecked('workorderId[]')) {return true;} else {alert('<{$smarty.const.AM_WORKORDER_SELECTED_ERROR}>'); return false;}">
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


            <table class="$workorder" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectorcustnum}></th>
                    <th class="center"><{$selectorcarnum}></th>
                    <th class="center"><{$selectorcost}></th>
                    <th class="center"><{$selectororderdate}></th>
                    <th class="center"><{$selectorstatus}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <{foreach item=workorderArray from=$workorderArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="workorder_id[]" title="workorder_id[]" id="workorder_id[]" value="<{$workorderArray.workorder_id}>"/></td>
                        <td class='center'><{$workorderArray.id}></td>
                        <td class='center'><{$workorderArray.custnum}></td>
                        <td class='center'><{$workorderArray.carnum}></td>
                        <td class='center'><{$workorderArray.cost}></td>
                        <td class='center'><{$workorderArray.orderdate}></td>
                        <td class='center'><{$workorderArray.status}></td>


                        <td class="center width5"><{$workorderArray.edit_delete}></td>
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
                    <th class="center"><{$selectorcustnum}></th>
                    <th class="center"><{$selectorcarnum}></th>
                    <th class="center"><{$selectorcost}></th>
                    <th class="center"><{$selectororderdate}></th>
                    <th class="center"><{$selectorstatus}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $workorder</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
