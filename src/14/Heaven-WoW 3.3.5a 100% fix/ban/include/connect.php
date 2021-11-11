<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include('config.php');
mysql_connect("$host","$user","$pass") or die (mysql_error("Could not connect to MySQL server"));
?>