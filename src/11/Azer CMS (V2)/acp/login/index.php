<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
  <head>
    <!--Html By Azer, Copyright 2011 Azer Cms. All Rights Reserved.-->
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/login.css" />
  </head>
<body>

<div class="logo">Azer Cms Acp</div>

<div class="body">

<table align="center" id="tl">
<tr>
<td>
<table align="center">
<form action="" method="post">
<tr><td>Username:</td> <td><input type="text" name="username" id="login" AUTOCOMPLETE="off"></td></tr>
<tr><td>Password:</td> <td><input type="password" name="password" id="login"></td></tr>
<tr><td>Staff-Id:</td> <td><input type="password" name="sid" id="login"></td></tr>
</table>
</td>
<td><input type="submit" name="login" id="log" value="Login"></td></tr>
</form>
</table>

<div class="info">

<table width="100%" id="ci">
<tr>
<td align="left">Ip Address: <b><?php print $_SERVER['REMOTE_ADDR']; ?></b></td>
<td align="right">Core: <input type="submit" value="Azer Cms" id="acms" OnClick="location.href='#'"></td>
</tr>
</table>
</div>
<?php login(); ?>
</body>
</html>