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
        $adminObject->addItemButton(AM_CARDEALER_SERVPART_LIST, 'servpart.php', 'list');
        $adminObject->displayButton('left');

        $servpartObject = $servpartHandler->create();
        $form           = $servpartObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('servpart.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('id', 0)) {
            $servpartObject = $servpartHandler->get(Request::getInt('id', 0));
        } else {
            $servpartObject = $servpartHandler->create();
        }
        // Form save fields
        $servpartObject->setVar('partnum', Request::getVar('partnum', ''));
        $servpartObject->setVar('itemnum', Request::getVar('itemnum', ''));
        $servpartObject->setVar('quantity', Request::getVar('quantity', ''));
        if ($servpartHandler->insert($servpartObject)) {
            redirect_header('servpart.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $servpartObject->getHtmlErrors();
        $form = $servpartObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_SERVPART, 'servpart.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_SERVPART_LIST, 'servpart.php', 'list');
        $adminObject->displayButton('left');
        $servpartObject = $servpartHandler->get(Request::getString('id', ''));
        $form           = $servpartObject->getForm();
        $form->display();
        break;

    case 'delete':
        $servpartObject = $servpartHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('servpart.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($servpartHandler->delete($servpartObject)) {
                redirect_header('servpart.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $servpartObject->getHtmlErrors();
            }
        } else {
            xoops_confirm([
                              'ok' => 1,
                              'id' => Request::getString('id', ''),
                              'op' => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $servpartObject->getVar('id')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('cardealer_servpart', 'id', $id_field)) {
            redirect_header('servpart.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('servpart.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_SERVPART, 'servpart.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                   = Request::getInt('start', 0);
        $servpartPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, id');
        $criteria->setOrder('ASC');
        $criteria->setLimit($servpartPaginationLimit);
        $criteria->setStart($start);
        $servpartTempRows  = $servpartHandler->getCount();
        $servpartTempArray = $servpartHandler->getAll($criteria);

        // Display Page Navigation
        if ($servpartTempRows > $servpartPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($servpartTempRows, $servpartPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('servpartRows', $servpartTempRows);
        $servpartArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($servpartPaginationLimit);
        $criteria->setStart($start);

        $servpartCount     = $servpartHandler->getCount($criteria);
        $servpartTempArray = $servpartHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($servpartCount > 0) {
            foreach (array_keys($servpartTempArray) as $i) {

                $selectorid = $utility::selectSorting(AM_CARDEALER_SERVPART_ID, 'id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $servpartArray['id'] = $servpartTempArray[$i]->getVar('id');

                $selectorpartnum = $utility::selectSorting(AM_CARDEALER_SERVPART_PARTNUM, 'partnum');
                $GLOBALS['xoopsTpl']->assign('selectorpartnum', $selectorpartnum);
                $servpartArray['partnum'] = $partHandler->get($servpartTempArray[$i]->getVar('partnum'))->getVar('title');

                $selectoritemnum = $utility::selectSorting(AM_CARDEALER_SERVPART_ITEMNUM, 'itemnum');
                $GLOBALS['xoopsTpl']->assign('selectoritemnum', $selectoritemnum);
                $servpartArray['itemnum'] = $serviceHandler->get($servpartTempArray[$i]->getVar('itemnum'))->getVar('title');

                $selectorquantity = $utility::selectSorting(AM_CARDEALER_SERVPART_QUANTITY, 'quantity');
                $GLOBALS['xoopsTpl']->assign('selectorquantity', $selectorquantity);
                $servpartArray['quantity']    = $servpartTempArray[$i]->getVar('quantity');
                $servpartArray['edit_delete'] = "<a href='servpart.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='servpart.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='servpart.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('servpartArrays', $servpartArray);
                unset($servpartArray);
            }
            unset($servpartTempArray);
            // Display Navigation
            if ($servpartCount > $servpartPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($servpartCount, $servpartPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_servpart.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
