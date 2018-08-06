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
        $adminObject->addItemButton(AM_CARDEALER_WORKSERV_LIST, 'workserv.php', 'list');
        $adminObject->displayButton('left');

        $workservObject = $workservHandler->create();
        $form           = $workservObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('workserv.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('id', 0)) {
            $workservObject = $workservHandler->get(Request::getInt('id', 0));
        } else {
            $workservObject = $workservHandler->create();
        }
        // Form save fields
        $workservObject->setVar('ordernum', Request::getVar('ordernum', ''));
        $workservObject->setVar('itemnum', Request::getVar('itemnum', ''));
        if ($workservHandler->insert($workservObject)) {
            redirect_header('workserv.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $workservObject->getHtmlErrors();
        $form = $workservObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_WORKSERV, 'workserv.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_WORKSERV_LIST, 'workserv.php', 'list');
        $adminObject->displayButton('left');
        $workservObject = $workservHandler->get(Request::getString('id', ''));
        $form           = $workservObject->getForm();
        $form->display();
        break;

    case 'delete':
        $workservObject = $workservHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('workserv.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($workservHandler->delete($workservObject)) {
                redirect_header('workserv.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $workservObject->getHtmlErrors();
            }
        } else {
            xoops_confirm([
                              'ok' => 1,
                              'id' => Request::getString('id', ''),
                              'op' => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $workservObject->getVar('id')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('cardealer_workserv', 'id', $id_field)) {
            redirect_header('workserv.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('workserv.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_WORKSERV, 'workserv.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                   = Request::getInt('start', 0);
        $workservPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, id');
        $criteria->setOrder('ASC');
        $criteria->setLimit($workservPaginationLimit);
        $criteria->setStart($start);
        $workservTempRows  = $workservHandler->getCount();
        $workservTempArray = $workservHandler->getAll($criteria);

        // Display Page Navigation
        if ($workservTempRows > $workservPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($workservTempRows, $workservPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('workservRows', $workservTempRows);
        $workservArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($workservPaginationLimit);
        $criteria->setStart($start);

        $workservCount     = $workservHandler->getCount($criteria);
        $workservTempArray = $workservHandler->getAll($criteria);

        if ($workservCount > 0) {
            foreach (array_keys($workservTempArray) as $i) {

                $selectorid = $utility::selectSorting(AM_CARDEALER_WORKSERV_ID, 'id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $workservArray['id'] = $workservTempArray[$i]->getVar('id');

                $selectorordernum = $utility::selectSorting(AM_CARDEALER_WORKSERV_ORDERNUM, 'ordernum');
                $GLOBALS['xoopsTpl']->assign('selectorordernum', $selectorordernum);
                $workservArray['ordernum'] = $workorderHandler->get($workservTempArray[$i]->getVar('ordernum'))->getVar('custnum');

                $selectoritemnum = $utility::selectSorting(AM_CARDEALER_WORKSERV_ITEMNUM, 'itemnum');
                $GLOBALS['xoopsTpl']->assign('selectoritemnum', $selectoritemnum);
                $workservArray['itemnum']     = $serviceHandler->get($workservTempArray[$i]->getVar('itemnum'))->getVar('title');
                $workservArray['edit_delete'] = "<a href='workserv.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='workserv.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='workserv.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('workservArrays', $workservArray);
                unset($workservArray);
            }
            unset($workservTempArray);
            // Display Navigation
            if ($workservCount > $workservPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($workservCount, $workservPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_workserv.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
