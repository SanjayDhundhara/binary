<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'Site/Main';
$route['default_controller'] = 'Site/Main';
$route['AdminSecure_Area'] = 'Admin/Management/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['app']['GET'] = 'Site/Auth';
$route['app']['POST'] = 'Site/Auth';
$route['app-logout'] = 'App/User/logout';
$route['csv'] = 'Site/Csv';
$route['Admin/logout'] = 'Admin/Management/logout';
$route['Admin/activate-account']['GET'] = 'Admin/AdminActivation';
$route['Admin/activate-account']['POST'] = 'Admin/AdminActivation';

$route['forget-password'] = 'Dashboard/Auth/forgetPassword';
$route['login'] = 'Dashboard/Auth';
$route['register'] = 'Dashboard/Register';
$route['Dashboard/transaction-password']['GET'] = 'Dashboard/Profile/changePassword';
$route['Dashboard/transaction-password']['POST'] = 'Dashboard/Profile/transPassword';

$route['Dashboard/staking-history'] = 'Dashboard/Reports/stakingHistory';
$route['Dashboard/staking-history/(:num)'] = 'Dashboard/Reports/stakingHistory';
