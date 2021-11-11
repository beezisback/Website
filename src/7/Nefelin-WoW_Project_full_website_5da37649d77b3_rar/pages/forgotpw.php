<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="/themes/cp_nefelin/css/animate.css" /> 
<link rel="stylesheet" type="text/css" href="/themes/cp_nefelin/css/style.css" /> 
<link rel="stylesheet" type="text/css" href="/themes/cp_nefelin/css/armory.css" /> 
<link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>
</head>

<body class="home">
<div class="wrapper">
<header id="header">
<div class="container">
<nav class="navbar clearfix" role="navigation">
<div class="languages wow lightSpeedIn">
<div class="caret"></div>
<a class="en active" href="#"></a><a class="ru" href="#"></a>
</div>
<ul class="nav navbar-nav clearfix wow flip" style="display:inline !important;">
<li style="display:inline"><a href="./">Site</a></li>
<li><a href="#" target="_blank">Forum</a></li>
</ul>
<div class="brand">
<a class="logo" href="https://cp.elysium-project.org/main/main">
<img class="logo-desktop wow swing" role="banner" src="/themes/cp_nefelin/images/logo.png" alt="logo" /> <img class="logo-mobile" role="banner" src="/themes/cp_ely/images/logo-small.png" alt="logo" /> </a>
</div>
<ul class="nav navbar-user clearfix wow flip">
</ul>
</nav>
</div>
<div class="container">
<div class="row">
<ul class="navbar-cp">
<li class="disable-link">
<a href="">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-01.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-01.png" alt="" /> </div>
<p>Account</p>
</a>
</li>
<li class="disable-link">
<a href="#">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-02.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-02.png" alt="" /> </div>
<p>Shop</p>
</a>
</li>
<li class="disable-link">
<a href="#">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-03.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-03.png" alt="" /> </div>
<p>Buy coins</p>
</a>
</li>
<li class="disable-link">
<a href="#">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-04.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-04.png" alt="" /> </div>
<p>Characters</p>
</a>
</li>
<li class="disable-link">
<a href="#">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-05.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-05.png" alt="" /> </div>
<p>Find character</p>
</a>
</li>
<li class="disable-link">
<a href="#">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-06.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-06.png" alt="" /> </div>
<p>Statistics</p>
</a>
</li>
<li class="disable-link">
<a href="#">
<div class="nav-img">
<img src="/themes/cp_nefelin/images/cp-nav-07.png" alt="" /> <img class="hov" src="/themes/cp_nefelin/images/cp-nav-hov-07.png" alt="" /> </div>
<p>Vote</p>
</a>
</li>
</ul>
</div>
</div>
</header>
<main id="content-wrapper">
<div class="container">
<div class="row">
<div class="column">
<div class="head-content">
<div class="breadcrumbs">
<a href="#">
Control Panel </a>
<span class="ico-raquo"></span>
</div>
<div class="realm_picker">
<div class="">
Actual realm: </div>
<a href="#">
Nefelin-WoW </a>
</div>
</div>
<div class="content-box main">
<div class="content-holder">
<div class="content-frame">
<div class="content">
<h2>Password recovery</h2>
<p></p>

<div class="row">
To reset your password, please type your username & the Email address you registered with. An email will be sent to you, containing a link to reset your password. <br/><br/>
<form action="?p=forgotpw" method="post">
<?php 
account::isLoggedIn();
if (isset($_POST['forgotpw'])) 
	account::forgotPW($_POST['forgot_username'],$_POST['forgot_email']);

if(isset($_GET['code']) || isset($_GET['account'])) {
 if (!isset($_GET['code']) || !isset($_GET['account']))
	 echo "<b class='red_text'>Link error, one or more required values are missing.</b>";
 else 
 {
	 connect::selectDB('webdb');
	 $code = mysql_real_escape_string($_GET['code']); $account = mysql_real_escape_string($_GET['account']);
	 $result = mysql_query("SELECT COUNT('id') FROM password_reset WHERE code='".$code."' AND account_id='".$account."'");
	 if (mysql_result($result,0)==0)
		 echo "<b class='red_text'>The values specified does not match the ones in the database.</b>";
	 else 
	 {
		 $newPass = RandomString();
		 echo "<b class='yellow_text'>Your new password is: ".$newPass." <br/><br/>Please sign in and change your password.</b>";
		 mysql_query("DELETE FROM password_reset WHERE account_id = '".$account."'");
		 $account_name = account::getAccountName($account);
		 
		 account::changePassword($account_name,$newPass);
		 
		 $ignoreForgotForm = true;
	 }
 }
}
if (!isset($ignoreForgotForm)) { ?> 

<table width="80%">
    <tr>
         <td align="right">Username:</td> 
         <td><input type="text" name="forgot_username" /></td>
    </tr>
    <tr>
         <td align="right">Email:</td> 
         <td><input type="text" name="forgot_email" /></td>
    </tr>
    <tr>
         <td></td>
         <td><hr/></td>
    </tr>
    <tr>
         <td></td>
         <td><input type="submit" class="btn btn-yellow indent" value="Send to E-mail" name="forgotpw" /></td>
    </tr>
</table>
</form> 
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
</div>

<footer id="footer">
<div class="container">
<div class="row clearfix">
<div class="column">
<div id="footer-copy" class="wow fadeInUp">
&copy; 2018 - 2019 <br />
<a href="./">Nefelin-WoW Project, WoTlk Legacy Server</a> 
<a class="legals" href="">Contact us - About us</a> 
<a class="legals" href="">Refund policy / private policy</a> 
</div></div></div></div>
</div>
</div>
</div>
</footer>
<script type="text/javascript" src="/themes/nefelin/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/themes/nefelin/js/custom.js"></script>