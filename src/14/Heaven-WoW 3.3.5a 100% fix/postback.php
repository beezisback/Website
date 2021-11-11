<?php
require("config.php");
require("config_paypal.php"); 

if ($server_core=='')
	$server_core='ascent';
	
require_once './include/core/'.$server_core.'.php';

if(function_exists("date_default_timezone_set") and function_exists("date_default_timezone_get"))
	@date_default_timezone_set(@date_default_timezone_get());
	
set_time_limit(15);

//setup the PDO to the web database
try 
{
	//Construct PDO
	$PDO = new PDO('mysql:dbname='.$db_name.'; host='.$db_host.';', $db_user, $db_pass, NULL);
	//set error handler exception
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
	//set default fetch method
	$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	//set encoding
	$PDO->query("SET NAMES '".$db_encoding."'");
}
catch (PDOException $e)
{
	echo '<strong>Database Connection to the Web Database failed:</strong> ' . $e->getMessage();
	die;
}

//acc database
try 
{
	//Construct PDO
	$ACC_PDO = new PDO('mysql:dbname='.$acc_db.'; host='.$db_host.';', $db_user, $db_pass, NULL);
	//set error handler exception
	$ACC_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
	//set default fetch method
	$ACC_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	//set encoding
	$ACC_PDO->query("SET NAMES '".$db_encoding."'");
}
catch (PDOException $e)
{
	echo '<strong>Database Connection to the Account Database failed:</strong> ' . $e->getMessage();
	die;
}

function handlePayment()
{
	global $PDO, $ACC_PDO, $db_translation, $_POST;
		
	$Itemcount = ceil($_POST['quantity']);
	$accLogin = $_POST['item_number'];
	$Money = (float)$_POST['mc_gross'];
	$txn_id = $_POST['txn_id'];
	
	/*Prevent txnid recycling.*/ 
	$res = $PDO->prepare("SELECT txnid FROM `paypal_data` WHERE `txnid` = :txn");
	$res->bindParam(':txn', $txn_id, PDO::PARAM_INT);
	$res->execute() or print_r($res->errorInfo());
	
	if($res->rowCount() > 0)
	{
		$res2 = $PDO->prepare("INSERT INTO `paypal_data` (login, txnid, amount, who, whendon, comment) VALUES (:login, :txn, :money, :who, :when, 'Fail: This transaction id is a duplicate.')");
		$res2->bindParam(':login', $accLogin, PDO::PARAM_STR);
		$res2->bindParam(':txn', $txn_id, PDO::PARAM_STR);
		$res2->bindParam(':money', $Money, PDO::PARAM_STR);
		$res2->bindParam(':who', $_POST['payer_email'], PDO::PARAM_STR);
		$res2->bindParam(':when', date("U"), PDO::PARAM_STR);
		$res2->execute() or print_r($res2->errorInfo());
		unset($res2);
		return;
	}
	unset($res);
	
	/*Check payment status.*/
	if($_POST['payment_status'] != "Completed")
	{
		$res2 = $PDO->prepare("INSERT INTO `paypal_data` (login, txnid, amount, who, whendon, comment) VALUES (:login, :txn, :money, :who, :when, '<span class=\"colorbad\">Fail:</span> This transaction is not completed but ".$_POST['payment_status'].".')");
		$res2->bindParam(':login', $accLogin, PDO::PARAM_STR);
		$res2->bindParam(':txn', $txn_id, PDO::PARAM_STR);
		$res2->bindParam(':money', $Money, PDO::PARAM_STR);
		$res2->bindParam(':who', $_POST['payer_email'], PDO::PARAM_STR);
		$res2->bindParam(':when', date("U"), PDO::PARAM_STR);
		$res2->execute() or print_r($res2->errorInfo());
		unset($res2);
		return;
	}
	
	/*log time*/
	$Info = "<span class=\"colorgood\">Successful transaction!</span>";
	
	/*select users points*/
	$res = $ACC_PDO->prepare("SELECT ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :acc LIMIT 1");
	$res->bindParam(':acc', $accLogin, PDO::PARAM_STR);
	$res->execute() or (print_r($res->errorInfo()));
			
	if ($res->rowCount() == 0)
	{
		$Info.='<br><span class=\"colorbad\">Invalid account. (accounts table) DB: "'.$acc_db.'". SQL: '."SELECT ".$db_translation['login']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']."=\'".$accLogin."\' LIMIT 1</span>";
	}
	else
	{
		$query_a = $res->fetch(PDO::FETCH_ASSOC);
				
		/*select current donation points*/
		$res2 = $PDO->prepare("SELECT dp FROM `accounts_more` WHERE `acc_login` = :acc LIMIT 1");
		$res2->bindParam(':acc', $query_a[$db_translation['login']], PDO::PARAM_STR);
		$res2->execute() or print_r($res2->errorInfo());

		if ($res2->rowCount() == 0)
		{
			$Info .= '<br><span class=\"colorbad\">No additional data! (accounts_more table) DB: "'.$db_name.'". SQL: '."SELECT dp FROM accounts_more WHERE acc_login=\'".$query_a[$db_translation['login']]."\' LIMIT 1</span>";
		}
		else
		{
			$query_b = $res2->fetch(PDO::FETCH_ASSOC);
			
			/*select current donation points*/
			/*add points, but compare moneydonated with itemcout*/
			if ($Money<>$Itemcount)
			{
				$Info.='<br><span class=\"colorbad\">Hack attempt:</span> Money donated ('.$Money.') is not equal to number of items ('.$Itemcount.')';
			}
			else
			{
				$update = $PDO->prepare("UPDATE `accounts_more` SET `dp` = :dp WHERE `acc_login` = :login LIMIT 1");
				$update->bindValue(':dp', ($query_b['dp']+$Itemcount), PDO::PARAM_INT);
				$update->bindParam(':login', $accLogin, PDO::PARAM_STR);
				if ($update->execute())
				{		
					$Info.='<br>Query executed: '."UPDATE accounts_more SET dp=\'".($query_b['dp']+$Itemcount)."\'  WHERE acc_login= \'". $query_a[$db_translation['login']]."\' LIMIT 1<br>Everyhing went successfully.";
				}
				else
				{
					$Info.='<br>Query executed: '."UPDATE accounts_more SET dp=\'".($query_b['dp']+$Itemcount)."\'  WHERE acc_login= \'". $query_a[$db_translation['login']]."\' LIMIT 1<br>Failed.";
				}
				unset($update);
			}
		}
	}
	unset($res);
		
	/*finally add to log*/
	$res = $PDO->prepare("INSERT INTO `paypal_data` (login, txnid, amount, who, whendon, comment) VALUES (:login, :txn, :money, :who, :when, :info)");
	$res->bindParam(':login', $accLogin, PDO::PARAM_STR);
	$res->bindParam(':txn', $txn_id, PDO::PARAM_STR);
	$res->bindParam(':money', $Money, PDO::PARAM_STR);
	$res->bindValue(':who', $Itemcount . '[|]' . $_POST['payer_email'], PDO::PARAM_STR);
	$res->bindParam(':when', date("U"), PDO::PARAM_STR);
	$res->bindParam(':info', $Info, PDO::PARAM_STR);
	$res->execute() or print_r($res->errorInfo());
	
	unset($res);
}

