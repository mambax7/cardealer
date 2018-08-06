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

use XoopsModules\Cardealer;

include dirname(__DIR__) . '/preloads/autoloader.php';

$helper = Cardealer\Helper::getInstance();

// get path to icons
$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');
}

$adminObject = \Xmf\Module\Admin::getInstance();

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => "{$pathIcon32}/home.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU2,
    'link'  => 'admin/customer.php',
    'icon'  => "{$pathIcon32}/user-icon.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU3,
    'link'  => 'admin/part.php',
    'icon'  => "{$pathIcon32}/administration.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU4,
    'link'  => 'admin/service.php',
    'icon'  => "{$pathIcon32}/fileshare.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU5,
    'link'  => 'admin/servpart.php',
    'icon'  => "{$pathIcon32}/addlink.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU6,
    'link'  => 'admin/vehicle.php',
    'icon'  => "{$pathIcon32}/delivery.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU7,
    'link'  => 'admin/workorder.php',
    'icon'  => "{$pathIcon32}/cart_add.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU8,
    'link'  => 'admin/workserv.php',
    'icon'  => "{$pathIcon32}/exec.png"
];

$adminmenu[] = [
    'title' => MI_CARDEALER_ADMENU9,
    'link'  => 'admin/about.php',
    'icon'  => "{$pathIcon32}/about.png"
];
