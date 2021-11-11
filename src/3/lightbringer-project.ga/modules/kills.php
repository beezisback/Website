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


//
?>
<?php
mysql_select_db("$arena_top");
$a=0;
$result = mysql_query("SELECT `name`, `race`, `class`, `gender`, `level`, totalKills, totalHonorPoints FROM `characters` ORDER BY `totalKills` DESC LIMIT 100;");
$msg = mysql_num_rows($result);
 if (!$msg){ 
    $whosonline2= '<table>
      <tbody><tr>
        <td width="200" align="center"><a style="text-decoration: none;" title="Online" href="account.wow?i=online"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/online.png" bor="" der=""><br>Players Online</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Kills" href="account.wow?i=kills"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/kill.png" border=""><br>Kills</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Arena" href="account.wow?i=arena"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/honor.png" border=""><br>Arena Teams</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Stats" href="account.wow?i=stats"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/stats.png" border=""><br>Stats</a></td>
    </tr></tbody></table>		
			
	<table style="text-align: center; margin-top: 40px;" width="100%">
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Level</b></td><td><b>Race</b></td><td><b>HK\'s</b></td></tr>

<center><br />No TOP 100 HK s!</center>
<tbody></table>

';
}else{
$whosonline2= '<table>
      <tbody><tr>
        <td width="200" align="center"><a style="text-decoration: none;" title="Online" href="account.wow?i=online"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/online.png" bor="" der=""><br>Players Online</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Kills" href="account.wow?i=kills"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/kill.png" border=""><br>Kills</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Arena" href="account.wow?i=arena"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/honor.png" border=""><br>Arena Teams</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Stats" href="account.wow?i=stats"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/stats.png" border=""><br>Stats</a></td>
    </tr></tbody></table>		
			
	<table style="text-align: center; margin-top: 40px;" width="100%">
<tbody><tr height="30"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Level</b></td><td><b>Race</b></td><td><b>HK\'s</b></td></tr>
';
 while ($row = mysql_fetch_array ($result))
   {	  
if ($a<=100)
$a=$a+1;	  
      if($row['race']=="1" or $row['race']=="3" or $row['race']=="4" or $row['race']=="7" or  $row['race']=="11")
       {$faction = "<img src='styles/default/Images/aliance.gif' width='20' height='20' alt='Aliance'/>";}
       else{$faction = "<img src='styles/default/Images/horde.gif' width='20' height='20' alt='Horde'/>";}
   $whosonline .="
	
	<tr>
	    <td width='200'> ".$a."</td>
		<td width='200'> ".$row['name']."</td>
		<td width='200'> ".$row['level']."</td>
		<td width='200'> ".$faction."</td>
		<td width='200'> ".$row['totalKills']."</td>
	</tr>
";
   $whosonline3 .= "<tbody></table> ";
}}
?>
<?php
$box_wide->setVar("content_title", "Statistics");	
$box_wide->setVar("content", $whosonline2.$whosonline.$whosonline3);
print $box_wide->toString();							
?>	
<?php
include "top.php";
?>
