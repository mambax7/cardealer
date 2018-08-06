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
$moduleDirName = basename(__DIR__);

$modversion = [
    'version'             => 1.0,
    'module_status'       => 'Beta 1',
    'release_date'        => '2018/08/06',
    'name'                => MI_CARDEALER_NAME,
    'description'         => MI_CARDEALER_DESC,
    'release'             => '2017-12-31',
    'author'              => 'XOOPS Development Team',
    'author_mail'         => 'mambax7@gmail.com',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team',
    //    'license' => 'GPL 2.0 or later',
    'help'                => 'page=help',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',

    'release_info' => 'release_info',
    'release_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/release_info file",

    'manual'              => 'Installation.txt',
    'manual_file'         => XOOPS_URL . "/modules/{$moduleDirName}/docs/link to manual file",
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.9',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => $moduleDirName,
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin things
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Menu
    'hasMain'             => 1,
    // Scripts to run upon installation or update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'customer',
        $moduleDirName . '_' . 'part',
        $moduleDirName . '_' . 'service',
        $moduleDirName . '_' . 'servpart',
        $moduleDirName . '_' . 'vehicle',
        $moduleDirName . '_' . 'workorder',
        $moduleDirName . '_' . 'workserv',
    ],
];
// ------------------- Search -----------------------------//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'cardealer_search';
//  ------------------- Comments -----------------------------//
$modversion['hasComments']          = 1;
$modversion['comments']['itemName'] = 'com_id';
$modversion['comments']['pageName'] = 'comments.php';
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'cardealer_com_approve';
$modversion['comments']['callback']['update']  = 'cardealer_com_update';
//  ------------------- Templates -----------------------------//
$modversion['templates'][] = [
    'file'        => 'cardealer_header.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_index.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_customer.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_customer_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_part.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_part_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_service.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_service_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_servpart.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_servpart_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_vehicle.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_vehicle_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_workorder.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_workorder_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_workserv.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'cardealer_workserv_list0.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'cardealer_footer.tpl',
    'description' => ''
];

$modversion['templates'][] = [
    'file'        => 'admin/cardealer_admin_about.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'admin/cardealer_admin_help.tpl',
    'description' => ''
];
$modversion['templates'][] = [
    'file'        => 'admin/cardealer_admin_workserv.tpl',
    'description' => ''
];

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => MI_CARDEALER_OVERVIEW, 'link' => 'page=help'],
    ['name' => MI_CARDEALER_DISCLAIMER,'link' => 'page=disclaimer'],
    ['name' => MI_CARDEALER_LICENSE,'link' => 'page=license'],
    ['name' => MI_CARDEALER_SUPPORT,'link' => 'page=support'],
];

// ------------------- Blocks -----------------------------//
$modversion['blocks'][] = [
    'file'        => 'customer.php',
    'name'        => MI_CARDEALER_CUSTOMER_BLOCK,
    'description' => '',
    'show_func'   => 'showCardealerCustomer',
    'edit_func'   => 'editCardealerCustomer',
    'options'     => '|5|25|0',
    'template'    => 'cardealer_customer_block.tpl'
];

$modversion['blocks'][] = [
    'file'        => 'part.php',
    'name'        => MI_CARDEALER_PART_BLOCK,
    'description' => '',
    'show_func'   => 'showCardealerPart',
    'edit_func'   => 'editCardealerPart',
    'options'     => '|5|25|0',
    'template'    => 'cardealer_part_block.tpl'
];

$modversion['blocks'][] = [
    'file'        => 'service.php',
    'name'        => MI_CARDEALER_SERVICE_BLOCK,
    'description' => '',
    'show_func'   => 'showCardealerService',
    'edit_func'   => 'editCardealerService',
    'options'     => '|5|25|0',
    'template'    => 'cardealer_service_block.tpl'
];

$modversion['blocks'][] = [
    'file'        => 'servpart.php',
    'name'        => MI_CARDEALER_SERVPART_BLOCK,
    'description' => '',
    'show_func'   => 'showCardealerServpart',
    'edit_func'   => 'editCardealerServpart',
    'options'     => '|5|25|0',
    'template'    => 'cardealer_servpart_block.tpl'
];

$modversion['blocks'][] = [
    'file'        => 'vehicle.php',
    'name'        => MI_CARDEALER_VEHICLE_BLOCK,
    'description' => '',
    'show_func'   => 'showCardealerVehicle',
    'edit_func'   => 'editCardealerVehicle',
    'options'     => '|5|25|0',
    'template'    => 'cardealer_vehicle_block.tpl'
];

$modversion['blocks'][] = [
    'file'        => 'workorder.php',
    'name'        => MI_CARDEALER_WORKORDER_BLOCK,
    'description' => '',
    'show_func'   => 'showCardealerWorkorder',
    'edit_func'   => 'editCardealerWorkorder',
    'options'     => '|5|25|0',
    'template'    => 'cardealer_workorder_block.tpl'
];

// ------------------- Config Options -----------------------------//
xoops_load('xoopseditorhandler');
$editorHandler          = \XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'cardealerEditorAdmin',
    'title'       => 'MI_CARDEALER_EDITOR_ADMIN',
    'description' => 'MI_CARDEALER_EDITOR_DESC_ADMIN',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'tinymce'
];

$modversion['config'][] = [
    'name'        => 'cardealerEditorUser',
    'title'       => 'MI_CARDEALER_EDITOR_USER',
    'description' => 'MI_CARDEALER_EDITOR_DESC_USER',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'dhtmltextarea'
];

