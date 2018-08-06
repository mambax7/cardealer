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
        $adminObject->addItemButton(AM_CARDEALER_CUSTOMER_LIST, 'customer.php', 'list');
        $adminObject->displayButton('left');

        $customerObject = $customerHandler->create();
        $form           = $customerObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('customer.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('custnum', 0)) {
            $customerObject = $customerHandler->get(Request::getInt('custnum', 0));
        } else {
            $customerObject = $customerHandler->create();
        }
        // Form save fields
        $customerObject->setVar('custname', Request::getVar('custname', ''));
        $customerObject->setVar('custaddr', Request::getText('custaddr', ''));
        if ($customerHandler->insert($customerObject)) {
            redirect_header('customer.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $customerObject->getHtmlErrors();
        $form = $customerObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_CUSTOMER, 'customer.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_CUSTOMER_LIST, 'customer.php', 'list');
        $adminObject->displayButton('left');
        $customerObject = $customerHandler->get(Request::getString('custnum', ''));
        $form           = $customerObject->getForm();
        $form->display();
        break;

    case 'delete':
        $customerObject = $customerHandler->get(Request::getString('custnum', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('customer.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($customerHandler->delete($customerObject)) {
                redirect_header('customer.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $customerObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok'      => 1,
                           'custnum' => Request::getString('custnum', ''),
                           'op'      => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $customerObject->getVar('custname')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('custnum', '');

        if ($utility::cloneRecord('cardealer_customer', 'custnum', $id_field)) {
            redirect_header('customer.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('customer.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_CUSTOMER, 'customer.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                   = Request::getInt('start', 0);
        $customerPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('custnum ASC, custname');
        $criteria->setOrder('ASC');
        $criteria->setLimit($customerPaginationLimit);
        $criteria->setStart($start);
        $customerTempRows  = $customerHandler->getCount();
        $customerTempArray = $customerHandler->getAll($criteria);

        // Display Page Navigation
        if ($customerTempRows > $customerPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($customerTempRows, $customerPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('customerRows', $customerTempRows);
        $customerArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($customerPaginationLimit);
        $criteria->setStart($start);

        $customerCount     = $customerHandler->getCount($criteria);
        $customerTempArray = $customerHandler->getAll($criteria);

        if ($customerCount > 0) {
            foreach (array_keys($customerTempArray) as $i) {
                $selectorcustnum = $utility::selectSorting(AM_CARDEALER_CUSTOMER_CUSTNUM, 'custnum');
                $GLOBALS['xoopsTpl']->assign('selectorcustnum', $selectorcustnum);
                $customerArray['custnum'] = $customerTempArray[$i]->getVar('custnum');

                $selectorcustname = $utility::selectSorting(AM_CARDEALER_CUSTOMER_CUSTNAME, 'custname');
                $GLOBALS['xoopsTpl']->assign('selectorcustname', $selectorcustname);
                $customerArray['custname'] = $customerTempArray[$i]->getVar('custname');

                $selectorcustaddr = $utility::selectSorting(AM_CARDEALER_CUSTOMER_CUSTADDR, 'custaddr');
                $GLOBALS['xoopsTpl']->assign('selectorcustaddr', $selectorcustaddr);
                $customerArray['custaddr'] = $customerTempArray[$i]->getVar('custaddr');
                $customerArray['edit_delete']
                                           = "<a href='customer.php?op=edit&custnum=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='customer.php?op=delete&custnum=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='customer.php?op=clone&custnum=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('customerArrays', $customerArray);
                unset($customerArray);
            }
            unset($customerTempArray);
            // Display Navigation
            if ($customerCount > $customerPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($customerCount, $customerPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_customer.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
