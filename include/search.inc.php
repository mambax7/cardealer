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
/**
 *  cardealer_search
 *
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return array|bool
 */
function cardealer_search($queryarray, $andor, $limit, $offset, $userid)
{
    $sql = 'SELECT custnum, custname FROM ' . $GLOBALS['xoopsDB']->prefix('cardealer_customer') . ' WHERE _online = 1';

    if (0 !== $userid) {
        $sql .= ' AND _submitter=' . (int)$userid;
    }

    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= ' AND (()';

        for ($i = 1; $i < $count; ++$i) {
            $sql .= " $andor ";
            $sql .= '()';
        }
        $sql .= ')';
    }

    $sql    .= ' ORDER BY custnum DESC';
    $result = $GLOBALS['xoopsDB']->query($sql, $limit, $offset);
    $ret    = [];
    $i      = 0;
    while (false !== ($myrow = $GLOBALS['xoopsDB']->fetchArray($result))) {
        $ret[$i]['image'] = 'assets/images/icons/32/_search.png';
        $ret[$i]['link']  = 'customer.php?custnum=' . $myrow['custnum'];
        $ret[$i]['title'] = $myrow['custname'];
        ++$i;
    }

    return $ret;
}
