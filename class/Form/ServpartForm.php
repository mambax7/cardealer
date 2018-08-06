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
 * Class ServpartForm
 */
class ServpartForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CARDEALER_SERVPART_ADD) : sprintf(AM_CARDEALER_SERVPART_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CARDEALER_SERVPART_ID, $this->targetObject->getVar('id'), 'id'));
        // Partnum
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $partHandler */
        $partHandler = new cardealer\PartHandler($db);

        $part_id_select = new \XoopsFormSelect(AM_CARDEALER_SERVPART_PARTNUM, 'partnum', $this->targetObject->getVar('partnum'));
        $part_id_select->addOptionArray($partHandler->getList());
        $this->addElement($part_id_select, false);
        // Itemnum
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $serviceHandler */
        $serviceHandler = new cardealer\ServiceHandler($db);

        $service_id_select = new \XoopsFormSelect(AM_CARDEALER_SERVPART_ITEMNUM, 'itemnum', $this->targetObject->getVar('itemnum'));
        $service_id_select->addOptionArray($serviceHandler->getList());
        $this->addElement($service_id_select, false);
        // Quantity
        $this->addElement(new \XoopsFormText(AM_CARDEALER_SERVPART_QUANTITY, 'quantity', 50, 255, $this->targetObject->getVar('quantity')), false);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
