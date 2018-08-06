<{if $customerRows > 0}>
    <div class="outer">
        <form name="select" action="customer.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('customerId[]');} else if (isOneChecked('customerId[]')) {return true;} else {alert('<{$smarty.const.AM_CUSTOMER_SELECTED_ERROR}>'); return false;}">
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


            <table class="$customer" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorcustnum}></th>
                    <th class="center"><{$selectorcustname}></th>
                    <th class="center"><{$selectorcustaddr}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <{foreach item=customerArray from=$customerArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="customer_id[]" title="customer_id[]" id="customer_id[]" value="<{$customerArray.customer_id}>"/></td>
                        <td class='center'><{$customerArray.custnum}></td>
                        <td class='center'><{$customerArray.custname}></td>
                        <td class='center'><{$customerArray.custaddr}></td>


                        <td class="center width5"><{$customerArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorcustnum}></th>
                    <th class="center"><{$selectorcustname}></th>
                    <th class="center"><{$selectorcustaddr}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $customer</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
