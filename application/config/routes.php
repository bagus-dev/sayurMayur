<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Penjualan Online

$route['kategori/bumbu'] = 'page/bumbu';

$route['penjualan-online'] = 'penjualanonline/index';
$route['penjualan-online/(:any)'] = 'penjualanonline/detail_invoice/$1';
$route['penjualan-online/status/check'] = 'penjualanonline/cek_status';
$route['penjualan-online/status/change'] = 'penjualanonline/change_status';
$route['penjualan_online/laporan'] = 'penjualanonline/laporan';
$route['penjualan_online/print_struk/(:any)'] = 'penjualanonline/cetak_struk/$1';
$route['penjualan_online/cetak_laporan'] = 'penjualanonline/cetak_laporan';

$route['penjualan/cetak_laporan'] = 'penjualan/cetak_laporan';
$route['pembelian/cetak_laporan'] = 'pembelian/cetak_laporan';
