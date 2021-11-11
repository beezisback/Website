<?php
if (!defined('init_config'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

$config['SiteName'] = 'Magical-WoW';

$config['RootPath'] = '/home/magicalw/public_html/lightbringer-project.ga'; 		//(No slash at the end)
$config['BaseURL'] = 'http://www.lightbringer-project.ga'; 	//(No slash at the end)

//Must be unique for each website
$config['AuthCookieName'] = 'Magical-WoW';

//Minifier Settings
//StyleFolderURL rewrites the URLs for the image in the CSS files
$config['StyleFolderURL'] = 'http://www.lightbringer-project.ga/template/style/'; //(With slash at the end)

//E-mail Address
$config['Email'] = 'info@localhost';

//Time settings
$config['TimeZone'] = 'Europe/Berlin';
$config['TimeZoneOffset'] = '+1';

//Warcry WoW Database URL
$config['WoWDB_URL'] = 'http://wotlk.cavernoftime.com';	//(No slash at the end)
//Complete URL to the power.js
$config['WoWDB_JS'] = 'http://cdn.cavernoftime.com/api/tooltip.js';