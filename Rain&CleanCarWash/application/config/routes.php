<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// This script allows re-mapping of URI requests to other desired controllers

// Use of a one-to-one relationship between a URL string
// and its corresponding controller class/method is used

// For details, user guides have proven competent: http://codeigniter.com/user_guide/general/routing.html

$route['default_controller'] = "login";
$route['no_access/(:any)'] = "no_access/index/$1";
$route['reports/(summary_:any)/(:any)/(:any)'] = "reports/$1/$2/$3";
$route['reports/summary_:any'] = "reports/date_input";

$route['reports/(detailed_sales)/(:any)/(:any)'] = "reports/$1/$2/$3";
$route['reports/detailed_sales'] = "reports/date_input";
$route['reports/(specific_:any)/(:any)/(:any)/(:any)'] = "reports/$1/$2/$3/$4";
$route['reports/specific_customer'] = "reports/specific_customer_input";
$route['reports/specific_employee'] = "reports/specific_employee_input";

$route['scaffolding_trigger'] = "";

// EOF routes.php