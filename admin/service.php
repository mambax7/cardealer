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
        $adminObject->addItemButton(AM_CARDEALER_SERVICE_LIST, 'service.php', 'list');
        $adminObject->displayButton('left');

        $serviceObject = $serviceHandler->create();
        $form          = $serviceObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('service.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('itemnum', 0)) {
            $serviceObject = $serviceHandler->get(Request::getInt('itemnum', 0));
        } else {
            $serviceObject = $serviceHandler->create();
        }
        // Form save fields
        $serviceObject->setVar('labor', Request::getVar('labor', ''));
        $serviceObject->setVar('title', Request::getVar('title', ''));
        $serviceObject->setVar('description', Request::getText('description', ''));
        if ($serviceHandler->insert($serviceObject)) {
            redirect_header('service.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $serviceObject->getHtmlErrors();
        $form = $serviceObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_SERVICE, 'service.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_SERVICE_LIST, 'service.php', 'list');
        $adminObject->displayButton('left');
        $serviceObject = $serviceHandler->get(Request::getString('itemnum', ''));
        $form          = $serviceObject->getForm();
        $form->display();
        break;

    case 'delete':
        $serviceObject = $serviceHandler->get(Request::getString('itemnum', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('service.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($serviceHandler->delete($serviceObject)) {
                redirect_header('service.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $serviceObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok'      => 1,
                           'itemnum' => Request::getString('itemnum', ''),
                           'op'      => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $serviceObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('itemnum', '');

        if ($utility::cloneRecord('cardealer_service', 'itemnum', $id_field)) {
            redirect_header('service.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('service.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_SERVICE, 'service.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                  = Request::getInt('start', 0);
        $servicePaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('itemnum ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($servicePaginationLimit);
        $criteria->setStart($start);
        $serviceTempRows  = $serviceHandler->getCount();
        $serviceTempArray = $serviceHandler->getAll($criteria);

        // Display Page Navigation
        if ($serviceTempRows > $servicePaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($serviceTempRows, $servicePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('serviceRows', $serviceTempRows);
        $serviceArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($servicePaginationLimit);
        $criteria->setStart($start);

        $serviceCount     = $serviceHandler->getCount($criteria);
        $serviceTempArray = $serviceHandler->getAll($criteria);

        if ($serviceCount > 0) {
            foreach (array_keys($serviceTempArray) as $i) {

                $selectoritemnum = $utility::selectSorting(AM_CARDEALER_SERVICE_ITEMNUM, 'itemnum');
                $GLOBALS['xoopsTpl']->assign('selectoritemnum', $selectoritemnum);
                $serviceArray['itemnum'] = $serviceTempArray[$i]->getVar('itemnum');

                $selectorlabor = $utility::selectSorting(AM_CARDEALER_SERVICE_LABOR, 'labor');
                $GLOBALS['xoopsTpl']->assign('selectorlabor', $selectorlabor);
                $serviceArray['labor'] = $serviceTempArray[$i]->getVar('labor');

                $selectortitle = $utility::selectSorting(AM_CARDEALER_SERVICE_TITLE, 'title');
                $GLOBALS['xoopsTpl']->assign('selectortitle', $selectortitle);
                $serviceArray['title'] = $serviceTempArray[$i]->getVar('title');

                $selectordescription = $utility::selectSorting(AM_CARDEALER_SERVICE_DESCRIPTION, 'description');
                $GLOBALS['xoopsTpl']->assign('selectordescription', $selectordescription);
                $serviceArray['description'] = $serviceTempArray[$i]->getVar('description');
                $serviceArray['edit_delete']
                                             = "<a href='service.php?op=edit&itemnum=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='service.php?op=delete&itemnum=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='service.php?op=clone&itemnum=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('serviceArrays', $serviceArray);
                unset($serviceArray);
            }
            unset($serviceTempArray);
            // Display Navigation
            if ($serviceCount > $servicePaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($serviceCount, $servicePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_service.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
