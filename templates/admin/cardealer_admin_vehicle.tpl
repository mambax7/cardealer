<{if $vehicleRows > 0}>
    <div class="outer">
        <form name="select" action="vehicle.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('vehicleId[]');} else if (isOneChecked('vehicleId[]')) {return true;} else {alert('<{$smarty.const.AM_VEHICLE_SELECTED_ERROR}>'); return false;}">
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


            <table class="$vehicle" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectorcustnum}></th>
                    <th class="center"><{$selectormake}></th>
                    <th class="center"><{$selectormodel}></th>
                    <th class="center"><{$selectoryear}></th>
                    <th class="center"><{$selectorpictures}></th>
                    <th class="center"><{$selectorserialnum}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <{foreach item=vehicleArray from=$vehicleArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="vehicle_id[]" title="vehicle_id[]" id="vehicle_id[]" value="<{$vehicleArray.vehicle_id}>"/></td>
                        <td class='center'><{$vehicleArray.id}></td>
                        <td class='center'><{$vehicleArray.custnum}></td>
                        <td class='center'><{$vehicleArray.make}></td>
                        <td class='center'><{$vehicleArray.model}></td>
                        <td class='center'><{$vehicleArray.year}></td>
                        <td class='center'><{$vehicleArray.pictures}></td>
                        <td class='center'><{$vehicleArray.serialnum}></td>


                        <td class="center width5"><{$vehicleArray.edit_delete}></td>
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
                    <th class="center"><{$selectormake}></th>
                    <th class="center"><{$selectormodel}></th>
                    <th class="center"><{$selectoryear}></th>
                    <th class="center"><{$selectorpictures}></th>
                    <th class="center"><{$selectorserialnum}></th>

                    <th class="center width5"><{$smarty.const.AM_CARDEALER_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $vehicle</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
