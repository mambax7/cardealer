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
 * Class ServiceForm
 */
class ServiceForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CARDEALER_SERVICE_ADD) : sprintf(AM_CARDEALER_SERVICE_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('itemnum', $this->targetObject->getVar('itemnum'));
        $this->addElement($hidden);
        unset($hidden);

        // Itemnum
        $this->addElement(new \XoopsFormLabel(AM_CARDEALER_SERVICE_ITEMNUM, $this->targetObject->getVar('itemnum'), 'itemnum'));
        // Labor
        $this->addElement(new \XoopsFormText(AM_CARDEALER_SERVICE_LABOR, 'labor', 50, 255, $this->targetObject->getVar('labor')), false);
        // Title
        $this->addElement(new \XoopsFormText(AM_CARDEALER_SERVICE_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
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
                $descEditor = new \XoopsFormEditor(AM_CARDEALER_SERVICE_DESCRIPTION, $helper->getConfig('cardealerEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(AM_CARDEALER_SERVICE_DESCRIPTION, $helper->getConfig('cardealerEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(AM_CARDEALER_SERVICE_DESCRIPTION, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
