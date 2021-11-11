<?php
// Copyright by MOS

require_once("header.php"); 
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
?>

<?php
// Script root folder (Example: http://www.mydomain.here/joomla/modules/)
$Address = "http://www.blackrock-gaming.com/modules/";
// Enter your Core server IP or Domain
$ip_world = "68.233.239.99";
// Enter your Core server port (8085 = Deafult TCWorld Port)
$port_world = "8085";
// Enter your Realm server IP or Domain
$ip_auth = "68.233.239.99";
// Enter your Realm server port (3724 = Deafult TCRealm Port)
$port_auth = "3724";
if (! $sock = @fsockopen($ip_world, $port_world, $num, $error, 3)) 
echo "<table width=\"300px\" border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Game Server:</td>
	<td align=\"left\" valign=\"middle\">Offline</td></tr>"; 
else{ 
echo "<table width=\"300px\" border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Game Server:</td>
	<td align=\"left\" valign=\"middle\">Online</td></tr>"; 
fclose($sock);
} 

if (! $sock = @fsockopen($ip_auth, $port_auth, $num, $error, 3)) 
echo "<table width=\"300px\" border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Login Server:</td>
	<td align=\"left\" valign=\"middle\">Offline</td></tr></table>"; 
else{ 
echo "<table width=\"300px\" border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Login Server:</td>
	<td align=\"left\" valign=\"middle\">Online</td></tr></table>"; 
fclose($sock);

}
?>

<?php
// MySQL settings
$WoWHostname = "68.233.239.99"; // MySQL server address
$WoWUsername = "webwow"; // MySQL username
$WoWPassword = "iomegatuning"; // MySQL password
$CharacterDatabase = 'characters'; // TC characters database
$RealmDatabase = 'auth'; // TC relamd database
$WorldDatabase = 'world'; // TC world database
$CharacterDatabaseEncoding = 'utf8'; // database character encoding

// DO NOT EDIT BELOW HERE IF YOU DON'T KNOW WHAT IT IS!!!
$WoWconn = mysql_connect($WoWHostname, $WoWUsername, $WoWPassword) or die('Connection failed: ' . mysql_error());

mysql_select_db($CharacterDatabase, $WoWconn) or die('Selecting the database failed: ' . mysql_error());

$sql = "SELECT * FROM `characters` WHERE `online` = 1 ORDER BY `name`";
$result = mysql_query($sql, $WoWconn) or die('Query failed: ' . mysql_error());

$count = 0;
?>

<?php
// Do the show
$realm_db = mysql_connect($WoWHostname, $WoWUsername, $WoWPassword);
mysql_select_db($RealmDatabase, $realm_db);
$db_result = mysql_query("SET NAMES $CharacterDatabaseEncoding", $realm_db);

$world_db = mysql_connect($WoWHostname, $WoWUsername, $WoWPassword, TRUE);
mysql_select_db($CharacterDatabase, $world_db);
$db_result = mysql_query("SET NAMES $CharacterDatabaseEncoding", $world_db);

$gamebuild_query = mysql_query("SELECT `gamebuild` FROM $RealmDatabase.`realmlist`", $world_db)or die(mysql_error());
$gamebuild_results = mysql_fetch_array($gamebuild_query);

if ($gamebuild_results['gamebuild'] > '11403') {
	$gamebuild = "3.3.5a (" .$gamebuild_results['gamebuild']. ")";
}
else {
	$gamebuild = $gamebuild_results['gamebuild'];
}

$uptime_query = mysql_query("SELECT * FROM $RealmDatabase.`uptime` ORDER BY `starttime` DESC LIMIT 1", $realm_db)or die(mysql_error()); 
$uptime_results = mysql_fetch_array($uptime_query);
//Current uptime
if ($uptime_results['uptime'] > 86400) { //days
    $uptime =  round(($uptime_results['uptime'] / 24 / 60 / 60),2)." Days";
}
elseif($uptime_results['uptime'] > 3600) { //hours
    $uptime =  round(($uptime_results['uptime'] / 60 / 60),2)." Hours";
}
else { //minutes
    $uptime =  round(($uptime_results['uptime'] / 60),2)." Minutes";
}

$total_uptime_query = mysql_query("SELECT (SELECT SUM(uptime) FROM $RealmDatabase.`uptime`)as total_uptime", $realm_db)or die(mysql_error()); 
$total_uptime_results = mysql_fetch_array($total_uptime_query);
//Total uptime
if ($total_uptime_results['total_uptime'] > 86400) { //days
    $total_uptime =  round(($total_uptime_results['total_uptime'] / 24 / 60 / 60),1)." Days";
}
elseif($uptime_results['uptime'] > 3600) { //hours
    $total_uptime =  round(($total_uptime_results['total_uptime'] / 60 / 60),1)." Hours";
}
else { //minutes
    $total_uptime =  round(($total_uptime_results['total_uptime'] / 60),1)." Minutes";
}

