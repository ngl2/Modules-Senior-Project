<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# setting the octal values. defaults will work fine 
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

# File stream modes for fopen
define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb');	// use of truncuate
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // use of truncuate
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

# EOF constants.php
