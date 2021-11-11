<?php

/************************
	CONSTANTS
/************************/
include "config.php";
require_once './include/dblayer/common_db.php';

if ($server_core=='')
	$server_core='trinity';
	
require_once './include/core/'.$server_core.'.php';


/************************
	FUNCTIONS
*******************************/

function getContent($num)
{
	global $WEB_PDO;
	
	$res = $WEB_PDO->query("SELECT date, user, message FROM shoutbox ORDER BY date DESC LIMIT ".$num);	
	if(!$res)
		die("Error: ".print_r($res->errorInfo()));
	else
		return $res;
}
function insertMessage($user, $message)
{
	global $WEB_PDO;

	$ip = $_SERVER['REMOTE_ADDR'];
	
	$res = $WEB_PDO->prepare("INSERT INTO shoutbox(user, message, ip) VALUES(:user, :message, :ip);");
	$res->bindParam(':user', $user, PDO::PARAM_STR);
	$res->bindParam(':message', $message, PDO::PARAM_STR);
	$res->bindParam(':ip', $ip, PDO::PARAM_STR);
	$res->execute();
	
	if(!$res)
		die("Error: ".print_r($res->errorInfo()));
	else
		return $res;
}

/******************************
	MANAGE REQUESTS
/******************************/
if(!isset($_POST['action']))
{
	//We are redirecting people to our shoutbox page if they try to enter in our shoutbox.php
	header ("Location: index.php"); 
}
else
{
	switch($_POST['action'])
	{
		case "update":
			$res = getContent(7);
			$result = '';
			while($row = $res->fetch(PDO::FETCH_ASSOC))
			{
				$res2 = $ACC_PDO->prepare("SELECT `".$db_translation['acct']."`, `".$db_translation['login']."` FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :user LIMIT 1");
				$res2->bindParam(':user', $row['user'], PDO::PARAM_STR);
				$res2->execute();
				
				$test4 = $res2->fetch(PDO::FETCH_ASSOC);
				unset($res2);
				
				$res2 = $ACC_PDO->prepare("SELECT * FROM `".$acc_db."`.`account_access` WHERE `RealmID` = '-1' AND `id` = :acc LIMIT 1");
				$res2->bindParam(':acc', $test4['id'], PDO::PARAM_INT);
				$res2->execute();
								
				if ($res2->rowCount() > 0)
				{
					$test2 = $res2->fetch(PDO::FETCH_ASSOC);
					
					if ($test2['gmlevel'] != NULL and $test2['gmlevel'] != '' and $test2['gmlevel'] != 0)
					{
						$result .= '<div class="sidebar_box">
										<div class="sidebar_box_cont">
											<strong><img src="images/hw.png" style="width: 20px;" />&nbsp;'.$row['user'].'</strong>
											<div class="sb_m_date">'.$row['date'].'</div>
										</div>
										<div class="sidebar_box_cont">
											<p><font color="#32506A">'.$row['message'].'</font></p>
										</div>
									</div>';
					}
					else
					{
						$result .= '<div class="sidebar_box">
										<div class="sidebar_box_cont">
											<strong>'.$row['user'].'</strong>
											<div class="sb_m_date">'.$row['date'].'</div>
										</div>
										<div class="sidebar_box_cont">
											<p>'.$row['message'].'</p>
										</div>
									</div>';
					}
				}
				else
				{
					$result .= '<div class="sidebar_box">
									<div class="sidebar_box_cont">
										<strong>'.$row['user'].'</strong>
										<div class="sb_m_date">'.$row['date'].'</div>
									</div>
									<div class="sidebar_box_cont">
										<p>'.$row['message'].'</p>
									</div>
								</div>';
				}
				unset($res2);
			}
			unset($res);
			echo $result;
			break;
		case "insert":
			echo insertMessage($_POST['nick'], $_POST['message']);
			break;
	}
}


?>