<?php
print"Make sure your site db already exists before you install. The Domain field is for the domian of your website, and should start with http:// and end with /. The Phpbb3 Path is the location fo your Phpbb3 install, it should start with ./ with no ending /.";
print"<br/><br/><b>Examples:</b><br/>";
print"Domain: http://MyDomain.com/<br/>";
print"Phpbb3 Path: ./forums";
print"<br/><br/>";
//
print'<form action="" method="post">';
print'<table width="100%">';
//#
print'<tr>';
print'<td>';
print'<table align="center">';
print'<tr><td></td> <td align="center">Global Titles</td></tr>';
print'<tr><td>Acp Title:</td> <td><input type="text" name="atitle"></td></tr>';
print'<tr><td>Site Title:</td> <td><input type="text" name="stitle"></td></tr>';
print'</table>';
print'</td>';
//
print'<td>';
print'<table align="center">';
print'<tr><td></td> <td align="center">Realmlist & Copyright</td></tr>';
print'<tr><td>Realmlist:</td> <td><input type="text" name="realmlist"></td></tr>';
print'<tr><td>Copyright:</td> <td><input type="text" name="copyr"></td></tr>';
print'</table>';
print'</td>';
print'</tr>';
//#
print'<tr>';
print'<td>';
print'<table align="center">';
print'<tr><td></td> <td align="center">Database Settings</td></tr>';
print'<tr><td>Db Host:</td> <td><input type="text" name="host"></td></tr>';
print'<tr><td>Db User:</td> <td><input type="text" name="user"></td></tr>';
print'<tr><td>Db Pass:</td> <td><input type="password" name="pass"></td></tr>';
print'<tr><td>Site Db:</td> <td><input type="text" name="sdb"></td></tr>';
print'<tr><td>Account Db:</td> <td><input type="text" name="adb"></td></tr>';
print'</table>';
print'</td>';
//
print'<td>';
print'<table align="center">';
print'<tr><td></td> <td align="center">Admin Account</td></tr>';
print'<tr><td>Admin User:</td> <td><input type="text" name="au"></td></tr>';
print'<tr><td>Admin Pass:</td> <td><input type="password" name="ap"></td></tr>';
print'<tr><td>Admin Email:</td> <td><input type="text" name="email"></td></tr>';
print'<tr><td>Paypal Email:</td> <td><input type="text" name="pemail"></td></tr>';
print'<tr><td>Domain:</td> <td><input type="text" name="domain" value="http://MyDomain.com/"></td></tr>';
print'</table>';
print'</td>';
print'</tr>';
//#
print'<td>';
print'<table align="center">';
print'<tr><td></td> <td align="center">Main Realm Setup</td></tr>';
print'<tr><td>Name:</td> <td><input type="text" name="rname"></td></tr>';
print'<tr><td>Type:</td> <td><input type="text" name="rtype"></td></tr>';
print'<tr><td>Char Db:</td> <td><input type="text" name="rcdb"></td></tr>';
print'<tr><td>Port:</td> <td><input type="text" name="rport"></td></tr>';
print'<tr><td>Ra Port:</td> <td><input type="text" name="raport"></td></tr>';
print'<tr><td>Player Limit:</td> <td><input type="text" name="rplimit"></td></tr>';
print'</table>';
print'</td>';
//
print'<td>';
print'<table align="center">';
print'<tr><td></td> <td align="center">Random Settings</td></tr>';
print'<tr><td>Phpbb3 Path:</td> <td><input type="text" name="path" value="./forums"></td></tr>';
print'<tr><td>Phpbb3:</td> <td align="center">On:<input type="radio" name="forum" value="1"> |-|&nbsp; Off:<input type="radio" name="forum" value="0"></td></tr>';
print'<tr><td>Expansion:</td> <td align="center">Wotlk:<input type="radio" name="exp" value="2"> |-|&nbsp; Cata:<input type="radio" name="exp" value="3"></td></tr>';
print'<tr><td></td> <td align="center"><input type="submit" name="save" value="Save Settings / Install"></td></tr>';
print'</table>';
print'</td>';
print'</tr>';
//#
print'</table>';
print'</form>';

