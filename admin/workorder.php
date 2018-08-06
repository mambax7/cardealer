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

use Xmf\Module\Helper\Permission;
use Xmf\Request;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op    = Request::getString('op', 'list');
$order = Request::getString('order', 'desc');
$sort  = Request::getString('sort', '');

$adminObject->displayNavigation(basename(__FILE__));
/** @var Permission $permHelper */
$permHelper = new \Xmf\Module\Helper\Permission();
$uploadDir  = XOOPS_UPLOAD_PATH . '/cardealer/images/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/cardealer/images/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CARDEALER_WORKORDER_LIST, 'workorder.php', 'list');
        $adminObject->displayButton('left');

        $workorderObject = $workorderHandler->create();
        $form            = $workorderObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('workorder.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('id', 0)) {
            $workorderObject = $workorderHandler->get(Request::getInt('id', 0));
        } else {
            $workorderObject = $workorderHandler->create();
        }
        // Form save fields
        $workorderObject->setVar('custnum', Request::getVar('custnum', ''));
        $workorderObject->setVar('carnum', Request::getVar('carnum', ''));
        $workorderObject->setVar('cost', Request::getVar('cost', ''));
        $workorderObject->setVar('orderdate', $_REQUEST['orderdate']);
        $workorderObject->setVar('status', ((1 == Request::getInt('status', 0)) ? '1' : '0'));
        if ($workorderHandler->insert($workorderObject)) {
            redirect_header('workorder.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $workorderObject->getHtmlErrors();
        $form = $workorderObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_WORKORDER, 'workorder.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_WORKORDER_LIST, 'workorder.php', 'list');
        $adminObject->displayButton('left');
        $workorderObject = $workorderHandler->get(Request::getString('id', ''));
        $form            = $workorderObject->getForm();
        $form->display();
        break;

    case 'delete':
        $workorderObject = $workorderHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('workorder.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($workorderHandler->delete($workorderObject)) {
                redirect_header('workorder.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $workorderObject->getHtmlErrors();
            }
        } else {
            xoops_confirm([
                              'ok' => 1,
                              'id' => Request::getString('id', ''),
                              'op' => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $workorderObject->getVar('custnum')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('cardealer_workorder', 'id', $id_field)) {
            redirect_header('workorder.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('workorder.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_WORKORDER, 'workorder.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                    = Request::getInt('start', 0);
        $workorderPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, custnum');
        $criteria->setOrder('ASC');
        $criteria->setLimit($workorderPaginationLimit);
        $criteria->setStart($start);
        $workorderTempRows  = $workorderHandler->getCount();
        $workorderTempArray = $workorderHandler->getAll($criteria);

        // Display Page Navigation
        if ($workorderTempRows > $workorderPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($workorderTempRows, $workorderPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('workorderRows', $workorderTempRows);
        $workorderArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($workorderPaginationLimit);
        $criteria->setStart($start);

        $workorderCount     = $workorderHandler->getCount($criteria);
        $workorderTempArray = $workorderHandler->getAll($criteria);

        if ($workorderCount > 0) {
            foreach (array_keys($workorderTempArray) as $i) {

                $selectorid = $utility::selectSorting(AM_CARDEALER_WORKORDER_ID, 'id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $workorderArray['id'] = $workorderTempArray[$i]->getVar('id');

                $selectorcustnum = $utility::selectSorting(AM_CARDEALER_WORKORDER_CUSTNUM, 'custnum');
                $GLOBALS['xoopsTpl']->assign('selectorcustnum', $selectorcustnum);
                $workorderArray['custnum'] = $customerHandler->get($workorderTempArray[$i]->getVar('custnum'))->getVar('custname');

                $selectorcarnum = $utility::selectSorting(AM_CARDEALER_WORKORDER_CARNUM, 'carnum');
                $GLOBALS['xoopsTpl']->assign('selectorcarnum', $selectorcarnum);
                $workorderArray['carnum'] = $vehicleHandler->get($workorderTempArray[$i]->getVar('carnum'))->getVar('serialnum');

                $selectorcost = $utility::selectSorting(AM_CARDEALER_WORKORDER_COST, 'cost');
                $GLOBALS['xoopsTpl']->assign('selectorcost', $selectorcost);
                $workorderArray['cost'] = $workorderTempArray[$i]->getVar('cost');

                $selectororderdate = $utility::selectSorting(AM_CARDEALER_WORKORDER_ORDERDATE, 'orderdate');
                $GLOBALS['xoopsTpl']->assign('selectororderdate', $selectororderdate);
                $workorderArray['orderdate'] = date(_SHORTDATESTRING, strtotime($workorderTempArray[$i]->getVar('orderdate')));

                $selectorstatus = $utility::selectSorting(AM_CARDEALER_WORKORDER_STATUS, 'status');
                $GLOBALS['xoopsTpl']->assign('selectorstatus', $selectorstatus);
                $workorderArray['status']      = $workorderTempArray[$i]->getVar('status');
                $workorderArray['edit_delete'] = "<a href='workorder.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='workorder.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='workorder.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('workorderArrays', $workorderArray);
                unset($workorderArray);
            }
            unset($workorderTempArray);
            // Display Navigation
            if ($workorderCount > $workorderPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($workorderCount, $workorderPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_workorder.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
