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
use XoopsModules\Cardealer\Common;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
//count "total Customer"
/** @var \XoopsPersistableObjectHandler $customerHandler */
$totalCustomer = $customerHandler->getCount();
//count "total Part"
/** @var \XoopsPersistableObjectHandler $partHandler */
$totalPart = $partHandler->getCount();
//count "total Service"
/** @var \XoopsPersistableObjectHandler $serviceHandler */
$totalService = $serviceHandler->getCount();
//count "total Servpart"
/** @var \XoopsPersistableObjectHandler $servpartHandler */
$totalServpart = $servpartHandler->getCount();
//count "total Vehicle"
/** @var \XoopsPersistableObjectHandler $vehicleHandler */
$totalVehicle = $vehicleHandler->getCount();
//count "total Workorder"
/** @var \XoopsPersistableObjectHandler $workorderHandler */
$totalWorkorder = $workorderHandler->getCount();
//count "total Workserv"
/** @var \XoopsPersistableObjectHandler $workservHandler */
$totalWorkserv = $workservHandler->getCount();
// InfoBox Statistics
$adminObject->addInfoBox(AM_CARDEALER_STATISTICS);

// InfoBox customer
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_CUSTOMER, $totalCustomer));

// InfoBox part
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_PARTS, $totalPart));

// InfoBox service
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_SERVICE, $totalService));

// InfoBox servpart
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_SERVICEPARTS, $totalServpart));

// InfoBox vehicle
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_VEHICLES, $totalVehicle));

// InfoBox workorder
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_WORKORDERS, $totalWorkorder));

// InfoBox workserv
$adminObject->addInfoBoxLine(sprintf(AM_CARDEALER_THEREARE_WORKSERVICE, $totalWorkserv));
// Render Index
$adminObject->displayNavigation(basename(__FILE__));

//------------- Test Data ----------------------------

if ($helper->getConfig('displaySampleButton')) {
    xoops_loadLanguage('admin/modulesadmin', 'system');
    require __DIR__ . '/../testdata/index.php';

    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');

    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');

    //    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');

    $adminObject->displayButton('left', '');
}

//------------- End Test Data ----------------------------

$adminObject->displayIndex();

echo $utility::getServerStats();

require __DIR__ . '/admin_footer.php';
