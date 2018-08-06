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

use Xmf\Request;
use XoopsModules\Cardealer;

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_customer_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $customerHandler */
$customerHandler = new Cardealer\CustomerHandler($db);

$customerPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($customerPaginationLimit);
$criteria->setStart($start);

$customerCount = $customerHandler->getCount($criteria);
$customerArray = $customerHandler->getAll($criteria);

$op      = Request::getCmd('op', '');
$custnum = Request::getInt('custnum', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_customer.tpl';
        $customerPaginationLimit                 = 1;
        $myid                                    = $custnum;
        //custnum
        $customerObject = $customerHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('custnum');
        $criteria->setOrder('DESC');
        $criteria->setLimit($customerPaginationLimit);
        $criteria->setStart($start);
        $customer['custnum']  = $customerObject->getVar('custnum');
        $customer['custname'] = $customerObject->getVar('custname');
        $customer['custaddr'] = $customerObject->getVar('custaddr');

        //       $GLOBALS['xoopsTpl']->append('customer', $customer);
        $keywords[] = $customerObject->getVar('custname');

        $GLOBALS['xoopsTpl']->assign('customer', $customer);
        $start = $custnum;

        // Display Navigation
        if ($customerCount > $customerPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/customer.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($customerCount, $customerPaginationLimit, $start, 'op=view&custnum');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_customer_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($customerCount > 0) {
            foreach (array_keys($customerArray) as $i) {
                $customer['custnum']  = $customerArray[$i]->getVar('custnum');
                $customer['custname'] = $customerArray[$i]->getVar('custname');
                $customer['custaddr'] = $customerArray[$i]->getVar('custaddr');
                $GLOBALS['xoopsTpl']->append('customer', $customer);
                $keywords[] = $customerArray[$i]->getVar('custname');
                unset($customer);
            }
            // Display Navigation
            if ($customerCount > $customerPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/customer.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($customerCount, $customerPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_CUSTOMER_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/customer.php');
$GLOBALS['xoopsTpl']->assign('cardealer_url', CARDEALER_URL);
$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', $moduleDirName));
$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('admin', CARDEALER_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
//
require XOOPS_ROOT_PATH . '/footer.php';
