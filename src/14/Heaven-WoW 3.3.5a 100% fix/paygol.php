<?php 

// check that the request comes from PayGol server
if(!in_array($_SERVER['REMOTE_ADDR'],
  array('109.70.3.48', '109.70.3.146', '109.70.3.58'))) {
  header("HTTP/1.0 403 Forbidden");
  die("Error: Unknown IP");
} 

// You Should Write your MySQL Server information here  !
$dbhost = '127.0.0.1'; //Host adress 
$dbuser = 'root'; //Username 
$dbpass = 'nabilfahmiandra'; //Password 
$dbname = 'webwow'; // the name of your webwow database 

try 
{
	//Construct PDO
	$PDO = new PDO('mysql:dbname='.$dbname.'; host='.$dbhost.';', $dbuser, $dbpass, NULL);
	//set error handler exception
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
	//set default fetch method
	$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
	echo '<strong>Database Connection to the Web Database failed:</strong> ' . $e->getMessage();
	die;
}

//Get parameters from PayGol
$message_id	= $_GET['message_id'];
$shortcode	= $_GET['shortcode'];
$keyword	= $_GET['keyword'];
$message	= $_GET['message'];
$sender		= $_GET['sender'];
$operator	= $_GET['operator'];
$country	= $_GET['country'];
$price		= $_GET['price'];
$currency	= $_GET['currency'];
$custom		= $_GET['custom'];//character or username of the payer
$points     = $_GET['points'];//points to be inserted in DB

$res = $PDO->prepare("SELECT dp FROM `accounts_more` WHERE `acc_login` = :login LIMIT 1");
$res->bindParam(':login', $custom, PDO::PARAM_STR);
$res->execute();

if ($res->rowCount() > 0)
{
	$row = $res->fetch(PDO::FETCH_ASSOC);
	if ($row['dp'] == '')
	{
		$row['dp'] = 0;
	}
}
else
{
	$row = array('dp' => 0);
}
unset($res);

$update = $PDO->prepare("UPDATE `accounts_more` SET `dp` = :points WHERE `acc_login` = :login LIMIT 1");
$update->bindValue(':points', ($row['dp'] + $points), PDO::PARAM_INT);
$update->bindParam(':login', $custom, PDO::PARAM_STR);
$update->execute();

exit;
