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

require dirname(dirname(__DIR__)) . '/mainfile.php';
$com_itemid = Request::getInt('com_itemid', 0);
if ($com_itemid > 0) {
    /** @var \XoopsPersistableObjectHandler $workservHandler */
    $workservHandler = new Cardealer\WorkservHandler($db);

    $workserv       = $workservHandler->get($com_itemid);
    $com_replytitle = $workserv->getVar('id');
    include XOOPS_ROOT_PATH . '/include/comment_new.php';
}
