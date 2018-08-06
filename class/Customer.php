<?php namespace XoopsModules\Cardealer;

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
use XoopsModules\Cardealer\Form;

/**
 * Class Customer
 */
class Customer extends \XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('custnum', XOBJ_DTYPE_INT);
        $this->initVar('custname', XOBJ_DTYPE_TXTBOX);
        $this->initVar('custaddr', XOBJ_DTYPE_OTHER);
    }

    /**
     * Get form
     *
     * @param null
     * @return Cardealer\Form\CustomerForm
     */
    public function getForm()
    {
        $form = new Form\CustomerForm($this);
        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('custnum'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('custnum'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('custnum'));
    }
}

