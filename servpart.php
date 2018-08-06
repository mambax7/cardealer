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

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_servpart_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $servpartHandler */
$servpartHandler = new Cardealer\ServpartHandler($db);

$servpartPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($servpartPaginationLimit);
$criteria->setStart($start);

$servpartCount = $servpartHandler->getCount($criteria);
$servpartArray = $servpartHandler->getAll($criteria);

$op = Request::getCmd('op', '');
$id = Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_servpart.tpl';
        $servpartPaginationLimit                 = 1;
        $myid                                    = $id;
        //id
        $servpartObject = $servpartHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($servpartPaginationLimit);
        $criteria->setStart($start);
        $servpart['id'] = $servpartObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $partHandler */
        $partHandler = new Cardealer\PartHandler($db);

        $servpart['partnum'] = $partHandler->get($servpartObject->getVar('partnum'))->getVar('title');
        /** @var \XoopsPersistableObjectHandler $serviceHandler */
        $serviceHandler = new Cardealer\ServiceHandler($db);

        $servpart['itemnum']  = $serviceHandler->get($servpartObject->getVar('itemnum'))->getVar('title');
        $servpart['quantity'] = $servpartObject->getVar('quantity');

        //       $GLOBALS['xoopsTpl']->append('servpart', $servpart);
        $keywords[] = $servpartObject->getVar('id');

        $GLOBALS['xoopsTpl']->assign('servpart', $servpart);
        $start = $id;

        // Display Navigation
        if ($servpartCount > $servpartPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/servpart.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($servpartCount, $servpartPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_servpart_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($servpartCount > 0) {
            foreach (array_keys($servpartArray) as $i) {
                $servpart['id'] = $servpartArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $partHandler */
                $partHandler = new Cardealer\PartHandler($db);

                $servpart['partnum'] = $partHandler->get($servpartArray[$i]->getVar('partnum'))->getVar('title');
                /** @var \XoopsPersistableObjectHandler $serviceHandler */
                $serviceHandler = new Cardealer\ServiceHandler($db);

                $servpart['itemnum']  = $serviceHandler->get($servpartArray[$i]->getVar('itemnum'))->getVar('title');
                $servpart['quantity'] = $servpartArray[$i]->getVar('quantity');
                $GLOBALS['xoopsTpl']->append('servpart', $servpart);
                $keywords[] = $servpartArray[$i]->getVar('id');
                unset($servpart);
            }
            // Display Navigation
            if ($servpartCount > $servpartPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/servpart.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($servpartCount, $servpartPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_SERVPART_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/servpart.php');
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
