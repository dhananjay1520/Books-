<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

// BookSpot Admin MVC
$route['admin'] = 'admin/index';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/profile'] = 'admin/profile';
$route['admin/profile/update'] = 'admin/update_profile';
$route['admin/profile/upload_image'] = 'admin/upload_admin_image';
$route['admin/orders'] = 'admin/orders';
$route['admin/reports'] = 'admin/reports';
$route['admin/users'] = 'admin/users';
$route['admin/users/edit/(:num)'] = 'admin/edit_user/$1';
$route['admin/users/delete/(:num)'] = 'admin/delete_user/$1';
$route['admin/products'] = 'admin/products';
$route['admin/products/add'] = 'admin/add_product';
$route['admin/products/edit/(:num)'] = 'admin/edit_product/$1';
$route['admin/products/delete/(:num)'] = 'admin/delete_product/$1';
$route['admin/ebooks'] = 'admin/ebooks';
$route['admin/ebooks/delete/(:num)'] = 'admin/delete_ebook/$1';
$route['admin/messages'] = 'admin/messages';
$route['admin/messages/view/(:num)'] = 'admin/view_message/$1';

// Public profile routes retained for the existing front-end.
$route['profile'] = 'profile/index';
$route['profile/upload_image'] = 'profile/upload_image';
$route['profile/update_account'] = 'profile/update_account';


// Cart / checkout / browse routes
$route['cart'] = 'cart/index';
$route['cart/add'] = 'cart/add';
$route['cart/update'] = 'cart/update';
$route['cart/remove/(:num)/(:any)'] = 'cart/remove/$1/$2';
$route['cart/clear'] = 'cart/clear';
$route['checkout'] = 'checkout/index';
$route['rent'] = 'rent/index';
$route['rent/(:num)'] = 'rent/index/$1';
$route['rent/save'] = 'rent/save';
$route['payment/success'] = 'checkout/success';
$route['category'] = 'filter/index';
$route['filter'] = 'filter/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
