<?php
include "../config.php";

$id = (int)$_GET['id']; //only numbers

function test_serv($port)
{
	global $server;
	$s = @fsockopen($server, $port, $ERROR_NO, $ERROR_STR, 0.5);
	if($s)
	{
		@fclose($s);
		return true;
	} else return false;
}
	
if (test_serv($realm[$id]['port']))
echo "<div class='online_s'></div>";
else
echo "<div class='offline_s'></div>";


