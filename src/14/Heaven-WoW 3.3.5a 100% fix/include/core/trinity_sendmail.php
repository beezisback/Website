<?php
/***********************************************************
*	Sendmail function for Ascent/Arcemu
*	by AXE
*   this file is required for all cores
************************************************************/

/***********************************************************
* 		 GLOBAL FUNCTIONS (required for all cores)
************************************************************/
function sendmail($playername, $playerguid, $subject, $text, $item, $shopid=0, $money=0, $realmid=false) //returns, IMPORTANT: do not remove <!-- success --> if success
{
	//send normal, item only 
	global $REALM_DB, $a_user, $db_translation;
	
	$item = (int)$item; //item id
	$playerguid = (int)$playerguid;
	$money = (int)$money;

	if ($item=='')//send item
		$item="0";
	if ($money=='')
		$money=0;
	
    $sendmail=false;
	
	$insert = $REALM_DB->prepare("INSERT INTO `mail_external` (sender, receiver, subject, message, money, stationery, sent) VALUES (:sender, :reciever, :subject, :message, :money, 0, 1)");
	$insert->bindParam(':sender', $playerguid, PDO::PARAM_INT);
	$insert->bindParam(':reciever', $playerguid, PDO::PARAM_INT);
	$insert->bindParam(':subject', $subject, PDO::PARAM_STR);
	$insert->bindParam(':message', $text, PDO::PARAM_STR);
	$insert->bindParam(':money', $money, PDO::PARAM_INT);
	$insert->execute() or ($sendmail = $insert->errorInfo());
		
	if($sendmail == false and $insert->rowCount() > 0)
	{
		$mail_id = $REALM_DB->lastInsertId();
		
		$res = $REALM_DB->prepare("INSERT INTO `mail_external_items` (mail_id, item) VALUES (:mailid, :item)");
		$res->bindParam(':mailid', $mail_id, PDO::PARAM_INT);
		$res->bindParam(':item', $item, PDO::PARAM_STR);
		$res->execute()  or ($sendmail = $res->errorInfo());
		unset($res);
	}
	unset($insert);
	
	if($sendmail == false)
	{
		return  "<!-- success --><span class=\"colorgood\">Mail is sent! <br>All done!</span>";
	}
	else
	{
		return  "<span class=\"colorbad\">Mail is not sent! Error returned: ".$sendmail."<br>".$query_string;
	}
}

function sendmail_secondpatch($playername,$playerguid, $subject, $text, $item, $shopid=0, $money=0, $realmid=false) //returns, IMPORTANT: do not remove <!-- success --> if success
{
	//send normal, item only 
	global $db, $a_user, $db_translation;
	
	$item = (int)$item; //item id
	$playerguid = (int)$playerguid;
	$money = (int)$money;
	
	if ($item=='')//send item
		$item="0";
	if ($money=='')
		$money=0;
	
	if ($realmid)
	{
		$REALM_DB = newRealmPDO($realmid);	
		
		if ($REALM_DB)
		{
        	$sendmail=false;
		
			$insert = $REALM_DB->prepare("INSERT INTO `mail_external` (receiver, subject, message, money, item, item_count) VALUES (:reciever, :subject, :message, :money, :item, :item_count)");
			$insert->bindParam(':reciever', $playerguid, PDO::PARAM_INT);
			$insert->bindParam(':subject', $subject, PDO::PARAM_STR);
			$insert->bindParam(':message', $text, PDO::PARAM_STR);
			$insert->bindParam(':money', $money, PDO::PARAM_INT);
			$insert->bindParam(':item', $item, PDO::PARAM_INT);
			$insert->bindValue(':item_count', 1, PDO::PARAM_INT);
			$insert->execute() or ($sendmail = $insert->errorInfo());
		
			if($sendmail==false)
			{
				return  "<!-- success --><span class=\"colorgood\">Mail is sent! <br>All done!</span>";
			}
			else
			{
				return  "<span class=\"colorbad\">Mail is not sent! Error returned: ".$sendmail."<br>".$query_string;
			}
		}
		else
		{
			return "<span class=\"colorbad\">Mail is not sent! Error connection to realm database failed!";
		}
	}
	else
	{
		return "<span class=\"colorbad\">Mail is not sent! Error no realm passed as parameter!";
	}
}

/*************************************************************
* 		NON GLOBAL FUNCTIONS (not required for other cores)
**************************************************************/
