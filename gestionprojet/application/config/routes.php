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
$route['logout'] = 'auth/logout';
$route['done'] = 'Tasks/done_task';
$route['task/(:num)'] = 'Tasks/get_task_group/$1';
$route['avatar'] = 'Profile/set_avatar';
$route['search'] = 'Search/autocomplete';
$route['user'] = 'Users';
$route['user/project/(:num)'] = 'Users/get_project/$1';
$route['admin'] = 'Admin';
$route['admin/create'] = 'Admin/set_user';
$route['search/user/(:num)'] = 'Search/get_user/$1';
$route['admin/edit'] = 'Admin/update_user';
$route['admin/delete/(:num)'] = 'Admin/delete_user/$1';
$route['admin/project/(:num)'] = 'Admin/get_project/$1';
$route['chef'] = 'Chef';
$route['chef/create'] = 'Chef/set_project';
$route['chef/delete'] = 'Chef/delete_project';
$route['chef/update'] = 'Chef/update_task';
$route['chef/new'] = 'Chef/set_task';
$route['chef/add/(:num)/(:any)'] = 'Chef/add_user/$1/$2';
$route['chef/ban/(:num)'] = 'Chef/ban_user/$1';
$route['chef/project/(:num)'] = 'Chef/get_project/$1';
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
