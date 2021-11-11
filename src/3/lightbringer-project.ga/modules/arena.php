<div id="menu">
<ul>
<li><a href="./">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li><a href="accounts.wow">Account Manager</a> | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li class="active">Statistics | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
<?php
if (!defined('AXE'))
	exit;
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include
?>




<?php
// Arena Stats
$a=0;
mysql_select_db("$arena_top");

$sql = mysql_query("SELECT * FROM arena_team  JOIN arena_team_stats ON ( arena_team.arenateamid = arena_team_stats.arenateamid ) WHERE type = '2' ORDER BY rating DESC LIMIT 10");

$numrows = mysql_num_rows($sql);
 if (!$numrows){
$whosonline = '<table>
      <tbody><tr>
        <td width="200" align="center"><a style="text-decoration: none;" title="Online" href="account.wow?i=online"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/online.png" bor="" der=""><br>Players Online</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Kills" href="account.wow?i=kills"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/kill.png" border=""><br>Kills</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Arena" href="account.wow?i=arena"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/honor.png" border=""><br>Arena Teams</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Stats" href="account.wow?i=stats"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/stats.png" border=""><br>Stats</a></td>
    </tr></tbody></table>		
	
<table style="text-align: center; margin-top: 40px;" width="100%">
<p style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 40px;"> 2 VS 2</p> 
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Faction</b></td><td><b>Name</b></td><td><b>Rating</b></td></tr>
<center>No arena teams (2v2)!</center>
';
}else{  
$whosonline = '<table>
      <tbody><tr>
        <td width="200" align="center"><a style="text-decoration: none;" title="Online" href="account.wow?i=online"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/online.png" bor="" der=""><br>Players Online</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Kills" href="account.wow?i=kills"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/kill.png" border=""><br>Kills</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Arena" href="account.wow?i=arena"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/honor.png" border=""><br>Arena Teams</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Stats" href="account.wow?i=stats"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/stats.png" border=""><br>Stats</a></td>
    </tr></tbody></table>	
<table style="text-align: center; margin-top: 40px;" width="100%">
<p style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 40px;"> 2 VS 2</p> 
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Faction</b></td><td><b>Name</b></td><td><b>Rating</b></td></tr>	 
';
while ($row = mysql_fetch_array($sql)){
$query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
$gleader = "SELECT name,race FROM `characters` WHERE `guid`='$row[captainguid]' ";
$myrow = mysql_fetch_array(mysql_query($gleader));
$top = mysql_query("SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$row[arenateamid]'");
$toprow = mysql_fetch_array($top);
if ($a<=100)
$a=$a+1;
 
if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){
   
 
 	$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";
	}else{
	$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}

	
 $whosonline .=' 
<tr> 
     <td width="200">'.$a.'</td>
 <td width="200">'.$faction.'</td>	 
    <td width="200">'.$row['name'].'</td>  
   <td width="200">'.$toprow['rating'].'</td>  
     </tr>';  
} }
$whosonline .="
</tbody></table>
";
// Arena Stats
?>	
<?php
// Arena Stats
$a=0;	
mysql_select_db("characters");
$sql = mysql_query("SELECT * FROM arena_team  JOIN arena_team_stats ON ( arena_team.arenateamid = arena_team_stats.arenateamid ) WHERE type = '3' ORDER BY rating DESC LIMIT 10");

$numrows = mysql_num_rows($sql);
 if (!$numrows){
$whosonline2 = '
<table style="text-align: center; margin-top: 40px;" width="100%">
<p style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 40px;"> 3 VS 3</p> 
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Faction</b></td><td><b>Name</b></td><td><b>Rating</b></td></tr>
<center> No arena teams (3v3)!</center>
';
}else{  
$whosonline2 = '	
<table style="text-align: center; margin-top: 40px;" width="100%">
<p style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 40px;"> 3 VS 3</p> 
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Faction</b></td><td><b>Name</b></td><td><b>Rating</b></td></tr>	 
';
while ($row = mysql_fetch_array($sql)){
$query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
$gleader = "SELECT name,race FROM `characters` WHERE `guid`='$row[captainguid]' ";
$myrow = mysql_fetch_array(mysql_query($gleader));
$top = mysql_query("SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$row[arenateamid]'");
$toprow = mysql_fetch_array($top);
if ($a<=100)
$a=$a+1;
 
if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){
   
 
 	$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";
	}else{
	$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}

	
 $whosonline2 .=' 
<tr> 
     <td width="200">'.$a.'</td>
 <td width="200">'.$faction.'</td>	 
    <td width="200">'.$row['name'].'</td>  
   <td width="200">'.$toprow['rating'].'</td>  
     </tr>';  
} }
$whosonline2 .="
</tbody></table>
";
// Arena Stats
?>
<?php
// Arena Stats
$a=0;	
mysql_select_db("characters");
$sql = mysql_query("SELECT * FROM arena_team  JOIN arena_team_stats ON ( arena_team.arenateamid = arena_team_stats.arenateamid ) WHERE type = '5' ORDER BY rating DESC LIMIT 10");
$numrows = mysql_num_rows($sql);
 if (!$numrows){
$whosonline3 = '
<table style="text-align: center; margin-top: 40px;" width="100%">
<p style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 40px;"> 5 VS 5</p> 
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Faction</b></td><td><b>Name</b></td><td><b>Rating</b></td></tr>
<center>No arena teams (5v5)!</center> 
';
}else{  
$whosonline3 = '	
<table style="text-align: center; margin-top: 40px;" width="100%">
<p style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 40px;"> 5 VS 5</p> 
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Faction</b></td><td><b>Name</b></td><td><b>Rating</b></td></tr>	 
';
while ($row = mysql_fetch_array($sql)){
$query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
$gleader = "SELECT name,race FROM `characters` WHERE `guid`='$row[captainguid]' ";
$myrow = mysql_fetch_array(mysql_query($gleader));
$top = mysql_query("SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$row[arenateamid]'");
$toprow = mysql_fetch_array($top);
if ($a<=100)
$a=$a+1;
 
if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){
   
 
 	$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";
	}else{
	$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}

	
 $whosonline3 .=' 
<tr> 
     <td width="200">'.$a.'</td>
 <td width="200">'.$faction.'</td>	 
    <td width="200">'.$row['name'].'</td>  
   <td width="200">'.$toprow['rating'].'</td>  
     </tr>';  
} }
$whosonline3 .="
</tbody></table>
";
// Arena Stats
?>	
<?php
$box_wide->setVar("content_title", "Statistics");	
$box_wide->setVar("content", $whosonline. $whosonline2. $whosonline3);
print $box_wide->toString();		
?>	
<?php
include "top.php";
?>