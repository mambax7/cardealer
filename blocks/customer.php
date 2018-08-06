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
function showCardealerCustomer($options)
{

    $block         = [];
    $blockType     = $options[0];
    $customerCount = $options[1];

    /** @var \XoopsPersistableObjectHandler $customerHandler */
    $customerHandler = new Cardealer\CustomerHandler($GLOBALS['xoopsDB']);
    $criteria        = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    if ($blockType) {
        $criteria->add(new \Criteria('custnum', 0, '!='));
        $criteria->setSort('custnum');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($customerCount);
    $customerArray = $customerHandler->getAll($criteria);
    foreach (array_keys($customerArray) as $i) {
    }

    return $block;
}

/**
 * @param $options
 *
 * @return string
 */
function editCardealerCustomer($options)
{

    $form = MB_CARDEALER_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' type='text' />&nbsp;<br>";
    $form .= MB_CARDEALER_TITLELENGTH . " : <input name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' type='text' /><br><br>";

    /** @var \XoopsPersistableObjectHandler $customerHandler */
    $customerHandler = new Cardealer\CustomerHandler($GLOBALS['xoopsDB']);

    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new Criteria('custnum', 0, '!='));
    $criteria->setSort('custnum');
    $criteria->setOrder('ASC');
    $customerArray = $customerHandler->getAll($criteria);
    $form          .= MB_CARDEALER_CATTODISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form          .= "<option value='0' " . (false === in_array(0, $options) ? '' : "selected='selected'") . '>' . MB_CARDEALER_ALLCAT . '</option>';
    foreach (array_keys($customerArray) as $i) {
        $custnum = $customerArray[$i]->getVar('custnum');
        $form    .= "<option value='" . $custnum . "' " . (false === in_array($custnum, $options) ? '' : "selected='selected'") . '>' . $customerArray[$i]->getVar('custname') . '</option>';
    }
    $form .= '</select>';

    return $form;
}
