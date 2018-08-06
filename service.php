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

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_service_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $serviceHandler */
$serviceHandler = new Cardealer\ServiceHandler($db);

$servicePaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($servicePaginationLimit);
$criteria->setStart($start);

$serviceCount = $serviceHandler->getCount($criteria);
$serviceArray = $serviceHandler->getAll($criteria);

$op      = Request::getCmd('op', '');
$itemnum = Request::getInt('itemnum', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_service.tpl';
        $servicePaginationLimit                  = 1;
        $myid                                    = $itemnum;
        //itemnum
        $serviceObject = $serviceHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('itemnum');
        $criteria->setOrder('DESC');
        $criteria->setLimit($servicePaginationLimit);
        $criteria->setStart($start);
        $service['itemnum']     = $serviceObject->getVar('itemnum');
        $service['labor']       = $serviceObject->getVar('labor');
        $service['title']       = $serviceObject->getVar('title');
        $service['description'] = $serviceObject->getVar('description');

        //       $GLOBALS['xoopsTpl']->append('service', $service);
        $keywords[] = $serviceObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('service', $service);
        $start = $itemnum;

        // Display Navigation
        if ($serviceCount > $servicePaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/service.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($serviceCount, $servicePaginationLimit, $start, 'op=view&itemnum');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_service_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($serviceCount > 0) {
            foreach (array_keys($serviceArray) as $i) {
                $service['itemnum']     = $serviceArray[$i]->getVar('itemnum');
                $service['labor']       = $serviceArray[$i]->getVar('labor');
                $service['title']       = $serviceArray[$i]->getVar('title');
                $service['description'] = $serviceArray[$i]->getVar('description');
                $GLOBALS['xoopsTpl']->append('service', $service);
                $keywords[] = $serviceArray[$i]->getVar('title');
                unset($service);
            }
            // Display Navigation
            if ($serviceCount > $servicePaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/service.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($serviceCount, $servicePaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_SERVICE_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/service.php');
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
