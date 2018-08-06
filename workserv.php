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

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_workserv_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $workservHandler */
$workservHandler = new Cardealer\WorkservHandler($db);

$workservPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($workservPaginationLimit);
$criteria->setStart($start);

$workservCount = $workservHandler->getCount($criteria);
$workservArray = $workservHandler->getAll($criteria);

$op = Request::getCmd('op', '');
$id = Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_workserv.tpl';
        $workservPaginationLimit                 = 1;
        $myid                                    = $id;
        //id
        $workservObject = $workservHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($workservPaginationLimit);
        $criteria->setStart($start);
        $workserv['id'] = $workservObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $workorderHandler */
        $workorderHandler = new Cardealer\WorkorderHandler($db);

        $workserv['ordernum'] = $workorderHandler->get($workservObject->getVar('ordernum'))->getVar('custnum');
        /** @var \XoopsPersistableObjectHandler $serviceHandler */
        $serviceHandler = new Cardealer\ServiceHandler($db);

        $workserv['itemnum'] = $serviceHandler->get($workservObject->getVar('itemnum'))->getVar('title');

        //       $GLOBALS['xoopsTpl']->append('workserv', $workserv);
        $keywords[] = $workservObject->getVar('id');

        $GLOBALS['xoopsTpl']->assign('workserv', $workserv);
        $start = $id;

        // Display Navigation
        if ($workservCount > $workservPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/workserv.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($workservCount, $workservPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_workserv_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($workservCount > 0) {
            foreach (array_keys($workservArray) as $i) {
                $workserv['id'] = $workservArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $workorderHandler */
                $workorderHandler = new Cardealer\WorkorderHandler($db);

                $workserv['ordernum'] = $workorderHandler->get($workservArray[$i]->getVar('ordernum'))->getVar('custnum');
                /** @var \XoopsPersistableObjectHandler $serviceHandler */
                $serviceHandler = new Cardealer\ServiceHandler($db);

                $workserv['itemnum'] = $serviceHandler->get($workservArray[$i]->getVar('itemnum'))->getVar('title');
                $GLOBALS['xoopsTpl']->append('workserv', $workserv);
                $keywords[] = $workservArray[$i]->getVar('id');
                unset($workserv);
            }
            // Display Navigation
            if ($workservCount > $workservPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/workserv.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($workservCount, $workservPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_WORKSERV_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/workserv.php');
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
