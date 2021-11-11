<?php
require("config.php");
require("config_onebip.php"); 

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

function logPayment($text)
{
	global $PDO, $onebip_config, $_REQUEST;

	$payment_id = $_REQUEST['payment_id'];
	$country = $_REQUEST['country'];
	$currency = $_REQUEST['currency'];
	$price = $_REQUEST['price'];
	$tax = $_REQUEST['tax'];
	$commission = $_REQUEST['commission'];
	$amount = $_REQUEST['amount'];
	$original_price = $_REQUEST['original_price'];
	$original_currency = $_REQUEST['original_currency'];
	
	$onebip_user = $_REQUEST['user_id'];

	// Your internal transaction ID and item code, if you use them:
	$remote_txid = $_REQUEST['remote_txid'];
	$item_code = $_REQUEST['item_code'];
	
	$accLogin = $_REQUEST['account'];

	$res2 = $PDO->prepare("INSERT INTO `onebip_data` (payment_id, onebip_user, item_code, login, country, currency, price, tax, commission, amount, original_price, original_currency, comment) VALUES (:payment_id, :onebip_user, :item_code, :login, :country, :currency, :price, :tax, :commission, :amount, :original_price, :original_currency, :comment)");
	$res2->bindParam(':payment_id', $payment_id, PDO::PARAM_STR);
	$res2->bindParam(':onebip_user', $onebip_user, PDO::PARAM_STR);
	$res2->bindParam(':item_code', $item_code, PDO::PARAM_INT);
	$res2->bindParam(':login', $accLogin, PDO::PARAM_STR);
	$res2->bindParam(':country', $country, PDO::PARAM_STR);
	$res2->bindParam(':currency', $currency, PDO::PARAM_STR);
	$res2->bindParam(':price', $price, PDO::PARAM_INT);
	$res2->bindParam(':tax', $tax, PDO::PARAM_INT);
	$res2->bindParam(':commission', $commission, PDO::PARAM_INT);
	$res2->bindParam(':amount', $amount, PDO::PARAM_INT);
	$res2->bindParam(':original_price', $original_price, PDO::PARAM_INT);
	$res2->bindParam(':original_currency', $original_currency, PDO::PARAM_STR);
	$res2->bindParam(':comment', $text, PDO::PARAM_STR);
	$res2->execute() or print_r($res2->errorInfo());
	unset($res2);
}