function install()
{
  if(isset($_POST['save']))
  {
  $atitle = $_POST['atitle'];
  $stitle = $_POST['stitle'];
  $host = $_POST['host'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $sdb = $_POST['sdb'];
  $adb = $_POST['adb'];
  $pemail = $_POST['pemail'];
  $domain = $_POST['domain'];
  $realmlist = $_POST['realmlist'];
  $copyr = $_POST['copyr'];
  $rname = $_POST['rname'];
  $rtype = $_POST['rtype'];
  $rcdb = $_POST['rcdb'];
  $rport = $_POST['rport'];
  $raport = $_POST['raport'];
  $rplimit = $_POST['rplimit'];
  $au = ucfirst(preg_replace("/[^A-Za-z0-9]/", "", $_POST['au']));
  $ap = preg_replace("/[^A-Za-z0-9]/", "", $_POST['ap']);
  $email = ucfirst(htmlentities($_POST['email']));
  $exp = $_POST['exp'];
  $forum = $_POST['forum'];
  $path = $_POST['path'];
  
  $config_file = "./global/config/config.php";
  $copen = fopen($config_file, 'w');
  
$config = '<?php error_reporting(0);
mb_http_output("UTF-8"); 
ob_start("mb_output_handler");
#- Azer CMS V1.5 Config -#
###################################
#####Acms Config: For Acms Acp#####
###################################
  //Global Acp Title
  $title = "'.$atitle.'";
  //Global Site Title
  $site_title = "'.$stitle.'";
  //Server Realmlist
  $realmlist = "'.$realmlist.'";
  //Site Copyright
  $copyr = "'.$copyr.'";
  //Server Hostname
  $host = "'.$host.'";
  //Spare Host
  $host2 = "'.$host.'";
  //Server Username
  $user = "'.$user.'";
  //Server Password
  $pass = "'.$pass.'";
  //Server Auth Database
  $db_a = "'.$adb.'";
  //Server Site Database
  $db_s = "'.$sdb.'";
  //Forum Database
  $db_f = "";
  //Paypal Email
  $paypal = "'.$pemail.'";
  //Paypal Return Url
  $p_r_url = "'.$domain.'";
  //Ra_User
  $rauser = "'.$au.'";
  //Ra_Pass
  $rapass = "'.$ap.'";
  //Expansion || 2 = Wotlk || 3 = Cata
  $expansion = "'.$exp.'";
###################################
###################################
###################################
?>';

  fwrite($copen, $config);
  fclose($copen);
  
  $connect = mysql_connect("$host", "$user", "$pass") or die("Connection Error: ". mysql_error());
  mysql_select_db("$sdb", $connect) or die("Database Error: ". mysql_error());
  
  //Set Date
  date_default_timezone_set('US/Pacific');
  $date = date('M d, Y');

mysql_query("CREATE TABLE `styles` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `active` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `login_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(32) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext,
  `date` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `realms` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `char_db` varchar(255) DEFAULT NULL,
  `port` int(32) DEFAULT NULL,
  `ra_port` int(32) DEFAULT NULL,
  `p_limit` int(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `shouts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL,
  `body` longtext,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `vote_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `site` int(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `user` varchar(64) DEFAULT NULL,
  `cost` int(32) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `vote_sites` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `cost` int(32) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `store` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `item_id` int(32) DEFAULT NULL,
  `amount` int(32) DEFAULT NULL,
  `cost` int(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `realm` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `vip_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cost` varchar(32) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `store_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) DEFAULT NULL,
  `character` varchar(64) DEFAULT NULL,
  `item` int(32) DEFAULT NULL,
  `cost` int(32) DEFAULT NULL,
  `date` varchar(64) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
)");

mysql_query("CREATE TABLE `forum_prop` (
  `active` int(32) DEFAULT NULL,
  `path` varchar(64) NOT NULL DEFAULT '0'
)");

  $rand = rand(100000000, 900000000);
  $ap = sha1(strtoupper($au) . ":" . strtoupper($ap));
  $ap = strtoupper($ap);
mysql_query("INSERT INTO news (author, title, body, date, avatar) VALUES ('Azer', 'Welcome To Azer CMS V2.0', 'Welcome, to your new website, powered by [b]Azer CMS V2.0[/b], the latest and greatest free website CMS for TrinityCore. Azer CMS now has partial support for Cataclysm.

[i]:bull: Admin Control Panel V2.0.
:bull: TrinityCore Support.
:bull: Partial Cata Support.
:bull: Manage News.
:bull: Manage ShoutBox.
:bull: Manage Item Store.
:bull: Manage Accounts.
:bull: Manage Account Game Access.
:bull: Manage Characters.
:bull: Multi-Realm Support.
:bull: Manage Realms.
:bull: Manage Styles.
:bull: Manage Forums.
:bull: Login Logs.
:bull: Vote Logs.
:bull: V.I.p Logs.
:bull: News System.
:bull: ShoutBox.
:bull: Register Page.
:bull: Forgot Password.
:bull: Realm Status.
:bull: How To Connect Page.
:bull: Character Unstuck.
:bull: Character Revive.
:bull: Vote Panel/Shop.
:bull: V.I.P Panel/Shop.
:bull: Online Players.
:bull: Top 10 Slayer List.
:bull: Phpbb3 Register Bridge.
:bull: Terms Of Service.[/i]

Post all questions, comments, or support issues related to your new website [url=http://azer-cms.info/forums/index.php?/forum/18-support/]here[/url], and remember to enjoy your new website!', '$date', 'Azer')");
mysql_query("INSERT INTO styles (name, active) VALUES ('default', '1')");
mysql_query("INSERT INTO realms (name, type, char_db, port, ra_port, p_limit) VALUES ('$rname', '$rtype', '$rcdb', '$rport', '$raport', '$rplimit')");
mysql_query("INSERT INTO forum_prop (active, path) VALUES ('$forum', '$path')");
mysql_query("ALTER TABLE $adb.account ADD COLUMN acp INT(32)");
mysql_query("ALTER TABLE $adb.account ADD COLUMN staff_id INT(32)");
mysql_query("ALTER TABLE $adb.account ADD COLUMN vp INT(32) NOT NULL DEFAULT '0'");
mysql_query("ALTER TABLE $adb.account ADD COLUMN dp varchar(32) NOT NULL DEFAULT '0'");
mysql_query("INSERT INTO $adb.account (username, sha_pass_hash, email, expansion, acp, staff_id) VALUES ('$au', '$ap', '$email', '$exp', '1', '$rand')");
mysql_query("UPDATE $adb.account SET username='$au', sha_pass_hash='$ap', email='$email', expansion='$exp', acp='1', staff_id='$rand' WHERE username='$au'");
mysql_query("INSERT INTO store (id, name, item_id, amount, cost, type, realm) VALUES ('1', 'Noggenfogger Elixir', '8529', '5', '1', 'vote', '1')");
mysql_query("INSERT INTO store (id, name, item_id, amount, cost, type, realm) VALUES ('2', 'Noggenfogger Elixir', '8529', '50', '5', 'vip', '1')");
print'<br/><br/><center>Now, delete the install file for security reasons. Your staff_Id: <b>'.$rand.'</b></center>';
  }
}

install();
?>