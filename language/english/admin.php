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

use Xmf\Request;

//Index
define('AM_CARDEALER_STATISTICS', 'Cardealer statistics');
define('AM_CARDEALER_THEREARE_CUSTOMER', "There are <span class='bold'>%s</span> Customer in the database");
define('AM_CARDEALER_THEREARE_PARTS', "There are <span class='bold'>%s</span> Parts in the database");
define('AM_CARDEALER_THEREARE_SERVICE', "There are <span class='bold'>%s</span> Service in the database");
define('AM_CARDEALER_THEREARE_SERVICEPARTS', "There are <span class='bold'>%s</span> ServiceParts in the database");
define('AM_CARDEALER_THEREARE_VEHICLES', "There are <span class='bold'>%s</span> Vehicles in the database");
define('AM_CARDEALER_THEREARE_WORKORDERS', "There are <span class='bold'>%s</span> WorkOrders in the database");
define('AM_CARDEALER_THEREARE_WORKSERVICE', "There are <span class='bold'>%s</span> WorkService in the database");
//Buttons
define('AM_CARDEALER_ADD_CUSTOMER', 'Add new Customer');
define('AM_CARDEALER_CUSTOMER_LIST', 'List of Customer');
define('AM_CARDEALER_ADD_PART', 'Add new Parts');
define('AM_CARDEALER_PART_LIST', 'List of Parts');
define('AM_CARDEALER_ADD_SERVICE', 'Add new Service');
define('AM_CARDEALER_SERVICE_LIST', 'List of Service');
define('AM_CARDEALER_ADD_SERVPART', 'Add new ServiceParts');
define('AM_CARDEALER_SERVPART_LIST', 'List of ServiceParts');
define('AM_CARDEALER_ADD_VEHICLE', 'Add new Vehicles');
define('AM_CARDEALER_VEHICLE_LIST', 'List of Vehicles');
define('AM_CARDEALER_ADD_WORKORDER', 'Add new WorkOrders');
define('AM_CARDEALER_WORKORDER_LIST', 'List of WorkOrders');
define('AM_CARDEALER_ADD_WORKSERV', 'Add new WorkService');
define('AM_CARDEALER_WORKSERV_LIST', 'List of WorkService');
//General
define('AM_CARDEALER_FORMOK', 'Registered successfull');
define('AM_CARDEALER_FORMDELOK', 'Deleted successfull');
define('AM_CARDEALER_FORMSUREDEL', "Are you sure to Delete: <span class='bold red'>%s</span></b>");
define('AM_CARDEALER_FORMSURERENEW', "Are you sure to Renew: <span class='bold red'>%s</span></b>");
define('AM_CARDEALER_FORMUPLOAD', 'Upload');
define('AM_CARDEALER_FORMIMAGE_PATH', 'File presents in %s');
define('AM_CARDEALER_FORM_ACTION', 'Action');
define('AM_CARDEALER_SELECT', 'Select action for selected item(s)');
define('AM_CARDEALER_SELECTED_DELETE', 'Delete selected item(s)');
define('AM_CARDEALER_SELECTED_ACTIVATE', 'Activate selected item(s)');
define('AM_CARDEALER_SELECTED_DEACTIVATE', 'De-activate selected item(s)');
define('AM_CARDEALER_SELECTED_ERROR', 'You selected nothing to delete');
define('AM_CARDEALER_CLONED_OK', 'Record cloned successfully');
define('AM_CARDEALER_CLONED_FAILED', 'Cloning of the record has failed');

