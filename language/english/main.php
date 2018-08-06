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
// Main

define('MD_CARDEALER_ADMIN', 'Admin');
define('MD_CARDEALER_INDEX', 'Home');
define('MD_CARDEALER_ACTION', 'Action');
define('MD_CARDEALER_VIEW', 'View');
define('MD_CARDEALER_PRINT', 'Print');
define('MD_CARDEALER_TELL_A_FRIEND', 'Tell A Friend');

define('MD_CARDEALER_TITLE', 'Cardealer');
define('MD_CARDEALER_DESC', 'This module is an example of an application for a Car Dealer Service Department');
define('MD_CARDEALER_INDEX_DESC', 'This module is an example of an application for a Car Dealer Service Department');
// Customer
define('MD_CARDEALER_CUSTOMER', 'Customer');
define('MD_CARDEALER_CUSTOMER_DESC', 'Customer description');
define('MD_CARDEALER_CUSTOMER_CUSTNUM', 'ID');
define('MD_CARDEALER_CUSTOMER_CUSTNAME', 'Customer Name');
define('MD_CARDEALER_CUSTOMER_CUSTADDR', 'Address');
// Parts
define('MD_CARDEALER_PART', 'Parts');
define('MD_CARDEALER_PART_DESC', 'Parts description');
define('MD_CARDEALER_PART_PARTNUM', ' ID');
define('MD_CARDEALER_PART_PRICE', ' Price');
define('MD_CARDEALER_PART_STOCK', ' Inventory');
define('MD_CARDEALER_PART_TITLE', ' Title');
define('MD_CARDEALER_PART_DESCRIPTION', ' Description');
define('MD_CARDEALER_PART_PICTURE', ' Picture');
// Service
define('MD_CARDEALER_SERVICE', 'Service');
define('MD_CARDEALER_SERVICE_DESC', 'Service description');
define('MD_CARDEALER_SERVICE_ITEMNUM', 'ID');
define('MD_CARDEALER_SERVICE_LABOR', 'Labor (minutes)');
define('MD_CARDEALER_SERVICE_TITLE', 'Title');
define('MD_CARDEALER_SERVICE_DESCRIPTION', 'Description');
// Serviceparts
define('MD_CARDEALER_SERVPART', 'Serviceparts');
define('MD_CARDEALER_SERVPART_DESC', 'Serviceparts description');
define('MD_CARDEALER_SERVPART_ID', 'ID');
define('MD_CARDEALER_SERVPART_PARTNUM', 'Part #');
define('MD_CARDEALER_SERVPART_ITEMNUM', 'Service Order #');
define('MD_CARDEALER_SERVPART_QUANTITY', 'Quantity');
// Vehicles
define('MD_CARDEALER_VEHICLE', 'Vehicles');
define('MD_CARDEALER_VEHICLE_DESC', 'Vehicles description');
define('MD_CARDEALER_VEHICLE_ID', 'ID');
define('MD_CARDEALER_VEHICLE_CUSTNUM', 'Customer #');
define('MD_CARDEALER_VEHICLE_MAKE', 'Maker');
define('MD_CARDEALER_VEHICLE_MODEL', 'Model');
define('MD_CARDEALER_VEHICLE_YEAR', 'Year');
define('MD_CARDEALER_VEHICLE_PICTURES', 'Picture');
define('MD_CARDEALER_VEHICLE_SERIALNUM', 'Serial #');
// Workorders
define('MD_CARDEALER_WORKORDER', 'Workorders');
define('MD_CARDEALER_WORKORDER_DESC', 'Workorders description');
define('MD_CARDEALER_WORKORDER_ID', 'ID');
define('MD_CARDEALER_WORKORDER_CUSTNUM', 'Customer');
define('MD_CARDEALER_WORKORDER_CARNUM', 'Vehicle');
define('MD_CARDEALER_WORKORDER_COST', 'Cost');
define('MD_CARDEALER_WORKORDER_ORDERDATE', 'Order Date');
define('MD_CARDEALER_WORKORDER_STATUS', 'Status');
// Workservice
define('MD_CARDEALER_WORKSERV', 'Workservice');
define('MD_CARDEALER_WORKSERV_DESC', 'Workservice description');
define('MD_CARDEALER_WORKSERV_ID', 'ID');
define('MD_CARDEALER_WORKSERV_ORDERNUM', 'Order #');
define('MD_CARDEALER_WORKSERV_ITEMNUM', 'Item #');
