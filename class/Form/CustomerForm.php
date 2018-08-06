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
 * Class CustomerForm
 */
class CustomerForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CARDEALER_CUSTOMER_ADD) : sprintf(AM_CARDEALER_CUSTOMER_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('custnum', $this->targetObject->getVar('custnum'));
        $this->addElement($hidden);
        unset($hidden);

        // Custnum
        $this->addElement(new \XoopsFormLabel(AM_CARDEALER_CUSTOMER_CUSTNUM, $this->targetObject->getVar('custnum'), 'custnum'));
        // Custname
        $this->addElement(new \XoopsFormText(AM_CARDEALER_CUSTOMER_CUSTNAME, 'custname', 50, 255, $this->targetObject->getVar('custname')), false);
        // Custaddr
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'custaddr';
            $editorOptions['value']  = $this->targetObject->getVar('custaddr', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';

            if ($helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor(AM_CARDEALER_CUSTOMER_CUSTADDR, $helper->getConfig('cardealerEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(AM_CARDEALER_CUSTOMER_CUSTADDR, $helper->getConfig('cardealerEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(AM_CARDEALER_CUSTOMER_CUSTADDR, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