$uptime_since_query = mysql_query("SELECT starttime FROM uptime ORDER BY starttime ASC LIMIT 1", $realm_db)or die(mysql_error());
$uptime_since_results = mysql_fetch_array($uptime_since_query);
$uptime_since_counter = (time() - $uptime_since_results['starttime']);
$uptime_since_counter_result = round(($uptime_since_counter / 24 / 60 / 60),1)." Days";

$total_offline = round(($uptime_since_counter - $total_uptime_results['total_uptime']) / 60 / 60 / 24,1)." Days";

$maxplayers_query = mysql_query("SELECT `maxplayers` FROM $RealmDatabase.`uptime` ORDER BY `maxplayers` DESC LIMIT 1", $realm_db)or die(mysql_error());
$maxplayers_results =  mysql_fetch_array($maxplayers_query);
$maxplayers = $maxplayers_results['maxplayers'];

$player_query = mysql_query("SELECT (SELECT COUNT(guid) FROM $CharacterDatabase.`characters` WHERE race IN(2,5,6,8,10) AND `online`='1') as horde, (SELECT COUNT(guid) FROM $CharacterDatabase.`characters` WHERE race IN(1,3,4,7,11) AND `online`='1') as alliance FROM $CharacterDatabase.`characters`", $world_db)or die(mysql_error()); 
$player_results = mysql_fetch_array($player_query); 
$horde =  $player_results['horde'];
$alliance =  $player_results['alliance'];
$total = $horde + $alliance;

$total_player_query = mysql_query("SELECT (SELECT COUNT(guid) FROM $CharacterDatabase.`characters` WHERE race IN(2,5,6,8,10)) as total_horde, (SELECT COUNT(guid) FROM $CharacterDatabase.`characters` WHERE race IN(1,3,4,7,11)) as total_alliance FROM $CharacterDatabase.`characters`", $world_db)or die(mysql_error()); 
$total_player_results = mysql_fetch_array($total_player_query); 
$total_horde =  $total_player_results['total_horde'];
$total_alliance =  $total_player_results['total_alliance'];
$total_all = $total_horde + $total_alliance;

$account_query = mysql_query("SELECT (SELECT COUNT(id) FROM $RealmDatabase.`account`) as aid", $realm_db)or die(mysql_error()); 
$account_result = mysql_fetch_array($account_query);
$account = $account_result['aid'];

echo "<br><div align=\"left\" class=\"table-title\">.: Server Details :.</div>
<FONT COLOR=cyan><table FONT COLOR=cyan width=\"300px\" border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=\"left\" valign=\"middle\" bgcolor=\"#3f3f3f\"><FONT COLOR=white>Patch Version:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$gamebuild."</td>
  </tr>
  <tr>
    <FONT COLOR=cyan><td align=\"left\" valign=\"middle\"><FONT COLOR=white>Server Alter:</td>
    <td FONT COLOR=cyan align=\"left\" valign=\"middle\"><FONT COLOR=white>".$uptime_since_counter_result."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\" bgcolor=\"#3f3f3f\"><FONT COLOR=white>Uptime:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$uptime."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Davon Server Online</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$total_uptime."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\" bgcolor=\"#3f3f3f\"><FONT COLOR=white>Davon Server Offline:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$total_offline."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Zurzeit Online Spieler:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$total."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\" bgcolor=\"#3f3f3f\"><FONT COLOR=white>Gleichzeitig Online waren:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$maxplayers."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>Accounts:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$account."</td>
  </tr>
  <tr>
    <td align=\"left\" valign=\"middle\" bgcolor=\"#3f3f3f\"><FONT COLOR=white>Characters:</td>
    <td align=\"left\" valign=\"middle\"><FONT COLOR=white>".$total_all."</td>
  </tr>
  </table>
  <br>
  <table width=\"120\" border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=\"center\" valign=\"bottom\"><div align=center><img src=\"".$Address."/alliance_small.gif\"><br><b><FONT COLOR=cyan>Alliance</font></b></div></td>
    <td align=\"center\" valign=\"bottom\"><div align=center><img src=\"".$Address."/horde_small.gif\"><br><b><FONT COLOR=red>Horde</font></b></div></td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"bottom\"><b><div align=center><FONT COLOR=white>".$alliance."</b><FONT COLOR=white>/".$total_alliance."</div></td>
    <td align=\"center\" valign=\"bottom\"><b><div align=center><FONT COLOR=white>".$horde."</b><FONT COLOR=white>/".$total_horde."</div></td>
  </tr>
</table>";
?>