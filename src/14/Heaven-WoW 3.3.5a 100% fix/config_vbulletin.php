<?php
if (!defined('AXE'))
{	
	die('Access to config file denied!');
}

// enable and disable VBulletin intergration
// true for enable, false for disable
$vb_config['enable'] = true;

// database settings
$vb_config['db_name'] = 'forum';
$vb_config['db_host'] = '127.0.0.1';
$vb_config['db_user'] = 'trinity';
$vb_config['db_pass'] = 'trinity';

?>