function handleInvalidPayment($sslSupport = false)
{
	global $PDO, $_POST;
	
	$Info = "";
	foreach($_POST as $key => $value)
	{
		$Info .= "{$key} = {$value} <br>\n";
	}
	
	$insert = $PDO->prepare("INSERT INTO `paypal_data` (whendon, comment) VALUES (:when, :info)");
	$insert->bindParam(':when', date("U"), PDO::PARAM_STR);
	if ($sslSupport)
	{
		$insert->bindValue(':info', 'Failed to verify paypal payment.Please enable OpenSSL on your webserver, its an PHP Extension.', PDO::PARAM_STR);
	}
	else
	{
		$insert->bindValue(':info', 'An invalid request was made. Postdata info:<br>\n' . $Info, PDO::PARAM_STR);
	}
	$insert->execute() or print_r($insert->errorInfo());
	unset($insert);
}

function verifyPayment()
{
	global $paypalurl, $_POST;
	
	if(sizeof($_POST) == 0)
	{
		/*dont bother, maybe an accidental page visit.*/
		?>
        <h1>Restricted Area</h1>
        <p>You are not permitted to access this page.</p>
		<?php
        return;
	}
	
	$Postback = "cmd=_notify-validate";
	/*test_file($Postback);*/
	foreach($_POST as $key => $value)
	{
		$key = urlencode(stripslashes($key));
		$value = urlencode(stripslashes($value));
		$Postback .= "&{$key}={$value}";
	}
	
	//SSL
	//$Sock = fsockopen ('ssl://'.$paypalurl, 443, $errno, $errstr, 30);
	//HTTPS
	//$Sock = fsockopen($paypalurl, 443, $errno, $errstr, 30);
	//HTTP
	$Sock = fsockopen($paypalurl, 80, $errno, $errstr, 30);
		
	if(!$Sock)
	{
		echo 'invalid';
		handleInvalidPayment(true);
	}
	else
	{
		$Head .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$Head .= "Content-type: application/x-www-form-urlencoded\r\n";
		$Head .= "Content-length: ".strlen($Postback)."\r\n\r\n";
		//fputs($Sock,$Head.$Postback,strlen($Head.$Postback));
		fputs ($Sock, $Head.$Postback);
		
		while (!feof($Sock))
		{
			$txt = fgets($Sock, 1024);
			echo $txt;
			if(strcmp($txt,"VERIFIED") == 0)
			{
				echo 'ver';
				handlePayment();
			}
			elseif(strcmp($txt,"INVALID") == 0)
			{
				echo 'invalid';
				handleInvalidPayment();
			}
		}
	}
	fclose($Sock);
}

verifyPayment();

unset($ACC_PDO);
unset($PDO);