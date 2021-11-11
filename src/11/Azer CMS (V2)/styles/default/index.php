<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
<!--Html By Azer, Copyright 2011 Azer Cms. All Rights Reserved.-->
<title>{title}</title>
<link rel="shortcut icon" href="./images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="./styles/default/css/main.css" />
<script type="text/javascript" src="./global/js/store.js"></script>
</head>
<body>
<div class="menu">
<input type="submit" id="left" value="Home" OnClick="location.href='./'">
{login=<input type="submit" id="mid" value="Account" OnClick="location.href='?page=account'">}
<input type="submit" id="mid" value="Register" OnClick="location.href='?page=register'">
{/login}
<input type="submit" id="mid" value="Connect" OnClick="location.href='?page=connect'">
<input type="submit" id="mid" value="Forums" OnClick="location.href='#'">
<input type="submit" id="mid" value="Vote" OnClick="location.href='?page=vote'">
<input type="submit" id="mid" value="Donate" OnClick="location.href='?page=donate'">
{login=<input type="submit" id="mid" value="Store" OnClick="location.href='?page=store'">}
{/login}
</div>
<div class="body">
<br/>
<table width="100%" align="center" class="main">
<tr>
<td valign="top" id="main">
{news_pages}
</td>
<td valign="top">
<!---->
<div class="right-hand"><div class="membership">Membership</div></div>
<div class="right-mid">
<div class="right-pad">
{login=<div style="margin-left:5px;">
{user_get}
Welcome, <font color="#90cf5d">{session}</font> - [<a href="?page=logout">Logout</a>]<br/>
Account Id: {user_get.id}<br/>
Join Date: {user_get.joindate}<br/>
Site Rank: {user_admin}<br/>
Current Ip: {user_curip}<br/>
Last Ip: {user_get.last_ip}<br/>
Email: {user_get.email}<br/>
Expansion: {user_get.expansion}<br/>
Banned: {banned}<br/>
Vote Points: {user_get.vp}<br/>
V.I.P Points:  {user_get.dp}<br/>
{/user_get}
</div>}
<table><form action="" method="post">
<tr>
<td><table>
<tr><td><input type="text" name="username" value="Username" id="login" onfocus='if (this.value == "Username") this.value = "";' onblur='if (!this.value){ this.value = "Username"; }'></td></tr>
<tr><td><input type="password" name="password" value="Password" id="login" onfocus='if (this.value == "Password") this.value = "";' onblur='if (!this.value){ this.value = "Password"; }'></td></tr>
<tr><td></td></tr>
</table></td>
<td><input type="submit" name="login" value="Login" class="login"></td>
</tr>
<tr><td><a href="?page=forgot">Forgot Password?</a></td></tr>
<tr><td><a href="?page=register">Member's Registration</a></td></tr>
</form></table>
{log_in}
{/login}
</div></div>
<div class="right-foot"></div><br/>
<!---->
<div class="right-bar"><div class="left-space">Realm Status</div></div>
<div class="right-mid">
<div class="right-pad">
<!--Begin Realms-->
{view_realms}
<div style="margin-left:5px;">{realm_world} - <a href="?page=realm&id={view_realms.id}">{view_realms.name} | {view_realms.type}</a></div>
<div class="realm-1">
<div class="realm-2"></div>
<div style="width:{total_number}%; background:#1b1b1b; height:3px; border:1px solid #323232; border-right:1px solid black; float:left;"></div></div>
{/view_realms}
<!--End Realms-->
</div></div>
<div class="right-foot"></div><br/>
<!---->

<!---->
<div class="right-bar" id="shoutid"><div class="left-space">Shoutbox</div></div>
<div class="right-mid">
<div class="right-pad">
<table align="center"><form action="" method="post">
<tr><td><textarea class="shout" name="body"></textarea></td></tr>
<tr><td><input type="submit" name="shout" value="Shout" class="post-shout"> BBCode & Smilies: Enabled.</td></tr>
<tr><td><br/>
{post_shout}
<!--Shouts-->
{view_shouts}

{view_shouts.date}By <font color="#90cf5d">{view_shouts.author}</font>:<br/>
{view_shouts.body}
<br/><br/>

{/view_shouts}
{shout_url}
<!--End Shouts-->
</td></tr>
</form></table>
</div></div>
<div class="right-foot"></div><br/>
<!---->
</td>
</tr>
</table>
<div class="foot">
&copy; Copyright {copydate} {copyright}.<br/>
<a href="http://www.ac-web.org/forums/member.php?u=201329">Author</a> | <a href="http://azer-cms.info">Core</a> | <a href="?page=tos">Terms</a>
</div>
</div>