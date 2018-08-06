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
 * Class VehicleForm
 */
class VehicleForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CARDEALER_VEHICLE_ADD) : sprintf(AM_CARDEALER_VEHICLE_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CARDEALER_VEHICLE_ID, $this->targetObject->getVar('id'), 'id'));
        // Custnum
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $customerHandler */
        $customerHandler = new cardealer\CustomerHandler($db);

        $customer_id_select = new \XoopsFormSelect(AM_CARDEALER_VEHICLE_CUSTNUM, 'custnum', $this->targetObject->getVar('custnum'));
        $customer_id_select->addOptionArray($customerHandler->getList());
        $this->addElement($customer_id_select, false);
        // Make
        $this->addElement(new \XoopsFormText(AM_CARDEALER_VEHICLE_MAKE, 'make', 50, 255, $this->targetObject->getVar('make')), false);
        // Model
        $this->addElement(new \XoopsFormText(AM_CARDEALER_VEHICLE_MODEL, 'model', 50, 255, $this->targetObject->getVar('model')), false);
        // Year
        $this->addElement(new \XoopsFormText(AM_CARDEALER_VEHICLE_YEAR, 'year', 50, 255, $this->targetObject->getVar('year')), false);
        // Pictures
        $pictures = $this->targetObject->getVar('pictures') ?: 'blank.png';

        $uploadDir   = '/uploads/cardealer/images/';
        $imgtray     = new \XoopsFormElementTray(AM_CARDEALER_VEHICLE_PICTURES, '<br>');
        $imgpath     = sprintf(AM_CARDEALER_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'pictures', $pictures);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_pictures\", \"pictures\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $pictures . "' name='image_pictures' id='image_pictures' alt='' />"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CARDEALER_FORMUPLOAD, 'pictures', xoops_getModuleOption('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Serialnum
        $this->addElement(new \XoopsFormText(AM_CARDEALER_VEHICLE_SERIALNUM, 'serialnum', 50, 255, $this->targetObject->getVar('serialnum')), false);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
