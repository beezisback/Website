<?php
// Uptime
mysql_select_db("$uptime");
$reponse = mysql_query("SELECT uptime, starttime FROM `uptime` ORDER BY `uptime`.`starttime` DESC") or die(mysql_error());
$donnees = mysql_fetch_array($reponse);
$temps = $donnees['uptime'];
$day = floor($temps / 86400);
if($day > 0)
$days = $day.'';
else
$days = '0';
$hours = floor(($temps - ($day * 86400)) / 3600);
if($hours < 10)
$hours = ''.$hours;
$min = floor(($temps - (($hours * 3600) + ($day * 86400))) / 60);
if ($min < 10)
$min = "".$min;

$sec = $temps - ($day * 86400) - ($hours * 3600) - ($min * 60);
if ($sec < 10)
$sec = "".$sec;
// Uptime

// online players
mysql_select_db("$player_online");
$sql = "SELECT SUM(online) FROM characters";
$sqlquery = mysql_query($sql) or die(mysql_error());
$memb = mysql_result($sqlquery,0,0); 
$asql = "SELECT SUM(online) FROM characters WHERE race IN(1,3,4,7,11)";
$asqlquery = mysql_query($asql) or die(mysql_error());
$amemb = mysql_result($asqlquery,0,0);  

$hsql = "SELECT SUM(online) FROM characters WHERE race IN(2,5,6,8,10)";
$hsqlquery = mysql_query($hsql) or die(mysql_error());
$hmemb = mysql_result($hsqlquery,0,0); 
//mysql_close($conn);
// online players
?>
<div id="colh">
<div id="server">
<p>Lastwow 15x:</p>
<div class="players"> <span style="width: <?php echo $memb; ?>px;"> <a id="#" onclick="if (document.getElementById('infop').style.display=='block') { document.getElementById('infop').style.display='none';document.getElementById('symbol').innerHTML='+'; } else { document.getElementById('infop').style.display='block'; document.getElementById('symbol').innerHTML='-'; } " href="#">+</a> </span> <cite><?php echo $memb; ?> / 2000</cite> </div><p id="infop" style="display: none;">
<b>Online players: </b> <?php echo $memb; ?><br>
<b>Alliance Online:</b> <?php echo $amemb; ?><br>
<b>Horde Online:</b> <?php echo $hmemb; ?><br>
<b>Max Online:</b> 86 <br>
<!--<b>CPU usage:</b> 0.07 %<br>
<b>RAM usage:</b> 3239.395 MB<br>
-->
<b>Uptime:</b> <?php echo "$days"; ?> d, <?php echo "$hours"; ?> h, <?php echo "$min"; ?> m, <?php echo "$sec"; ?> s <br>
</p>
</div>
<br/>
<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{

print '<a href="register.wow" class="vote-button green">Join us Now!</a>


<center><a href="https://www.facebook.com/lastwow.net/" title="Join us Now!" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJ0bcw6RNI1MlVi9xrGvb5R1qMsVFEqt_HGcV0ZEyaZPAbdr7G8Q" width="180" height="42" alt="Join us Now!"/></a></center>';



}
?>

<?php
if (!defined('AXE'))
	exit;

if (!$a_user['is_guest'])
{
	
print '<a href="account.wow?i=vote" class="vote-button orange">Vote LastWOW</a>


<center><a href="https://www.facebook.com/lastwow.net/" title="Join us Now!" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJ0bcw6RNI1MlVi9xrGvb5R1qMsVFEqt_HGcV0ZEyaZPAbdr7G8Q" width="180" height="42" alt="Join us Now!"/></a></center>';
	
}
?>
<!--<center><a href="https://discord.gg/q34xV" title="Join our Discord!" target="_blank"><img src="styles/default/Images/disk.png" width="180" height="42" alt="Join our Discord!"/></a></center>-->
<div id="select">
<p class="tab" title="Lastwow 15x"><a href="#">Lastwow 15x</a></p>
<div class="boxholder">
<div class="box">

<h3>TOP 5 Arena Teams (2v2)</h3>
<ul class="info">
<ul class="title">
<?php
$a=0;
mysql_select_db("$arena_top");
$connection = @mysql_connect($db_host, $db_username, $db_password);
$db_select = @mysql_select_db($db_database);
 

