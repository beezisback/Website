<?php

######################################################
# Website Title
######################################################
$title="HEAVEN-W0W Private Server";

//web master email address
$WebMaster = 'admin@heavenwow.com';

######################################################
# Domain url
#  - With http:// and without trailling slash "/" at end
######################################################
$domain_url="http://84.252.23.96";

######################################################
# Server Address
#  - Used for online/offline status
#  - PHP fsockopen() must be enabled on your web server
######################################################
$server = "84.252.23.96";

######################################################
# SQL Connection
######################################################
$db_user = "root";
$db_pass = "ascent" ;
$db_host = "127.0.0.1";
$db_encoding = 'utf8';

######################################################
# Website Database Name
#  - For this CMS
######################################################
$db_name = "auth";

######################################################
# World Database Name
#  - Not so important, helps admin to search item IDs.
######################################################
$item_db ="world";

######################################################
# Accounts Database Name
#  - Where all accounts are stored
######################################################
$acc_db ="auth";

######################################################
# Realm Configuration
#  - You can have unlimited amount of realms
#  - Example: (X represents number 1 -> infinity)
#
#  //Server no.X
#  $realm[X] = array(
#  "name" => "Test server,
#  "port" => "8085",
#  "port_ra" => "3443",
#  "db"   => "characters"
#  );
######################################################
//Realm no.1
$realm[1] = array(
"name" => "Lordaeron [12x]",
"descr" => "WoTLK 3.3.5a 12x",
"port" => "8085",
"port_ra" => "3443",

"db" => "characters"
);


//Top Arena Teams config
$TopArenaTeams = array(
	array('realmid' => 1, 'limit' => 5, 'TC2' => true),
	array('realmid' => 2, 'limit' => 5, 'TC2' => true),
	array('realmid' => 3, 'limit' => 5, 'TC2' => true),
);
######################################################
# Core Settings (ascent,mangos,trinity or trinity_ra)
######################################################
$server_core ="trinity_ra";

######################################################
# SMTP Settings
######################################################
$smtp_h = "";
$smtp_u = "";
$smtp_p = "";

######################################################
# Expansion Changer Settings
#
# Change to "false" if you want to disable an option
# Change to "true" if you want to enable an option
######################################################
$config_Expansions['allowed']['expansion_normal'] = false;
$config_Expansions['allowed']['expansion_tbc'] = false;
$config_Expansions['allowed']['expansion_wotlk'] = true;
$config_Expansions['allowed']['expansion_cata'] = true;

######################################################
# Vote Settings
#  - You can have unlimited amount of vote urls
#  - Images for vote are stored in:
#  - htdocs/styles/<yourstyle>/images/<votenumber>.jpg
#  Example with 3 vote url's:
#
#  $voteurls = array(
#  1 => "http://vote_url_1",
#  2 => "http://vote_url_2",
#  3 => "http://vote_url_3"
#  );"
######################################################
$voteurls = array(
1 => "http://www.xtremetop100.com/in.php?site=1132326790",
2 => "http://www.openwow.com/?vote=2107",
3 => "http://www.mmorpgtoplist.com/in.php?site=43815",
4 => "http://www.wow-private-servers.org/World-of-Warcraft-Private-Servers/?v=kembar91",
5 => "http://topg.org/index.php?siteid=351403",
6 => "http://www.wowstatus.net/in.php?server=766298",
7 => "http://www.razortopg.org/?in=70",
);

// Bonus Vote Points for defined URL
// values:
// - bonusPoints : The bonus points the user will receive, example: 1 + 2(bonus points) = 3
// - days        : The first X days of the month
//
// Adding URL to receive bonus points example: 
// {
// 		5 => array('bonusPoints' => 1, 'days' => 5),
// }
// In this case the leading 5 is the URL ID, taken from $voteurls
$voteBonuses = array(
	1 => array('bonusPoints' => 2, 'days' => 5),
);

######################################################
# Style
#  - Located in: htdocs/styles/<style>/
######################################################
$style='heaven';

######################################################
# Use ToS (1 or 0)
######################################################
$usetos = 0;

######################################################
# Other
######################################################
$module_teleporter_gold="0";

/***************************
***   DONT EDIT BELOW    ***
***************************/
$se_c = "baf9abece3482c2236e47291d35ac07e";
$db_type = "mysql";
$db_prefix = "a_";
$p_connect = false;

$cookie_name = "webwowheaven_cookie";
$cookie_domain = "";
$cookie_path = "/";
$cookie_secure = 0;

//autogenerated MaNGOS,Trinity RA
$ra_user = "yexs";//admin account
$ra_pass = "1234566";//admin password

define('AXE', 1);

include 'config_vbulletin.php';
?>