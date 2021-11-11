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
		$item="";
	if ($money=='')
		$money=0;

	$sendmail=false;
	
	$insert = $REALM_DB->prepare("INSERT INTO `mailbox_insert_queue` (sender_guid, receiver_guid, subject, body, stationary, money, item_id, item_stack) VALUES (:sender_guid, :receiver_guid, :subject, :body, '61', :money, :item_id, '1')");
	$insert->bindParam(':sender_guid', $playerguid, PDO::PARAM_INT);
	$insert->bindParam(':receiver_guid', $playerguid, PDO::PARAM_INT);
	$insert->bindParam(':subject', $subject, PDO::PARAM_STR);
	$insert->bindParam(':body', $text, PDO::PARAM_STR);
	$insert->bindParam(':money', $money, PDO::PARAM_INT);
	$insert->bindParam(':item_id', $item, PDO::PARAM_INT);
	$insert->execute() or ($sendmail = $insert->errorInfo());
	unset($insert);
		
	if($sendmail==false)
	{
		return  "<!-- success --><span class=\"colorgood\">Mail is sent! <br>All done!</span>";
	}
	else
	{
		return  "<span class=\"colorbad\">Mail is not sent! Error returned: ".$sendmail."<br>"."INSERT INTO mailbox_insert_queue(sender_guid, receiver_guid, subject, body, stationary, money, item_id, item_stack) VALUES ('".$playerguid."', '".$playerguid."', '".$db->escape($subject)."', '".$db->escape($text)."', '61', '".$money."', '".$item."', '1')"."</span>";
	}
}

/*************************************************************
* 		NON GLOBAL FUNCTIONS (not required for other cores)
**************************************************************/