// Customer
define('AM_CARDEALER_CUSTOMER_ADD', 'Add a customer');
define('AM_CARDEALER_CUSTOMER_EDIT', 'Edit customer');
define('AM_CARDEALER_CUSTOMER_DELETE', 'Delete customer');
define('AM_CARDEALER_CUSTOMER_CUSTNUM', 'ID');
define('AM_CARDEALER_CUSTOMER_CUSTNAME', 'Customer Name');
define('AM_CARDEALER_CUSTOMER_CUSTADDR', 'Address');
// Part
define('AM_CARDEALER_PART_ADD', 'Add a part');
define('AM_CARDEALER_PART_EDIT', 'Edit part');
define('AM_CARDEALER_PART_DELETE', 'Delete part');
define('AM_CARDEALER_PART_PARTNUM', ' ID');
define('AM_CARDEALER_PART_PRICE', ' Price');
define('AM_CARDEALER_PART_STOCK', ' Inventory');
define('AM_CARDEALER_PART_TITLE', ' Title');
define('AM_CARDEALER_PART_DESCRIPTION', ' Description');
define('AM_CARDEALER_PART_PICTURE', ' Picture');
// Service
define('AM_CARDEALER_SERVICE_ADD', 'Add a service');
define('AM_CARDEALER_SERVICE_EDIT', 'Edit service');
define('AM_CARDEALER_SERVICE_DELETE', 'Delete service');
define('AM_CARDEALER_SERVICE_ITEMNUM', 'ID');
define('AM_CARDEALER_SERVICE_LABOR', 'Labor (minutes)');
define('AM_CARDEALER_SERVICE_TITLE', 'Title');
define('AM_CARDEALER_SERVICE_DESCRIPTION', 'Description');
// Servpart
define('AM_CARDEALER_SERVPART_ADD', 'Add a servpart');
define('AM_CARDEALER_SERVPART_EDIT', 'Edit servpart');
define('AM_CARDEALER_SERVPART_DELETE', 'Delete servpart');
define('AM_CARDEALER_SERVPART_ID', 'ID');
define('AM_CARDEALER_SERVPART_PARTNUM', 'Part #');
define('AM_CARDEALER_SERVPART_ITEMNUM', 'Service Order #');
define('AM_CARDEALER_SERVPART_QUANTITY', 'Quantity');
// Vehicle
define('AM_CARDEALER_VEHICLE_ADD', 'Add a vehicle');
define('AM_CARDEALER_VEHICLE_EDIT', 'Edit vehicle');
define('AM_CARDEALER_VEHICLE_DELETE', 'Delete vehicle');
define('AM_CARDEALER_VEHICLE_ID', 'ID');
define('AM_CARDEALER_VEHICLE_CUSTNUM', 'Customer #');
define('AM_CARDEALER_VEHICLE_MAKE', 'Maker');
define('AM_CARDEALER_VEHICLE_MODEL', 'Model');
define('AM_CARDEALER_VEHICLE_YEAR', 'Year');
define('AM_CARDEALER_VEHICLE_PICTURES', 'Picture');
define('AM_CARDEALER_VEHICLE_SERIALNUM', 'Serial #');
// Workorder
define('AM_CARDEALER_WORKORDER_ADD', 'Add a workorder');
define('AM_CARDEALER_WORKORDER_EDIT', 'Edit workorder');
define('AM_CARDEALER_WORKORDER_DELETE', 'Delete workorder');
define('AM_CARDEALER_WORKORDER_ID', 'ID');
define('AM_CARDEALER_WORKORDER_CUSTNUM', 'Customer');
define('AM_CARDEALER_WORKORDER_CARNUM', 'Vehicle');
define('AM_CARDEALER_WORKORDER_COST', 'Cost');
define('AM_CARDEALER_WORKORDER_ORDERDATE', 'Order Date');
define('AM_CARDEALER_WORKORDER_STATUS', 'Status');
// Workserv
define('AM_CARDEALER_WORKSERV_ADD', 'Add a workserv');
define('AM_CARDEALER_WORKSERV_EDIT', 'Edit workserv');
define('AM_CARDEALER_WORKSERV_DELETE', 'Delete workserv');
define('AM_CARDEALER_WORKSERV_ID', 'ID');
define('AM_CARDEALER_WORKSERV_ORDERNUM', 'Order #');
define('AM_CARDEALER_WORKSERV_ITEMNUM', 'Item #');
//Blocks.php
//Permissions
define('AM_CARDEALER_PERMISSIONS_GLOBAL', 'Global permissions');
define('AM_CARDEALER_PERMISSIONS_GLOBAL_DESC', 'Only users in the group that you select may global this');
define('AM_CARDEALER_PERMISSIONS_GLOBAL_4', 'Rate from user');
define('AM_CARDEALER_PERMISSIONS_GLOBAL_8', 'Submit from user side');
define('AM_CARDEALER_PERMISSIONS_GLOBAL_16', 'Auto approve');
define('AM_CARDEALER_PERMISSIONS_APPROVE', 'Permissions to approve');
define('AM_CARDEALER_PERMISSIONS_APPROVE_DESC', 'Only users in the group that you select may approve this');
define('AM_CARDEALER_PERMISSIONS_VIEW', 'Permissions to view');
define('AM_CARDEALER_PERMISSIONS_VIEW_DESC', 'Only users in the group that you select may view this');
define('AM_CARDEALER_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('AM_CARDEALER_PERMISSIONS_SUBMIT_DESC', 'Only users in the group that you select may submit this');
define('AM_CARDEALER_PERMISSIONS_GPERMUPDATED', 'Permissions have been changed successfully');
define('AM_CARDEALER_PERMISSIONS_NOPERMSSET', 'Permission cannot be set: No workserv created yet! Please create a workserv first.');

//Errors
define('AM_CARDEALER_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('AM_CARDEALER_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('AM_CARDEALER_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('AM_CARDEALER_ERROR_COLUMN', 'Could not create column in database : %s');
define('AM_CARDEALER_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('AM_CARDEALER_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('AM_CARDEALER_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');
//directories
define('AM_CARDEALER_AVAILABLE', "<span style='color : #008000;'>Available. </span>");
define('AM_CARDEALER_NOTAVAILABLE', "<span style='color : #ff0000;'>is not available. </span>");
define('AM_CARDEALER_NOTWRITABLE', "<span style='color : #ff0000;'>" . ' should have permission ( %1$d ), but it has ( %2$d )' . '</span>');
define('AM_CARDEALER_CREATETHEDIR', 'Create it');
define('AM_CARDEALER_SETMPERM', 'Set the permission');
define('AM_CARDEALER_DIRCREATED', 'The directory has been created');
define('AM_CARDEALER_DIRNOTCREATED', 'The directory can not be created');
define('AM_CARDEALER_PERMSET', 'The permission has been set');
define('AM_CARDEALER_PERMNOTSET', 'The permission can not be set');
define('AM_CARDEALER_VIDEO_EXPIREWARNING', 'The publishing date is after expiration date!!!');
//Sample Data
define('AM_CARDEALER_ADD_SAMPLEDATA', 'Import Sample Data (will delete ALL current data)');
define('AM_CARDEALER_SAMPLEDATA_SUCCESS', 'Sample Date uploaded successfully');

//Error NoFrameworks
define('_AM_ERROR_NOFRAMEWORKS', 'Error: You don&#39;t use the Frameworks \'admin module\'. Please install this Frameworks');
define('AM_CARDEALER_MAINTAINEDBY', 'is maintained by the');
