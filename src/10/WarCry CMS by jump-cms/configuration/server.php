<?php
if (!defined('init_config'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

//Website Database Connection Info
$server_config['CORE'] = 'trinity';

//Realms configuration
$realms_config[1] = array(
	'name' 			=> 'AzerothCore x5', 
	'descr' 		=> 'Test Warcry CMS by Jump-cms.eu', 	
	'Database' 		=> array(
		'host' 		=> '62.221.131.133', 
		'name' 		=> 'characters', 		
		'user' 		=> 'root', 
		'pass' 		=> 'ascent', 
		'encoding' 	=> 'utf8'
	), 
	'address' 		=> '62.221.131.133',
	'port' 			=> '8085',
	'soap_protocol' => 'http',
	'soap_address'  => '62.221.131.133',
	'soap_port'     => '7878',
	'soap_user'     => 'cvetence',
	'soap_pass'     => 'maikale123',
	'UPDATE_TIME' 	=> '1 minutes',
);