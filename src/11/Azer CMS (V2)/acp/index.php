<?php 
include("../global/config/config.php");

if (!isset($_SESSION)) 
{
  session_start();
}

//Set Date
date_default_timezone_set('US/Pacific');
$date = date("l F d, Y @ g:i A");

//Mysql_Connect & Set Login
$connect = mysql_connect("$host", "$user", "$pass") or die(mysql_error());

//Declare Variable Session
$login = "";

if(isset($_SESSION['acp']))
{
  $login = $_SESSION['acp'];
}

if(isset($_SESSION['acp']))
{
  include("./inc/lib.php");
  include("./inc/functions.php");
  include("./home/index.php");
}
else
{
  include("./inc/lib.php");
  include("./inc/login.php");
  include("./login/index.php");
}
?>