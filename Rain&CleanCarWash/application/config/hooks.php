<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// define hooks to extend CodeIgniter
// more info at: http://codeigniter.com     /user_guide/general/hooks.html
$hook['post_controller_constructor'] = array(
                                'class'    => '',
                                'function' => 'load_config',
                                'filename' => 'load_config.php',
                                'filepath' => 'hooks'
                                );