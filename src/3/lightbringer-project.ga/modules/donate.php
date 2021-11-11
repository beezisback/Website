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

$whosonline='<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
</p><p style="clear: both;"></p>
	<table>
		<tbody><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Home" href="accounts.wow"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/home.png" border=""><br>Home</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Get Item" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/getitem.png" border=""><br>Get Item</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donate" href="account.wow?i=donate"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/donate.png" border=""><br>Donate</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Teleport" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/teleport.png" border=""><br>Teleport</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Unstucker" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/unstucker.png" border=""><br>Unstucker</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Vote" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/vote.png" border=""><br>Vote</a></td>
	</tr><tr height="20"></tr><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="SMS" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/sms.png" border=""><br>SMS</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Change" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/pass.png" border=""><br>Change Pass</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Transfer" href="#"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/transfer.png" border=""><br>Transfer</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Gold" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/gold.png" border=""><br>Gold</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Level" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/up.png" border=""><br>Level</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" target="hidd" title="Logout" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/logout.png" border=""><br>Logout</a></td>
	</tr>
</tbody></table>
<br />

'; 

$whosonline2='<center><p>Donation Pages Not available.</p></center>'; 
?>   
<?php
$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $whosonline.$whosonline2);
print $box_wide->toString();							
?>	
<?php
include "top.php";
?>