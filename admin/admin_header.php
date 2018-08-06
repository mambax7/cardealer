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

require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require dirname(dirname(dirname(__DIR__))) . '/class/xoopsformloader.php';

require dirname(__DIR__) . '/include/common.php';

include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));

/** @var Cardealer\Helper $helper */
$helper = Cardealer\Helper::getInstance();
/** @var Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

$db = \XoopsDatabaseFactory::getDatabaseConnection();

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

/** @var \XoopsPersistableObjectHandler $customerHandler */
$customerHandler = new Cardealer\CustomerHandler($db);
/** @var \XoopsPersistableObjectHandler $partHandler */
$partHandler = new Cardealer\PartHandler($db);
/** @var \XoopsPersistableObjectHandler $serviceHandler */
$serviceHandler = new Cardealer\ServiceHandler($db);
/** @var \XoopsPersistableObjectHandler $servpartHandler */
$servpartHandler = new Cardealer\ServpartHandler($db);
/** @var \XoopsPersistableObjectHandler $vehicleHandler */
$vehicleHandler = new Cardealer\VehicleHandler($db);
/** @var \XoopsPersistableObjectHandler $workorderHandler */
$workorderHandler = new Cardealer\WorkorderHandler($db);
/** @var \XoopsPersistableObjectHandler $workservHandler */
$workservHandler = new Cardealer\WorkservHandler($db);

$myts = \MyTextSanitizer::getInstance();
if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');

//xoops_cp_header();
