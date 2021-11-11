<?php
/***********************************************************
*	Sendmail function for TrinityCore
*	by AXE
*   this file is required for all cores
************************************************************/

/***********************************************************
* 		 GLOBAL FUNCTIONS (required for all cores)
************************************************************/
function ExecuteSoapCommand($command, $realmid)
{
	global $ra_user, $ra_pass, $realm;
	
    try //Try to execute function
    {
    	$cliente = new SoapClient(NULL,
    		array(
    			"location" => "http://127.0.0.1:".$realm[$realmid]['port_soap']."/",
    			"uri"   => "urn:TC",
    			"style" => SOAP_RPC,
    			"login" => $ra_user,
    			"password" => $ra_pass
			)
    	);

   	 	$result = $cliente->executeCommand(new SoapParam($command, "command"));
    
    }
	catch(Exception $e)
    {
        return array('sent' => false, 'message' => $e->getMessage());
    }
	 
    return array('sent' => true, 'message' => $result);
}

function sendmail($playername, $playerguid, $subject, $text, $item, $shopid=0,  $money=0, $realmid=1, $stack = false) //returns, IMPORTANT: do not remove <!-- success --> if success
{
	global $server, $ra_user, $ra_pass, $REALM_DB, $a_user, $se_c, $realm;
	
	$playername = clean_string($playername);
    $subject = clean_string($subject); //no whitespaces
	$item = (int)$item; //item id
	$realmid = (int)$realmid;
	
	if ($item<>'')
		$item = " ".$item;
	
	if ($stack)
	{
		$item = $item . '[' . $stack . ']';
	}	

    $text = clean_string($text);
	$money = (int)$money;
	
	//we got no SOAP
	$SOAP = false;
	
	if (!extension_loaded('soap'))
	{
		return 'PHP Error: The server has no SOAP extension loaded.';
	}
	
	$returntxt = '';
	if ($item != '' && $item != 0)//send item
	{
		//send SOAP
		$SOAP = ExecuteSoapCommand("send items ".$playername." \"".$subject."\" \"".$text."\"".$item."", $realmid);
		//sendmail to RA console
		//fputs($telnet, ".send items ".$playername." \"".$subject."\" \"".$text."\"".$item."\n");
		$returntxt = "A mail with an item was sent!";
	}
	elseif ($money > 0 && $money != '')//send money
	{
		$SOAP = ExecuteSoapCommand("send money ".$playername." \"".$subject."\" \"".$text."\"".$money."", $realmid);
		//fputs($telnet, ".send money ".$playername." \"".$subject."\" \"".$text."\" ".$money."\n");
		$returntxt = "A mail with gold was sent!";
	}
	else //send letter
	{
		$SOAP = ExecuteSoapCommand("send mail ".$playername." \"".$subject."\" \"".$text."\"", $realmid);
		//fputs($telnet, ".send mail ".$playername." \"".$subject."\" \"".$text."\"\n");
		$returntxt = "A mail without any items or gold was sent!";
	}
	
	if ($SOAP)
	{
		if ($SOAP['sent'])
		{
			//check database if actuall item is there
			//WebsiteVoteShopREFXXXXXXX ->this is unique	
			$res = $REALM_DB->prepare("SELECT * FROM `mail` WHERE `receiver` = :receiver AND `subject` = :subject LIMIT 1");
			$res->bindParam(':receiver', $playerguid, PDO::PARAM_INT);
			$res->bindParam(':subject', $subject, PDO::PARAM_STR);
			$res->execute();
			
			if($res->rowCount() == 0)
			{
				$status = "Rechecking script. (Just to make sure your mail is actually sent.):<br><br><center><iframe style='width:96%;  height:100px' src='./include/core/trinity_ra_iframe_mailcheck.php?shopid=".$shopid."&reciver=".$playerguid."&subject=".$subject."&realmid=".$realmid."&shash=".sha1($a_user['id'].$playerguid.$subject.$shopid)."'><a href='./include/core/trinity_ra_iframe_mailcheck.php?shopid=".$shopid."&reciver=".$playerguid."&subject=".$subject."&realmid=".$realmid."&shash=".sha1($a_user['id'].$playerguid.$subject.$shopid)."'>Check here if your mail has been sent.</a></iframe></center>";
			}
			unset($res);
			
			return  "<!-- success --><span class=\"colorgood\">".$returntxt."<br></span><br>".$status;	
		}
		else
		{
			return  "<span class=\"colorbad\">Failure, SOAP command was unseuccessful. Return: ".$SOAP['message']."</span>";
		}
	}
	else
	{
		return  "<span class=\"colorbad\">Failure, SOAP was not called.</span>";
	}
}

/*************************************************************
* 		NON GLOBAL FUNCTIONS (not required for other cores)
**************************************************************/
function clean_string($string) //returns
{
    return str_replace(array("\n", "\""), "", $string);
}

function test_ra_connection() //used in htdocs/telnet-test.php, echoes
{
	global $server,$ra_user,$ra_pass,$realm;
	$telnet = fsockopen($server, $realm['1']['port_ra'], $error, $error_str, 3);
	
	
	if($telnet)
	{
		
		//fgets($telnet,1024); // Motd
		fputs($telnet, 'USER '.$ra_user."\n");
		echo "USER ".$ra_user."<br>";
		sleep(3);
		
		//fgets($telnet,1024); // PASS
		fputs($telnet,'PASS '. $ra_pass."\n");
		echo "PASS *****<br>";
		
		sleep(3);
		
		$remote_login = fgets($telnet,1024);
		echo  "The console reported: <i>".$remote_login."</i><br>";
			
		fclose($telnet);
	}
	else
		echo  "<font color=\"red\">A Telnet connection issue occured: <i>".$error_str."</i></font><br>";
}
function sendmail_confirm($receiver, $subject, $realmid)//returns
{	
	global $db, $realm;
	
	$REALM_DB = newRealmPDO($realmid);
	
	if ($REALM_DB)
	{
		$res = $REALM_DB->prepare("SELECT * FROM `mail` WHERE `receiver` = :receiver AND `subject` = :subject LIMIT 1");
		$res->bindParam(':receiver', $receiver, PDO::PARAM_INT);
		$res->bindParam(':subject', $subject, PDO::PARAM_STR);
		$res->execute();
			
		if($res->rowCount() == 0)
		{
			return "Checking for mail in DB... <font color='red'>Error: Your mail was not found!</font>";//you can change this text
		}
		else
		{
			return "Checking for mail in DB... <font color='lime'>Item is successfully sent!</font>";//do not change text or 'recheck' script will not work
		}
	}
	else
	{
		return "Checking for mail in DB... <font color='red'>Error: Failed to connection to the realm database!</font>";
	}
}