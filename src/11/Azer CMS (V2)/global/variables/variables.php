<?php
#- Azer CMS V1.5 Functions & Variables -#
  //Mysql_query Function
  $query = "mysql_query";
  //Mysql_num_rows Function
  $num = "mysql_num_rows";
  //Mysql_fetch_array Function
  $array = "mysql_fetch_array";
  //Mysql_fetch_array Function
  $assoc = "mysql_fetch_assoc";
  //Mysql_fetch_row Function
  $row = "Mysql_fetch_row";
  //Cap First Letter Function
  $cap = "ucfirst";
  //Mysql COnnect Function
  $connect = "mysql_connect";

#- Cleaning Functions -#
$_CLEAN = preg_replace("/[^A-Za-z0-9]/", "", $_POST);
$_STRIP_1 = "mysql_real_escape_string";
$_STRIP_2 = "stripslashes";
$_STRIP_3 = "htmlentities";

#- Logged In ? -#
function logged($val)
{
  global $login;
  
  //Before Clean
  $before = array('/\{login\=(.*?)\}(.*?)\{\/login\}/is', );
  
  if($login)
  {
    //After Clean       
    $after = array('$1',);
  }
  else
  {
    //After Clean       
    $after = array('$2',);
  }
  //Clean it
  $val = preg_replace ($before, $after, $val);
  return $val;
}

function aly($race)
{
  $aly = array("[1-1]", "[3-3]", "[4-4]", "[7-7]", "[11-11]", "[22-22]",);
	$race = str_replace($aly, "aly", $race);
	return $race;
}

function horde($race)
{
  $horde = array("[2-2]", "[5-5]", "[6-6]", "[8-8]", "[9-9]", "[10-10]",);
	$race = str_replace($horde, "horde", $race);
	return $race;
}
?>