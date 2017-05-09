<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');


# URL to codeigniter root
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);


# index file
$config['index_page'] = "index.php";

# uri protocol - auto works in most cases
$config['uri_protocol']	= "AUTO";

# Used to add a suffix to all URLs constructed by codeigniter
// set to null to avoid error
$config['url_suffix'] = "";

# language file to load by default
$config['language']	= "english";

# default char set
$config['charset'] = "UTF-8";

# here hooks are enabled because codeigniter is used
$config['enable_hooks'] = TRUE;

# Any prefix other than "CI_" can be used. Codeigniter uses "MY_" by default
# information at: http://codeigniter.com     /user_guide/general/core_classes.html, 
				# http://codeigniter.com     /user_guide/general/creating_libraries.html
$config['subclass_prefix'] = 'MY_';

# here url characters are restricted to as little as needed
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-'; # use of regular expression

# enable query srings for codeigniter 
$config['enable_query_strings'] = TRUE;
$config['directory_trigger'] = 'd';	
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';

# here the error threshold is set. meaning we choose which errors we want to log
/*
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
*/
$config['log_threshold'] = 0; # just using 0 to save file space

# define where to store logs, setting blank defers to default location which is where we want them
$config['log_path'] = '';

# date format for logs
$config['log_date_format'] = 'Y-m-d H:i:s';

# define where to store cache files. default location is fine
$config['cache_path'] = '';

# set encryption key...default since encryption is not enabled
$config['encryption_key'] = "";

/*
		SESSION VARIABLES
| 'session_cookie_name' = the name you want for the cookie
| 'encrypt_sess_cookie' = TRUE/FALSE (boolean).  Whether to encrypt the cookie
| 'session_expiration'  = the number of seconds the session will last
| 'time_to_update'		= how many seconds between CI refreshing Session Information
*/
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200; # 7200s is 2hr.
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= TRUE;
$config['sess_table_name']		= 'sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update'] 		= 300; # session refreshes info every 300 seconds

/*
		COOKIE VARIABLES
| 'cookie_prefix' = Set a prefix if needed. We don't need one.
| 'cookie_domain' = can be set for sidewide cookies, but in this case we can leave blank.
| 'cookie_path'   = default path is fine
*/
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";


# set to true to always activate XSS filter when getting or posting cookie data. 
# false to never activate XSS
$config['global_xss_filtering'] = TRUE;

# here we can set output to be zipped if desired, in tihs case we don't need to compress
$config['compress_output'] = FALSE;

# master time reference, local or gmt are accepted. local should work
$config['time_reference'] = 'local';

# Codeigniter can rewrite tags on the fly if we set true, but we will use false
$config['rewrite_short_tags'] = FALSE;

/* EOF config.php */