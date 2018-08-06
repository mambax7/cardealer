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
        $adminObject->addItemButton(AM_CARDEALER_PART_LIST, 'part.php', 'list');
        $adminObject->displayButton('left');

        $partObject = $partHandler->create();
        $form       = $partObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('part.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('partnum', 0)) {
            $partObject = $partHandler->get(Request::getInt('partnum', 0));
        } else {
            $partObject = $partHandler->create();
        }
        // Form save fields
        $partObject->setVar('price', Request::getVar('price', ''));
        $partObject->setVar('stock', Request::getVar('stock', ''));
        $partObject->setVar('title', Request::getVar('title', ''));
        $partObject->setVar('description', Request::getText('description', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/cardealer/images/';
        $uploader  = new \XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'cardealer'), xoops_getModuleOption('maxsize', 'cardealer'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

              $uploader->setPrefix('picture_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $partObject->setVar('picture', $uploader->getSavedFileName());
            }
        } else {
            $partObject->setVar('picture', Request::getVar('picture', ''));
        }

        if ($partHandler->insert($partObject)) {
            redirect_header('part.php?op=list', 2, AM_CARDEALER_FORMOK);
        }

        echo $partObject->getHtmlErrors();
        $form = $partObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CARDEALER_ADD_PART, 'part.php?op=new', 'add');
        $adminObject->addItemButton(AM_CARDEALER_PART_LIST, 'part.php', 'list');
        $adminObject->displayButton('left');
        $partObject = $partHandler->get(Request::getString('partnum', ''));
        $form       = $partObject->getForm();
        $form->display();
        break;

    case 'delete':
        $partObject = $partHandler->get(Request::getString('partnum', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('part.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($partHandler->delete($partObject)) {
                redirect_header('part.php', 3, AM_CARDEALER_FORMDELOK);
            } else {
                echo $partObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok'      => 1,
                           'partnum' => Request::getString('partnum', ''),
                           'op'      => 'delete'
                          ], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CARDEALER_FORMSUREDEL, $partObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('partnum', '');

        if ($utility::cloneRecord('cardealer_part', 'partnum', $id_field)) {
            redirect_header('part.php', 3, AM_CARDEALER_CLONED_OK);
        } else {
            redirect_header('part.php', 3, AM_CARDEALER_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CARDEALER_ADD_PART, 'part.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start               = Request::getInt('start', 0);
        $partPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('partnum ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($partPaginationLimit);
        $criteria->setStart($start);
        $partTempRows  = $partHandler->getCount();
        $partTempArray = $partHandler->getAll($criteria);

        // Display Page Navigation
        if ($partTempRows > $partPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($partTempRows, $partPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('partRows', $partTempRows);
        $partArray = [];

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($partPaginationLimit);
        $criteria->setStart($start);

        $partCount     = $partHandler->getCount($criteria);
        $partTempArray = $partHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($partCount > 0) {
            foreach (array_keys($partTempArray) as $i) {


                //        $field = explode(':', $fields[$i]);

                $selectorpartnum = $utility::selectSorting(AM_CARDEALER_PART_PARTNUM, 'partnum');
                $GLOBALS['xoopsTpl']->assign('selectorpartnum', $selectorpartnum);
                $partArray['partnum'] = $partTempArray[$i]->getVar('partnum');

                $selectorprice = $utility::selectSorting(AM_CARDEALER_PART_PRICE, 'price');
                $GLOBALS['xoopsTpl']->assign('selectorprice', $selectorprice);
                $partArray['price'] = $partTempArray[$i]->getVar('price');

                $selectorstock = $utility::selectSorting(AM_CARDEALER_PART_STOCK, 'stock');
                $GLOBALS['xoopsTpl']->assign('selectorstock', $selectorstock);
                $partArray['stock'] = $partTempArray[$i]->getVar('stock');

                $selectortitle = $utility::selectSorting(AM_CARDEALER_PART_TITLE, 'title');
                $GLOBALS['xoopsTpl']->assign('selectortitle', $selectortitle);
                $partArray['title'] = $partTempArray[$i]->getVar('title');

                $selectordescription = $utility::selectSorting(AM_CARDEALER_PART_DESCRIPTION, 'description');
                $GLOBALS['xoopsTpl']->assign('selectordescription', $selectordescription);
                $partArray['description'] = $partTempArray[$i]->getVar('description');

                $selectorpicture = $utility::selectSorting(AM_CARDEALER_PART_PICTURE, 'picture');
                $GLOBALS['xoopsTpl']->assign('selectorpicture', $selectorpicture);
                $partArray['picture'] = "<img src='" . $uploadUrl . $partTempArray[$i]->getVar('picture') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";
                $partArray['edit_delete']
                                      = "<a href='part.php?op=edit&partnum=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='part.php?op=delete&partnum=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='part.php?op=clone&partnum=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('partArrays', $partArray);
                unset($partArray);
            }
            unset($partTempArray);
            // Display Navigation
            if ($partCount > $partPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($partCount, $partPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='part.php?op=edit&partnum=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='part.php?op=delete&partnum=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CARDEALER_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='7'>There are noXXX part</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/cardealer_admin_part.tpl');
        }

        break;
}
require __DIR__ . '/admin_footer.php';
