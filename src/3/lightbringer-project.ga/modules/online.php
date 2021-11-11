<div id="menu">
<ul>
<li><a href="./">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li><a href="accounts.wow">Account Manager</a> | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li class="active">Statistics | </li> <li><a href="about_us.wow">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
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
$whosonline = '<table>
      <tbody><tr>
        <td width="200" align="center"><a style="text-decoration: none;" title="Online" href="account.wow?i=online"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/online.png" bor="" der=""><br>Players Online</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Kills" href="account.wow?i=kills"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/kill.png" border=""><br>Kills</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Arena" href="account.wow?i=arena"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/honor.png" border=""><br>Arena Teams</a></td>
        <td width="200" align="center"><a style="text-decoration: none;" title="Stats" href="account.wow?i=stats"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/stats.png" border=""><br>Stats</a></td>
    </tr></tbody></table>			
	<table style="text-align: center; margin-top: 40px;" width="100%">
<tbody><tr height="30"><td><b>Name</b></td><td><b>Level</b></td><td><b>Race</b></td><td><b>Class</b></td></tr>
';
$get_online_char = mysql_query("SELECT * FROM characters WHERE online='1'");
while($g_o_c = mysql_fetch_array($get_online_char))
{
$whosonline .="
	<tr>
		<td width='200'> {$g_o_c['name']}</td>
		<td width='200'> {$g_o_c['level']}</td>
		<td width='200'> <img src='styles/".$style."/Images/race/{$g_o_c['race']}-{$g_o_c['gender']}.gif' title='Race' align='top'></td>
		<td width='200'> <img src='styles/".$style."/Images/class/{$g_o_c['class']}.gif' title='Class' align='top'></td>
	</tr>
";}
$whosonline .="
</tbody></table>
";
?>  
<?php
$box_wide->setVar("content_title", "Statistics");	
$box_wide->setVar("content", $whosonline);
print $box_wide->toString();							
?>	
<?php
include "top.php";
?>