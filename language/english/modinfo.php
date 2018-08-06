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
// Admin
define('MI_CARDEALER_NAME', 'Cardealer');
define('MI_CARDEALER_DESC', 'This module is an example of an application for a Car Dealer Service Department');
//Menu
define('MI_CARDEALER_ADMENU1', 'Home');
define('MI_CARDEALER_ADMENU2', 'Customer');
define('MI_CARDEALER_ADMENU3', 'Parts');
define('MI_CARDEALER_ADMENU4', 'Service');
define('MI_CARDEALER_ADMENU5', 'ServiceParts');
define('MI_CARDEALER_ADMENU6', 'Vehicles');
define('MI_CARDEALER_ADMENU7', 'WorkOrders');
define('MI_CARDEALER_ADMENU8', 'WorkService');
define('MI_CARDEALER_ADMENU9', 'Permissions');
define('MI_CARDEALER_ADMENU10', 'About');
//Blocks
define('MI_CARDEALER_CUSTOMER_BLOCK', 'Customer block');
define('MI_CARDEALER_PART_BLOCK', 'Part block');
define('MI_CARDEALER_SERVICE_BLOCK', 'Service block');
define('MI_CARDEALER_SERVPART_BLOCK', 'Servpart block');
define('MI_CARDEALER_VEHICLE_BLOCK', 'Vehicle block');
define('MI_CARDEALER_WORKORDER_BLOCK', 'Workorder block');
//Config
define('MI_CARDEALER_EDITOR_ADMIN', 'Editor: Admin');
define('MI_CARDEALER_EDITOR_ADMIN_DESC', 'Select the Editor to use by the Admin');
define('MI_CARDEALER_EDITOR_USER', 'Editor: User');
define('MI_CARDEALER_EDITOR_USER_DESC', 'Select the Editor to use by the User');
define('MI_CARDEALER_KEYWORDS', 'Keywords');
define('MI_CARDEALER_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('MI_CARDEALER_ADMINPAGER', 'Admin: records / page');
define('MI_CARDEALER_ADMINPAGER_DESC', 'Admin: # of records shown per page');
define('MI_CARDEALER_USERPAGER', 'User: records / page');
define('MI_CARDEALER_USERPAGER_DESC', 'User: # of records shown per page');
define('MI_CARDEALER_MAXSIZE', 'Max size');
define('MI_CARDEALER_MAXSIZE_DESC', 'Set a number of max size uploads file in byte');
define('MI_CARDEALER_MIMETYPES', 'Mime Types');
define('MI_CARDEALER_MIMETYPES_DESC', 'Set the mime types selected');
define('MI_CARDEALER_IDPAYPAL', 'Paypal ID');
define('MI_CARDEALER_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
define('MI_CARDEALER_ADVERTISE', 'Advertisement Code');
define('MI_CARDEALER_ADVERTISE_DESC', 'Insert here the advertisement code');
define('MI_CARDEALER_BOOKMARKS', 'Social Bookmarks');
define('MI_CARDEALER_BOOKMARKS_DESC', 'Show Social Bookmarks in the form');
define('MI_CARDEALER_FBCOMMENTS', 'Facebook comments');
define('MI_CARDEALER_FBCOMMENTS_DESC', 'Allow Facebook comments in the form');
// Notifications
define('MI_CARDEALER_GLOBAL_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_FILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_FILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_GLOBAL_NEWFILE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_CATEGORY_NEWFILE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CARDEALER_FILE_APPROVE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CARDEALER_FILE_APPROVE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CARDEALER_FILE_APPROVE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CARDEALER_FILE_APPROVE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');

// Help
define('MI_CARDEALER_DIRNAME', basename(dirname(dirname(__DIR__))));
define('MI_CARDEALER_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('MI_CARDEALER_BACK_2_ADMIN', 'Back to Administration of ');
define('MI_CARDEALER_OVERVIEW', 'Overview');

//help multi-page
define('MI_CARDEALER_DISCLAIMER', 'Disclaimer');
define('MI_CARDEALER_LICENSE', 'License');
define('MI_CARDEALER_SUPPORT', 'Support');

// Permissions Groups
define('MI_CARDEALER_GROUPS', 'Groups access');
define('MI_CARDEALER_GROUPS_DESC', 'Select general access permission for groups.');
define('MI_CARDEALER_ADMINGROUPS', 'Admin Group Permissions');
define('MI_CARDEALER_ADMINGROUPS_DESC', 'Which groups have access to tools and permissions page');

define('MI_CARDEALER_SHOW_SAMPLE_BUTTON', 'Import Sample Button?');
define('MI_CARDEALER_SHOW_SAMPLE_BUTTON_DESC', 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.');