$sql = mysql_query("SELECT * FROM arena_team  JOIN arena_team_stats ON ( arena_team.arenateamid = arena_team_stats.arenateamid ) WHERE type = '2' ORDER BY rating DESC LIMIT 5");

echo '
<li>Rank</li>
<li>Faction</li>
<li class="nw">Name</li>
<li>Rating</li>
</ul>';

while ($row = mysql_fetch_array($sql)){
$query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
$gleader = "SELECT name,race FROM `characters` WHERE `guid`='$row[captainguid]' ";
$myrow = mysql_fetch_array(mysql_query($gleader));
$top = mysql_query("SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$row[arenateamid]'");
$toprow = mysql_fetch_array($top);
if ($a<=5)
$a=$a+1;
 
if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){
   
 
 	$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";
	}else{
	$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}

 
 echo"
<ul class='datatwo'>
<li class='rank'>".$a."</li>
<li class='faction'>$faction</li>
<li class='name'><a title=".$row['name'].">".$row['name']."</a></li>
<li class='rating'>".$toprow['rating']."</li>
</ul>
";
 }
 
?>
</ul>
<h3>TOP 5 Arena Teams (3v3)</h3>
<ul class="info">
<ul class="title">
<?php
$a=0;
mysql_select_db("$arena_top");
$connection = @mysql_connect($db_host, $db_username, $db_password);
$db_select = @mysql_select_db($db_database);
 

$sql = mysql_query("SELECT * FROM arena_team  JOIN arena_team_stats ON ( arena_team.arenateamid = arena_team_stats.arenateamid ) WHERE type = '3' ORDER BY rating DESC LIMIT 5");

echo '
<li>Rank</li>
<li>Faction</li>
<li class="nw">Name</li>
<li>Rating</li>
</ul>';

while ($row = mysql_fetch_array($sql)){
$query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
$gleader = "SELECT name,race FROM `characters` WHERE `guid`='$row[captainguid]' ";
$myrow = mysql_fetch_array(mysql_query($gleader));
$top = mysql_query("SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$row[arenateamid]'");
$toprow = mysql_fetch_array($top);
if ($a<=5)
$a=$a+1;
 
if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){
   
 
 	$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";
	}else{
	$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}

 
 echo"
<ul class='datatwo'>
<li class='rank'>".$a."</li>
<li class='faction'>$faction</li>
<li class='name'><a title=".$row['name'].">".$row['name']."</a></li>
<li class='rating'>".$toprow['rating']."</li>
</ul>
";
 }
 
?>
</ul>
<h3>TOP 5 Arena Teams (5v5)</h3>
<ul class="info">
<ul class="title">
<?php
$a=0;
mysql_select_db("$arena_top");
$connection = @mysql_connect($db_host, $db_username, $db_password);
$db_select = @mysql_select_db($db_database);
 

$sql = mysql_query("SELECT * FROM arena_team  JOIN arena_team_stats ON ( arena_team.arenateamid = arena_team_stats.arenateamid ) WHERE type = '5' ORDER BY rating DESC LIMIT 5");

echo '
<li>Rank</li>
<li>Faction</li>
<li class="nw">Name</li>
<li>Rating</li>
</ul>';

while ($row = mysql_fetch_array($sql)){
$query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
$gleader = "SELECT name,race FROM `characters` WHERE `guid`='$row[captainguid]' ";
$myrow = mysql_fetch_array(mysql_query($gleader));
$top = mysql_query("SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$row[arenateamid]'");
$toprow = mysql_fetch_array($top);
if ($a<=5)
$a=$a+1;
 
if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){
   
 
 	$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";
	}else{
	$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}

 
 echo"
<ul class='datatwo'>
<li class='rank'>".$a."</li>
<li class='faction'>$faction</li>
<li class='name'><a title=".$row['name'].">".$row['name']."</a></li>
<li class='rating'>".$toprow['rating']."</li>
</ul>
";
 }
 
?>
</ul>
<br/>
<br/>
<center><a href='http://www.xtremetop100.com/in.php?site=1132332464' title='WoW private server'><img src='/styles/default/Images/vote/1.jpg' width='88' height='51' alt='WoW private server' border='0'></a></center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</div>
</div>
</div>