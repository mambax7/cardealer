<?php namespace XoopsModules\Cardealer\Form;

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

require dirname(dirname(__DIR__)) . '/include/common.php';

$moduleDirName = basename(dirname(dirname(__DIR__)));
$helper        = Cardealer\Helper::getInstance();
$permHelper    = new \Xmf\Module\Helper\Permission();

xoops_load('XoopsFormLoader');

/**
 * Class PartForm
 */
class PartForm extends \XoopsThemeForm
{
    public $targetObject;

    /**
     * Constructor
     *
     * @param $target
     */
    public function __construct($target)
    {
        global $helper;
        $this->targetObject = $target;

        $title = $this->targetObject->isNew() ? sprintf(AM_CARDEALER_PART_ADD) : sprintf(AM_CARDEALER_PART_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('partnum', $this->targetObject->getVar('partnum'));
        $this->addElement($hidden);
        unset($hidden);

        // Partnum
        $this->addElement(new \XoopsFormLabel(AM_CARDEALER_PART_PARTNUM, $this->targetObject->getVar('partnum'), 'partnum'));
        // Price
        $this->addElement(new \XoopsFormText(AM_CARDEALER_PART_PRICE, 'price', 50, 255, $this->targetObject->getVar('price')), false);
        // Stock
        $this->addElement(new \XoopsFormText(AM_CARDEALER_PART_STOCK, 'stock', 50, 255, $this->targetObject->getVar('stock')), false);
        // Title
        $this->addElement(new \XoopsFormText(AM_CARDEALER_PART_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
        // Description
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'description';
            $editorOptions['value']  = $this->targetObject->getVar('description', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';

            if ($helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor(AM_CARDEALER_PART_DESCRIPTION, $helper->getConfig('cardealerEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(AM_CARDEALER_PART_DESCRIPTION, $helper->getConfig('cardealerEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(AM_CARDEALER_PART_DESCRIPTION, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Picture
        $picture = $this->targetObject->getVar('picture') ?: 'blank.png';

        $uploadDir   = '/uploads/cardealer/images/';
        $imgtray     = new \XoopsFormElementTray(AM_CARDEALER_PART_PICTURE, '<br>');
        $imgpath     = sprintf(AM_CARDEALER_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'picture', $picture);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_picture\", \"picture\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $picture . "' name='image_picture' id='image_picture' alt='' />"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CARDEALER_FORMUPLOAD, 'picture', xoops_getModuleOption('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