// -------------- Get groups --------------
/** @var \XoopsMemberHandler $memberHandler */
$memberHandler = xoops_getHandler('member');
$xoopsGroups   = $memberHandler->getGroupList();
foreach ($xoopsGroups as $key => $group) {
    $groups[$group] = $key;
}
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => 'MI_CARDEALER_GROUPS',
    'description' => 'MI_CARDEALER_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $groups,
    'default'     => $groups
];

// -------------- Get Admin groups --------------
$criteria = new \CriteriaCompo ();
$criteria->add(new \Criteria ('group_type', 'Admin'));
/** @var \XoopsMemberHandler $memberHandler */
$memberHandler    = xoops_getHandler('member');
$adminXoopsGroups = $memberHandler->getGroupList($criteria);
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $admin_groups[$adminGroup] = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => 'MI_CARDEALER_ADMINGROUPS',
    'description' => 'MI_CARDEALER_ADMINGROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $admin_groups,
    'default'     => $admin_groups
];

$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => 'MI_CARDEALER_KEYWORDS',
    'description' => 'MI_CARDEALER_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'cardealer,customer, part, service, servpart, vehicle, workorder'
];

// --------------Uploads : maxsize of image --------------
$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => 'MI_CARDEALER_MAXSIZE',
    'description' => 'MI_CARDEALER_MAXSIZE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5000000
];

// --------------Uploads : mimetypes of image --------------
$modversion['config'][] = [
    'name'        => 'mimetypes',
    'title'       => 'MI_CARDEALER_MIMETYPES',
    'description' => 'MI_CARDEALER_MIMETYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => [
        'image/gif',
        'image/jpeg',
        'image/png'
    ],
    'options'     => [
        'bmp'   => 'image/bmp',
        'gif'   => 'image/gif',
        'pjpeg' => 'image/pjpeg',
        'jpeg'  => 'image/jpeg',
        'jpg'   => 'image/jpg',
        'jpe'   => 'image/jpe',
        'png'   => 'image/png'
    ]
];

$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => 'MI_CARDEALER_ADMINPAGER',
    'description' => 'MI_CARDEALER_ADMINPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
];

$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => 'MI_CARDEALER_USERPAGER',
    'description' => 'MI_CARDEALER_USERPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
];

$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => 'MI_CARDEALER_ADVERTISE',
    'description' => 'MI_CARDEALER_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => 'MI_CARDEALER_BOOKMARKS',
    'description' => 'MI_CARDEALER_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'fbcomments',
    'title'       => 'MI_CARDEALER_FBCOMMENTS',
    'description' => 'MI_CARDEALER_FBCOMMENTS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

/**
 * Make Sample button visible?
 */
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'MI_CARDEALER_SHOW_SAMPLE_BUTTON',
    'description' => 'MI_CARDEALER_SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// -------------- Notifications cardealer --------------
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'cardealer_notify_iteminfo';

$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => MI_CARDEALER_GLOBAL_NOTIFY,
    'description'    => MI_CARDEALER_GLOBAL_NOTIFY_DESC,
    'subscribe_from' => [
        'index.php',
        'viewcat.php',
        'singlefile.php'
    ]
];

$modversion['notification']['category'][] = [
    'name'           => 'category',
    'title'          => MI_CARDEALER_CATEGORY_NOTIFY,
    'description'    => MI_CARDEALER_CATEGORY_NOTIFY_DESC,
    'subscribe_from' => [
        'viewcat.php',
        'singlefile.php'
    ],
    'item_name'      => 'cid',
    'allow_bookmark' => 1
];

$modversion['notification']['category'][] = [
    'name'           => 'file',
    'title'          => MI_CARDEALER_FILE_NOTIFY,
    'description'    => MI_CARDEALER_FILE_NOTIFY_DESC,
    'subscribe_from' => 'singlefile.php',
    'item_name'      => 'lid',
    'allow_bookmark' => 1
];

$modversion['notification']['event'][] = [
    'name'          => 'new_category',
    'category'      => 'global',
    'title'         => MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY,
    'caption'       => MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY_DESC,
    'mail_template' => 'global_newcategory_notify',
    'mail_subject'  => MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_modify',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY,
    'caption'       => MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY_DESC,
    'mail_template' => 'global_filemodify_notify',
    'mail_subject'  => MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_broken',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY,
    'caption'       => MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY_DESC,
    'mail_template' => 'global_filebroken_notify',
    'mail_subject'  => MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY,
    'caption'       => MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'global_filesubmit_notify',
    'mail_subject'  => MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'global',
    'title'         => MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY,
    'caption'       => MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'global_newfile_notify',
    'mail_subject'  => MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'category',
    'admin_only'    => 1,
    'title'         => MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY,
    'caption'       => MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'category_filesubmit_notify',
    'mail_subject'  => MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'category',
    'title'         => MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY,
    'caption'       => MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'category_newfile_notify',
    'mail_subject'  => MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'approve',
    'category'      => 'file',
    'admin_only'    => 1,
    'title'         => MI_CARDEALER_FILE_APPROVE_NOTIFY,
    'caption'       => MI_CARDEALER_FILE_APPROVE_NOTIFY_CAPTION,
    'description'   => MI_CARDEALER_FILE_APPROVE_NOTIFY_DESC,
    'mail_template' => 'file_approve_notify',
    'mail_subject'  => MI_CARDEALER_FILE_APPROVE_NOTIFY_SUBJECT
];
