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
?>