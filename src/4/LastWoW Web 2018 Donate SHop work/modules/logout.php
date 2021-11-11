<div id="menu">
<ul>
<li><a href="./">News | </li> <li><a href="quest.php?name=register">Register Account</a> | </li>  <li class="active">Account Manager | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="quest.php?name=statistics">Statistics</a> | </li> <li><a href="about_us.wow">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
<?php
if (!defined('AXE'))
	exit;

//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include
if (!$a_user['is_guest']) 
{

$cont2= "Logging out failed, Please delete all cookies and sessions or try go to index page and then click on 'Logout'.";
}
else
{
	
	$cont2= "<font size='4'>You are now logged out.</font><meta http-equiv='refresh' content='0;url=accounts.wow'/>";
}
$box_wide->setVar("content_title", "Logout");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();

?>
<?php
include "top.php";
?>