<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
  <head>
    <!--Html By Azer, Copyright 2011 Azer Cms. All Rights Reserved.-->
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/main.css" />
    <script type="text/javascript" src="./js/menu.js"></script>
    <script type="text/javascript" src="./js/interface.js"></script> 
    <script type="text/javascript" src="./js/jquery.js"></script> 
    <script type="text/javascript" src="./js/jquery.min.js"></script>
  </head>
<body>

<div class="top-bar">

<div id="logo">

<div class="logo" OnClick="location.href='./'" title="Acp Home">
</div>

</div>

</div>

<div class="bar">
<form action="" method="post">
<div id="bar">
Welcome <?php echo $login; ?>,<input type="submit" class="logout" name="logout" value="[Logout]">
</div>
</form>
</div>

<div class="body">

<table id="body" cellspacing="0px" cellpadding="0px">
<tr>
<td valign="top">

<div class="left-top" onclick="return toggleMe('main_links')"><table><tr><td><img src="./images/links.png" border="none" width="20" height="20"></td><td>Main Links</td></tr></table></div>
<div class="left-body">
<div id="main_links" style="display:none">
<ul>
<li><a href="./?page=home">Acp Home</a></li>
<li><a href="../" target="BLANK">View Site</a></li>
</ul>
</div>
</div>

<div class="left-top" onclick="return toggleMe('site_managment')"><table><tr><td><img src="./images/site.png" border="none" width="20" height="20"></td><td>Site Managment</td></tr></table></div>
<div class="left-body">
<div id="site_managment" style="display:none">
<ul>
<li><a href="?page=manage_news">Manage News</a></li>
<li><a href="?page=manage_styles">Manage Styles</a></li>
<li><a href="?page=manage_shoutbox">Manage ShoutBox</a></li>
<li><a href="?page=manage_sites">Manage Vote Sites</a></li>
<li><a href="?page=manage_store">Manage Item Store</a></li>
</ul>
</div>
</div>

<div class="left-top" onclick="return toggleMe('forum_managment')"><table><tr><td><img src="./images/forum.png" border="none" width="20" height="20"></td><td>Forum Managment</td></tr></table></div>
<div class="left-body">
<div id="forum_managment" style="display:none">
<ul>
<li><a href="?page=forum">Forum Properties</a></li>
</ul>
</div>
</div>

<div class="left-top" onclick="return toggleMe('server_managment')"><table><tr><td><img src="./images/pc.png" border="none" width="20" height="20"></td><td>Server Managment</td></tr></table></div>
<div class="left-body">
<div id="server_managment" style="display:none">
<ul>
<li><a href="?page=manage_accounts">Manage Accounts</a></li>
<li><a href="?page=manage_access">Manage Access</a></li>
<li><a href="?page=manage_characters">Manage Characters</a></li>
<li><a href="?page=manage_realms">Manage Realms</a></li>
</ul>
</div>
</div>

<div class="left-top" onclick="return toggleMe('global_logs')"><table><tr><td><img src="./images/logs.png" border="none" width="20" height="20"></td><td>Global Logs</td></tr></table></div>
<div class="left-body">
<div id="global_logs" style="display:none">
<ul>
<li><a href="?page=login">View Login Logs</a></li>
<li><a href="?page=vote_log">View Vote Logs</a></li>
<li><a href="?page=vip_log">View V.I.P Logs</a></li>
<li><a href="?page=store_log">View Store Logs</a></li>
</ul>
</div>
</div>

<div class="left-top" onclick="return toggleMe('website_info')"><table><tr><td><img src="./images/info.png" border="none" width="20" height="20"></td><td>Website Info</td></tr></table></div>
<div class="left-body">
<div id="website_info" style="display:none">
<ul>
<li><a href="?page=about">About Cms</a></li>
<li><a href="?page=support">Tech Support</a></li>
</ul>
</div>
</div>

</td>
<!---->
<td valign="top">

<div class="main">
<div style="padding:15px;">

<?php
if(!isset($_GET['page']))
{
  header("Location: ./?page=home");
}

if(isset($_GET['page']))
{
  $page = $_GET['page'];
  
  if(file_exists("./pages/$page.php"))
  {
    include("./pages/$page.php");
  }
  else
  {
    echo"The page requested does not exists.<br/> Location: ./pages/{$page}.php";
  }
}
?>

</div>
</div>

</td>
</tr>
</table>
<center><br/>&copy; Copyright <?php echo date("Y"); ?> Azer CMS.<br/>
All Rights Reserved.</center>
</div>

</body>
</html>