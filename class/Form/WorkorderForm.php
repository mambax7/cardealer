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
 * Class WorkorderForm
 */
class WorkorderForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CARDEALER_WORKORDER_ADD) : sprintf(AM_CARDEALER_WORKORDER_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CARDEALER_WORKORDER_ID, $this->targetObject->getVar('id'), 'id'));
        // Custnum
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $customerHandler */
        $customerHandler = new cardealer\CustomerHandler($db);

        $customer_id_select = new \XoopsFormSelect(AM_CARDEALER_WORKORDER_CUSTNUM, 'custnum', $this->targetObject->getVar('custnum'));
        $customer_id_select->addOptionArray($customerHandler->getList());
        $this->addElement($customer_id_select, false);
        // Carnum
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $vehicleHandler */
        $vehicleHandler = new cardealer\VehicleHandler($db);

        $vehicle_id_select = new \XoopsFormSelect(AM_CARDEALER_WORKORDER_CARNUM, 'carnum', $this->targetObject->getVar('carnum'));
        $vehicle_id_select->addOptionArray($vehicleHandler->getList());
        $this->addElement($vehicle_id_select, false);
        // Cost
        $this->addElement(new \XoopsFormText(AM_CARDEALER_WORKORDER_COST, 'cost', 50, 255, $this->targetObject->getVar('cost')), false);
        // Orderdate
        $this->addElement(new \XoopsFormTextDateSelect(AM_CARDEALER_WORKORDER_ORDERDATE, 'orderdate', '', strtotime($this->targetObject->getVar('orderdate'))));
        // Status
        $status       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('status');
        $check_status = new \XoopsFormCheckBox(AM_CARDEALER_WORKORDER_STATUS, 'status', $status);
        $check_status->addOption(1, ' ');
        $this->addElement($check_status);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
