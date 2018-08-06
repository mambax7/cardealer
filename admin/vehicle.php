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

use Xmf\Module\Helper\Permission;
use Xmf\Request;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op    = Request::getString('op', 'list');
$order = Request::getString('order', 'desc');
$sort  = Request::getString('sort', '');

$adminObject->displayNavigation(basename(__FILE__));
/** @var Permission $permHelper */
$permHelper = new \Xmf\Module\Helper\Permission();
$uploadDir  = XOOPS_UPLOAD_PATH . '/cardealer/images/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/cardealer/images/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CARDEALER_VEHICLE_LIST, 'vehicle.php', 'list');
        $adminObject->displayButton('left');

        $vehicleObject = $vehicleHandler->create();
        $form          = $vehicleObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('vehicle.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('id', 0)) {
            $vehicleObject = $vehicleHandler->get(Request::getInt('id', 0));
        } else {
            $vehicleObject = $vehicleHandler->create();
        }
        // Form save fields
        $vehicleObject->setVar('custnum', Request::getVar('custnum', ''));
        $vehicleObject->setVar('make', Request::getVar('make', ''));
        $vehicleObject->setVar('model', Request::getVar('model', ''));
        $vehicleObject->setVar('year', Request::getVar('year', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/cardealer/images/';
        $uploader  = new \XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'cardealer'), xoops_getModuleOption('maxsize', 'cardealer'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

            $uploader->setPrefix('pictures_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $vehicleObject->setVar('pictures', $uploader->getSavedFileName());
            }
        } else {
            $vehicleObject->setVar('pictures', Request::getVar('pictures', ''));
        }

        $vehicleObject->setVar('serialnum', Request::getVar('serialnum', ''));
        if ($vehicleHandler->insert($vehicleObject)) {
            redirect_header('vehicle.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $vehicleObject->getHtmlErrors();
        $form = $vehicleObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_VEHICLE, 'vehicle.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_VEHICLE_LIST, 'vehicle.php', 'list');
        $adminObject->displayButton('left');
        $vehicleObject = $vehicleHandler->get(Request::getString('id', ''));
        $form          = $vehicleObject->getForm();
        $form->display();
        break;

    case 'delete':
        $vehicleObject = $vehicleHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('vehicle.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($vehicleHandler->delete($vehicleObject)) {
                redirect_header('vehicle.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $vehicleObject->getHtmlErrors();
            }
        } else {
            xoops_confirm([
                              'ok' => 1,
                              'id' => Request::getString('id', ''),
                              'op' => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $vehicleObject->getVar('serialnum')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('cardealer_vehicle', 'id', $id_field)) {
            redirect_header('vehicle.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('vehicle.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_VEHICLE, 'vehicle.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                  = Request::getInt('start', 0);
        $vehiclePaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, serialnum');
        $criteria->setOrder('ASC');
        $criteria->setLimit($vehiclePaginationLimit);
        $criteria->setStart($start);
        $vehicleTempRows  = $vehicleHandler->getCount();
        $vehicleTempArray = $vehicleHandler->getAll($criteria);

        // Display Page Navigation
        if ($vehicleTempRows > $vehiclePaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($vehicleTempRows, $vehiclePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('vehicleRows', $vehicleTempRows);
        $vehicleArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($vehiclePaginationLimit);
        $criteria->setStart($start);

        $vehicleCount     = $vehicleHandler->getCount($criteria);
        $vehicleTempArray = $vehicleHandler->getAll($criteria);

        if ($vehicleCount > 0) {
            foreach (array_keys($vehicleTempArray) as $i) {

                $selectorid = $utility::selectSorting(AM_CARDEALER_VEHICLE_ID, 'id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $vehicleArray['id'] = $vehicleTempArray[$i]->getVar('id');

                $selectorcustnum = $utility::selectSorting(AM_CARDEALER_VEHICLE_CUSTNUM, 'custnum');
                $GLOBALS['xoopsTpl']->assign('selectorcustnum', $selectorcustnum);
                $vehicleArray['custnum'] = $customerHandler->get($vehicleTempArray[$i]->getVar('custnum'))->getVar('custname');

                $selectormake = $utility::selectSorting(AM_CARDEALER_VEHICLE_MAKE, 'make');
                $GLOBALS['xoopsTpl']->assign('selectormake', $selectormake);
                $vehicleArray['make'] = $vehicleTempArray[$i]->getVar('make');

                $selectormodel = $utility::selectSorting(AM_CARDEALER_VEHICLE_MODEL, 'model');
                $GLOBALS['xoopsTpl']->assign('selectormodel', $selectormodel);
                $vehicleArray['model'] = $vehicleTempArray[$i]->getVar('model');

                $selectoryear = $utility::selectSorting(AM_CARDEALER_VEHICLE_YEAR, 'year');
                $GLOBALS['xoopsTpl']->assign('selectoryear', $selectoryear);
                $vehicleArray['year'] = $vehicleTempArray[$i]->getVar('year');

                $selectorpictures = $utility::selectSorting(AM_CARDEALER_VEHICLE_PICTURES, 'pictures');
                $GLOBALS['xoopsTpl']->assign('selectorpictures', $selectorpictures);
                $vehicleArray['pictures'] = "<img src='" . $uploadUrl . $vehicleTempArray[$i]->getVar('pictures') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";

                $selectorserialnum = $utility::selectSorting(AM_CARDEALER_VEHICLE_SERIALNUM, 'serialnum');
                $GLOBALS['xoopsTpl']->assign('selectorserialnum', $selectorserialnum);
                $vehicleArray['serialnum']   = $vehicleTempArray[$i]->getVar('serialnum');
                $vehicleArray['edit_delete'] = "<a href='vehicle.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='vehicle.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='vehicle.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('vehicleArrays', $vehicleArray);
                unset($vehicleArray);
            }
            unset($vehicleTempArray);
            // Display Navigation
            if ($vehicleCount > $vehiclePaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($vehicleCount, $vehiclePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_vehicle.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
