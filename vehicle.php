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

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_vehicle_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $vehicleHandler */
$vehicleHandler = new Cardealer\VehicleHandler($db);

$vehiclePaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($vehiclePaginationLimit);
$criteria->setStart($start);

$vehicleCount = $vehicleHandler->getCount($criteria);
$vehicleArray = $vehicleHandler->getAll($criteria);

$op = Request::getCmd('op', '');
$id = Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_vehicle.tpl';
        $vehiclePaginationLimit                  = 1;
        $myid                                    = $id;
        //id
        $vehicleObject = $vehicleHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($vehiclePaginationLimit);
        $criteria->setStart($start);
        $vehicle['id'] = $vehicleObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $customerHandler */
        $customerHandler = new Cardealer\CustomerHandler($db);

        $vehicle['custnum']   = $customerHandler->get($vehicleObject->getVar('custnum'))->getVar('custname');
        $vehicle['make']      = $vehicleObject->getVar('make');
        $vehicle['model']     = $vehicleObject->getVar('model');
        $vehicle['year']      = $vehicleObject->getVar('year');
        $vehicle['pictures']  = $vehicleObject->getVar('pictures');
        $vehicle['serialnum'] = $vehicleObject->getVar('serialnum');

        //       $GLOBALS['xoopsTpl']->append('vehicle', $vehicle);
        $keywords[] = $vehicleObject->getVar('serialnum');

        $GLOBALS['xoopsTpl']->assign('vehicle', $vehicle);
        $start = $id;

        // Display Navigation
        if ($vehicleCount > $vehiclePaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/vehicle.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($vehicleCount, $vehiclePaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_vehicle_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($vehicleCount > 0) {
            foreach (array_keys($vehicleArray) as $i) {
                $vehicle['id'] = $vehicleArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $customerHandler */
                $customerHandler = new Cardealer\CustomerHandler($db);

                $vehicle['custnum']   = $customerHandler->get($vehicleArray[$i]->getVar('custnum'))->getVar('custname');
                $vehicle['make']      = $vehicleArray[$i]->getVar('make');
                $vehicle['model']     = $vehicleArray[$i]->getVar('model');
                $vehicle['year']      = $vehicleArray[$i]->getVar('year');
                $vehicle['pictures']  = $vehicleArray[$i]->getVar('pictures');
                $vehicle['serialnum'] = $vehicleArray[$i]->getVar('serialnum');
                $GLOBALS['xoopsTpl']->append('vehicle', $vehicle);
                $keywords[] = $vehicleArray[$i]->getVar('serialnum');
                unset($vehicle);
            }
            // Display Navigation
            if ($vehicleCount > $vehiclePaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/vehicle.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($vehicleCount, $vehiclePaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_VEHICLE_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/vehicle.php');
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
