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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'home/index';
$route['about'] = 'home/about';
$route['services'] = 'home/service';
$route['contact'] = 'home/contact';

/*********** USER DEFINED ROUTES *******************/
//$route['admin/loginMe'] = 'admin/login';
$route['admin'] = 'admin/user';
$route['logout'] = 'admin/user/logout';
$route['admin/userListing'] = 'admin/user/userListing';
$route['admin/userListing/(:num)'] = "admin/user/userListing/$1";
$route['admin/addNew'] = "admin/user/addNew";
$route['admin/addNewUser'] = "admin/user/addNewUser";
$route['admin/editOld'] = "admin/user/editOld";
$route['admin/editOld/(:any)'] = "admin/user/editOld/$1";
$route['admin/editUser'] = "admin/user/editUser";
$route['admin/deleteUser'] = "admin/user/deleteUser";
$route['admin/loadChangePass'] = "admin/user/loadChangePass";
$route['admin/changePassword'] = "admin/user/changePassword";
$route['admin/pageNotFound'] = "admin/user/pageNotFound";
$route['admin/checkEmailExists'] = "admin/user/checkEmailExists";
$route['admin/forgotPassword'] = "admin/login/forgotPassword";
$route['admin/resetPasswordUser'] = "admin/login/resetPasswordUser";
$route['admin/resetPasswordConfirmUser'] = "admin/login/resetPasswordConfirmUser";
$route['admin/resetPasswordConfirmUser/(:any)'] = "admin/login/resetPasswordConfirmUser/$1";
$route['admin/resetPasswordConfirmUser/(:any)/(:any)'] = "admin/login/resetPasswordConfirmUser/$1/$2";
$route['admin/createPasswordUser'] = "admin/login/createPasswordUser";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
