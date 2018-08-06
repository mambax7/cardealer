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

use Xmf\Module\Helper;
use XoopsModules\Cardealer;
use XoopsModules\Cardealer\Common;

require dirname(dirname(__DIR__)) . '/mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';

include __DIR__ . '/preloads/autoloader.php';
include __DIR__ . '/include/common.php';
$moduleDirName = basename(__DIR__);

$helper       = Cardealer\Helper::getInstance();
$utility      = new Cardealer\Utility();
$configurator = new Common\Configurator();
$copyright    = $configurator->modCopyright;

$modulePath = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;
require __DIR__ . '/include/common.php';
$db = \XoopsDatabaseFactory::getDatabaseConnection();

$myts       = \MyTextSanitizer::getInstance();
$stylesheet = "modules/{$moduleDirName}/assets/css/style.css";
if (file_exists($GLOBALS['xoops']->path($stylesheet))) {
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url("www/{$stylesheet}"));
}
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

// Load language files
$helper->loadLanguage('main');
$helper->loadLanguage('modinfo');
