<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
--	['hostname'] The hostname of the server that contains the db
--	['username'] The username used to connect to the database
--	['password'] The password used to connect to the database
--	['database'] Name of database that we want to connect to
--	['dbdriver'] The database type
--	['dbprefix'] You can add an optional prefix for clarity that appears when using active records
--	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
--	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
--	['cache_on'] TRUE/FALSE - Enables/disables query caching
--	['cachedir'] Specifies folder path to cache files
--	['char_set'] The character set used in communicating with the database
--	['dbcollat'] The character collation that communicates with the database
*/

$active_group = "default";
$active_record = TRUE;

$db['default']['hostname'] = "localhost";
$db['default']['username'] = "root";
$db['default']['password'] = "";
$db['default']['database'] = "rain";
$db['default']['dbdriver'] = "mysql";
$db['default']['dbprefix'] = "";
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = "C:\xampp\htdocs\Rain&CleanCarWash\system\cache";
$db['default']['char_set'] = "utf8";
$db['default']['dbcollat'] = "utf8_general_ci";

/* EOF database.php */