function handlePayment()
{
	global $PDO, $ACC_PDO, $db_translation, $onebip_config, $_REQUEST;
		
	$payment_id = $_REQUEST['payment_id'];
	$country = $_REQUEST['country'];
	$currency = $_REQUEST['currency'];
	$price = $_REQUEST['price'];
	$tax = $_REQUEST['tax'];
	$commission = $_REQUEST['commission'];
	$amount = $_REQUEST['amount'];
	$original_price = $_REQUEST['original_price'];
	$original_currency = $_REQUEST['original_currency'];

	// Your internal transaction ID and item code, if you use them:
	$remote_txid = $_REQUEST['remote_txid'];
	$item_code = $_REQUEST['item_code'];

	$onebip_user = $_REQUEST['user_id'];
	
	$accLogin = $_REQUEST['account'];
	
	/*Prevent txnid recycling.*/ 
	$res = $PDO->prepare("SELECT payment_id FROM `onebip_data` WHERE `payment_id` = :txn");
	$res->bindParam(':txn', $payment_id, PDO::PARAM_STR);
	$res->execute() or print_r($res->errorInfo());
	
	if($res->rowCount() > 0)
	{
		logPayment('Failed, duplicate payment id.');
		echo 'ERROR: Duplicate payment id.';
		return false;
	}
	unset($res);

	/*Prevent user processing multiple requests at the same second.*/ 
	$res = $PDO->prepare("SELECT onebip_user FROM `onebip_data` WHERE `onebip_user` = :user AND `time` BETWEEN CURRENT_TIMESTAMP() AND CURRENT_TIMESTAMP() + INTERVAL 1 SECOND");
	$res->bindParam(':user', $onebip_user, PDO::PARAM_INT);
	$res->execute() or print_r($res->errorInfo());
	
	if($res->rowCount() > 0)
	{
		logPayment('Failed, trying to process more than one request from the same user in the same second.');
		echo 'ERROR: Hack attempt many requests in the same second.';
		return false;
	}
	unset($res);
	
	//check the hash
	if (isset($_REQUEST['hash']))
	{
    	$basename = basename($_SERVER['REQUEST_URI']);
    	$pos = strrpos($basename, "&hash");
    	$basename_without_hash = substr($basename, 0, $pos);    
    	$my_hash = md5($onebip_config['apiKey'] . $basename_without_hash);
    
		if ($my_hash != $_REQUEST['hash'])
		{
			logPayment('Failed, invalid hash code.');
        	echo "ERROR: Invalid hash code";
        	return false;     
    	}
	}
		
	/*log time*/
	$Info = "Successful transaction!<br>";
	
	/*select users points*/

	$res = $ACC_PDO->prepare("SELECT ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :acc LIMIT 1");
	$res->bindParam(':acc', $accLogin, PDO::PARAM_STR);
	$res->execute() or (print_r($res->errorInfo()));
			
	if ($res->rowCount() == 0)
	{
		$Info.='Invalid account. (accounts table) DB: "'.$acc_db.'". SQL: '."SELECT ".$db_translation['login']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']."=\'".$accLogin."\' LIMIT 1";
		logPayment($Info);
		echo 'ERROR: Website failure.';
		return false;
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
			$Info .= 'No additional data! (accounts_more table) DB: "'.$db_name.'". SQL: '."SELECT dp FROM accounts_more WHERE acc_login=\'".$query_a[$db_translation['login']]."\' LIMIT 1";
			logPayment($Info);
			echo 'ERROR: Website failure.';
			return false;
		}
		else
		{
			$query_b = $res2->fetch(PDO::FETCH_ASSOC);
			
			/*select current donation points*/
			/*add points, but compare moneydonated with itemcout*/
			if (!isset($onebip_config['products'][$item_code]))
			{
				$Info.='Hack attempt: invalid item_code.';
				logPayment($Info);
				echo 'ERROR: Detected hack attempt.';
				return false;
			}
			else
			{
				$update = $PDO->prepare("UPDATE `accounts_more` SET `dp` = :dp WHERE `acc_login` = :login LIMIT 1");
				$update->bindValue(':dp', ($query_b['dp'] + $onebip_config['products'][$item_code]['points']), PDO::PARAM_INT);
				$update->bindParam(':login', $accLogin, PDO::PARAM_STR);
				if ($update->execute())
				{
					$request = '';
					foreach($_REQUEST as $key => $value)
					{
						$key = urlencode(stripslashes($key));
						$value = urlencode(stripslashes($value));
						$request .= "&{$key}={$value}";
					}
					$Info.= 'Donation Points before update: ' . $query_b['dp'];
					$Info.= '<br>Donation Points after update: ' . ($query_b['dp'] + $onebip_config['products'][$item_code]['points']);
					$Info.= '<br>Query executed: '."UPDATE accounts_more SET dp=\'".($query_b['dp'] + $onebip_config['products'][$item_code]['points'])."\'  WHERE acc_login= \'". $query_a[$db_translation['login']]."\' LIMIT 1<br>Everyhing went successfully.<br>";
					logPayment($Info);
					return true;
				}
				else
				{
					$Info.='Query executed: '."UPDATE accounts_more SET dp=\'".($query_b['dp'] + $onebip_config['products'][$item_code]['points'])."\'  WHERE acc_login= \'". $query_a[$db_translation['login']]."\' LIMIT 1<br>Failed.";
					logPayment($Info);
					echo 'ERROR: Website failure.';
					return false;
				}
				unset($update);
			}
		}
	}
	unset($res);
}

if (!isset($_REQUEST['payment_id']) and !isset($_REQUEST['price']))
{
	die;
}

//debug
if ($onebip_config['debug'])
{
	ob_start();
}

if (handlePayment())
{
	echo 'OK';
}
else
{
	echo 'ERROR: Integration failure.';
}

//debug
if ($onebip_config['debug'])
{
	$txt = ob_get_contents();	
	@file_put_contents($onebip_config['debug_file'], $txt);
}

unset($ACC_PDO);
unset($PDO);