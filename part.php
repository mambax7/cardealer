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

$GLOBALS['xoopsOption']['template_main'] = 'cardealer_part_list0.tpl';
require __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $partHandler */
$partHandler = new Cardealer\PartHandler($db);

$partPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($partPaginationLimit);
$criteria->setStart($start);

$partCount = $partHandler->getCount($criteria);
$partArray = $partHandler->getAll($criteria);

$op      = Request::getCmd('op', '');
$partnum = Request::getInt('partnum', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_part.tpl';
        $partPaginationLimit                     = 1;
        $myid                                    = $partnum;
        //partnum
        $partObject = $partHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('partnum');
        $criteria->setOrder('DESC');
        $criteria->setLimit($partPaginationLimit);
        $criteria->setStart($start);
        $part['partnum']     = $partObject->getVar('partnum');
        $part['price']       = $partObject->getVar('price');
        $part['stock']       = $partObject->getVar('stock');
        $part['title']       = $partObject->getVar('title');
        $part['description'] = $partObject->getVar('description');
        $part['picture']     = $partObject->getVar('picture');

        //       $GLOBALS['xoopsTpl']->append('part', $part);
        $keywords[] = $partObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('part', $part);
        $start = $partnum;

        // Display Navigation
        if ($partCount > $partPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/part.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($partCount, $partPaginationLimit, $start, 'op=view&partnum');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'cardealer_part_list0.tpl';
        //    require __DIR__ . '/header.php';

        if ($partCount > 0) {
            foreach (array_keys($partArray) as $i) {
                $part['partnum']     = $partArray[$i]->getVar('partnum');
                $part['price']       = $partArray[$i]->getVar('price');
                $part['stock']       = $partArray[$i]->getVar('stock');
                $part['title']       = $partArray[$i]->getVar('title');
                $part['description'] = $partArray[$i]->getVar('description');
                $part['picture']     = $partArray[$i]->getVar('picture');
                $GLOBALS['xoopsTpl']->append('part', $part);
                $keywords[] = $partArray[$i]->getVar('title');
                unset($part);
            }
            // Display Navigation
            if ($partCount > $partPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/part.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($partCount, $partPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CARDEALER_PART_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CARDEALER_URL . '/part.php');
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
