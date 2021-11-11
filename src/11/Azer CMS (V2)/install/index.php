<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">



<head>



<!--Html By Azer, Copyright 2011 Azer Cms. All Rights Reserved.-->



<title>Azer Cms &bull; ACP</title>



<link rel="shortcut icon" href="./images/favicon.ico" /> 

<link rel="stylesheet" type="text/css" href="./install/css/main.css" />



</head>



<body>



<div class="top-bar">



<div id="logo">

<div class="logo">

</div>
</div>


</div>



<div class="bar">

<div id="bar">

</div>
</div>



<div class="body">

<table id="body" cellspacing="0px" cellpadding="0px">

<tr>

<td valign="top">

<div class="left-top"><table><tr><td><img src="./install/images/links.png" border="none" width="20" height="20"></td><td>Menu</td></tr></table></div>

<div class="left-body"><ul>

<li><a href="./">Home</a></li>
<li><a href="?action=install">Install</a></li>

</ul></div>

</td>

<td valign="top"><div class="main">
<div style="padding:15px;">
<?php
$page="";
if(isset($_GET['action'])){$page = $_GET['action'];}
if($page == "install"){
include('./install/install.php');
}else{
print'<b>Welcome to Azer CMS, the furture CMS for your World Of Warcraft Website. To begin, select install on the menu, and follow the on screen instructions. Azer CMS V1.5, once installed will have the following features:</b>
<ul>
<li>Admin Control Panel V2.0.</li>
<li>TrinityCore Support.</li>
<li>Partial Cata Support.</li>
<li>Manage News.</li>
<li>Manage ShoutBox.</li>
<li>Manage Item Store.</li>
<li>Manage Accounts.</li>
<li>Manage Account Game Access.</li>
<li>Manage Characters.</li>
<li>Multi-Realm Support.</li>
<li>Manage Realms.</li>
<li>Manage Styles.</li>
<li>Login Logs.</li>
<li>Vote Logs.</li>
<li>V.I.p Logs.</li>
<li>News System.</li>
<li>ShoutBox.</li>
<li>Register Page.</li>
<li>Forgot Password.</li>
<li>Realm Status.</li>
<li>How To Connect Page.</li>
<li>Character Unstuck.</li>
<li>Character Revive.</li>
<li>Vote Panel/Shop.</li>
<li>V.I.P Panel/Shop.</li>
<li>Online Players.</li>
<li>Top 10 Slayer List.</li>
<li>Phpbb3 Register Bridge.</li>
<li>Terms Of Service.</li>
</ul>';}
?>
</div></div>
</div>
</body>
</html>