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

/**
 * Prepares system prior to attempting to uninstall module
 * @param \XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to uninstall, false if not
 */
function xoops_module_pre_uninstall_cardealer(\XoopsModule $module)
{
    // Do some synchronization if needed
    return true;
}

/**
 *
 * Performs tasks required during uninstallation of the module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if uninstallation successful, false if not
 */
function xoops_module_uninstall_cardealer(\XoopsModule $module)
{
    include dirname(__DIR__) . '/preloads/autoloader.php';
    $moduleDirName      = basename(dirname(__DIR__));
    $moduleDirNameUpper = strtoupper($moduleDirName); //$capsDirName

    /** @var Cardealer\Helper $helper */
    /** @var Cardealer\Utility $utility */
    $helper  = Cardealer\Helper::getInstance();
    $utility = new Cardealer\Utility();

    // Load language files
    $helper->loadLanguage('admin');
    $helper->loadLanguage('common');
    $success = true;

    return $success;
}
