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

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_workorder_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $workorderHandler */
$workorderHandler = new Cardealer\WorkorderHandler($db);

$workorderPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($workorderPaginationLimit);
$criteria->setStart($start);

$workorderCount = $workorderHandler->getCount($criteria);
$workorderArray = $workorderHandler->getAll($criteria);

$op = Request::getCmd('op', '');
$id = Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_workorder.tpl';
        $workorderPaginationLimit                = 1;
        $myid                                    = $id;
        //id
        $workorderObject = $workorderHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($workorderPaginationLimit);
        $criteria->setStart($start);
        $workorder['id'] = $workorderObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $customerHandler */
        $customerHandler = new Cardealer\CustomerHandler($db);

        $workorder['custnum'] = $customerHandler->get($workorderObject->getVar('custnum'))->getVar('custname');
        /** @var \XoopsPersistableObjectHandler $vehicleHandler */
        $vehicleHandler = new Cardealer\VehicleHandler($db);

        $workorder['carnum']    = $vehicleHandler->get($workorderObject->getVar('carnum'))->getVar('serialnum');
        $workorder['cost']      = $workorderObject->getVar('cost');
        $workorder['orderdate'] = date(_SHORTDATESTRING, strtotime($workorderObject->getVar('orderdate')));
        $workorder['status']    = $workorderObject->getVar('status');

        //       $GLOBALS['xoopsTpl']->append('workorder', $workorder);
        $keywords[] = $workorderObject->getVar('custnum');

        $GLOBALS['xoopsTpl']->assign('workorder', $workorder);
        $start = $id;

        // Display Navigation
        if ($workorderCount > $workorderPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/workorder.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($workorderCount, $workorderPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_workorder_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($workorderCount > 0) {
            foreach (array_keys($workorderArray) as $i) {
                $workorder['id'] = $workorderArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $customerHandler */
                $customerHandler = new Cardealer\CustomerHandler($db);

                $workorder['custnum'] = $customerHandler->get($workorderArray[$i]->getVar('custnum'))->getVar('custname');
                /** @var \XoopsPersistableObjectHandler $vehicleHandler */
                $vehicleHandler = new Cardealer\VehicleHandler($db);

                $workorder['carnum']    = $vehicleHandler->get($workorderArray[$i]->getVar('carnum'))->getVar('serialnum');
                $workorder['cost']      = $workorderArray[$i]->getVar('cost');
                $workorder['orderdate'] = date(_SHORTDATESTRING, strtotime($workorderArray[$i]->getVar('orderdate')));
                $workorder['status']    = $workorderArray[$i]->getVar('status');
                $GLOBALS['xoopsTpl']->append('workorder', $workorder);
                $keywords[] = $workorderArray[$i]->getVar('custnum');
                unset($workorder);
            }
            // Display Navigation
            if ($workorderCount > $workorderPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/workorder.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($workorderCount, $workorderPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_WORKORDER_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/workorder.php');
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
