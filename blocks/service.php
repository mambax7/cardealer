<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: cardealer
 *
 * @category        Module
 * @package         cardealer
 * @author          XOOPS Development Team <mambax7@gmail.com> - <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 * @link            https://xoops.org/
 * @since           1.0.0
 */

use XoopsModules\Cardealer;

/**
 * @param $options
 *
 * @return array
 */
function showCardealerService($options)
{

    $block        = [];
    $blockType    = $options[0];
    $serviceCount = $options[1];
    //$titleLenght = $options[2];

    /** @var \XoopsPersistableObjectHandler $serviceHandler */
    $serviceHandler = new Cardealer\ServiceHandler($GLOBALS['xoopsDB']);
    $criteria       = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    if ($blockType) {
        $criteria->add(new \Criteria('itemnum', 0, '!='));
        $criteria->setSort('itemnum');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($serviceCount);
    $serviceArray = $serviceHandler->getAll($criteria);
    foreach (array_keys($serviceArray) as $i) {
    }

    return $block;
}

/**
 * @param $options
 *
 * @return string
 */
function editCardealerService($options)
{
    $form = MB_CARDEALER_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' type='text' />&nbsp;<br>";
    $form .= MB_CARDEALER_TITLELENGTH . " : <input name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' type='text' /><br><br>";

    /** @var \XoopsPersistableObjectHandler $serviceHandler */
    $serviceHandler = new Cardealer\ServiceHandler($GLOBALS['xoopsDB']);

    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new Criteria('itemnum', 0, '!='));
    $criteria->setSort('itemnum');
    $criteria->setOrder('ASC');
    $serviceArray = $serviceHandler->getAll($criteria);
    $form         .= MB_CARDEALER_CATTODISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form         .= "<option value='0' " . (false === in_array(0, $options) ? '' : "selected='selected'") . '>' . MB_CARDEALER_ALLCAT . '</option>';
    foreach (array_keys($serviceArray) as $i) {
        $itemnum = $serviceArray[$i]->getVar('itemnum');
        $form    .= "<option value='" . $itemnum . "' " . (false === in_array($itemnum, $options) ? '' : "selected='selected'") . '>' . $serviceArray[$i]->getVar('title') . '</option>';
    }
    $form .= '</select>';

    return $form;
}
