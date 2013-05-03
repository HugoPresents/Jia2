<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
// $hook['post_controller_constructor'] = array(
                // 'function' => 'hook_acl',
                // 'filename'=> 'acl.php',
                // 'filepath' => 'hooks',
                // 'params' => array(),
// );

$hook['post_controller_constructor'] = array(
	'function' => 'initialize',
	'filename' => 'jia.php',
	'filepath' => 'hooks'
);

$hook['post_controller'] = array(
	'function' => 'jia_redirect',
	'filename' => 'jia.php',
	'filepath' => 'hooks'
);


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */