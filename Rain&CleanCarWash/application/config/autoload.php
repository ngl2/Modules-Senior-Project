<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Forms to load by default
$autoload['libraries'] = array('database','session','form_validation','session','user_agent');

//sale
$autoload['helper'] = array('form','url','table','client','text','currency');

$autoload['plugin'] = array();

$autoload['config'] = array();

$autoload['language'] = array('common', 'config', 'customers', 'employees', 'error', 'items', 'login', 'module', 'reports', 'sales','suppliers');

$autoload['model'] = array('Appconfig','Person','Customer','Employee','Module','Item', 'Item_taxes', 'Sale','Supplier');
