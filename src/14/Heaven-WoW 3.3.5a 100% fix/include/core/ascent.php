<?php

/***********************************************
* DB query structure for Ascent/ArcEmu, by AXE
* 3.2.2010. american date
* All functions here must always exist
************************************************/


$db_translation = array(
		//
		// GM premisions translation (all that are used by this cms)
		//
		"az"						=> "az",
		"a"							=> "a",
		"gm_normalplayer"			=> "0", //gm premission for normal player
		//
		// Expansion data in sql
		//
		"expansion_normal"			=> "0",
		"expansion_tbc"				=> "8",
		"expansion_wotlk"			=> "24",
		"expansion_cata"			=> "0",
		//
		// Accounts Table
		//
		"accounts" 					=> "accounts",	 	//table 'accounts'
			"acct"					=> "acct",
			"login"    				=> "login",   		
			"password" 				=> "password",	 	//leave blank if doesnt exits
														//if exists  website will try update raw pass here 
			"encrypted_password"	=> "encrypted_password",
			"gm"					=> "gm",
			"banned"				=> "banned",
			"lastip"				=> "lastip",
			"lastlogin"				=> "lastlogin",
			"flags"					=> "flags",
			"email"					=> "email", //for gimmepass.php
		//
		// Characters Table
		//
		"characters"				=> "characters",  //table 'characters'
			"characters_acct"		=> "acct",
			"characters_guid"		=> "guid",
			"characters_name"		=> "name",
			"characters_honorPoints"=> "honorPoints",
			"characters_killsLifeTime"=>"killsLifeTime",
			"characters_online"		=> "online",
			"characters_level"		=> "level",
			"characters_class"		=> "class",
			"characters_race"		=> "race",
			"characters_gender"		=> "gender",
			"characters_gold"		=> "gold",
		//
		// Item Table
		//
		"items"						=> "items",
			"items_name1"			=> "name1",
			"items_quality"			=> "quality",
			"items_entry"			=> "entry",
		//
		// Tickets
		//
		"gm_tickets"				=> "gm_tickets",
			"gm_tickets_guid"		=> "guid",
			"gm_tickets_playerGuid"	=> "playerGuid",
			"gm_tickets_timestamp" 	=> "timestamp",
			"gm_tickets_message" 	=> "message",
		
);


/***************************************
* 	 	  CHARACTER FUNCTIONS
***************************************/

function unstuck($guid)//returns
{
	global $REALM_DB, $db_translation;
	
	$fail=false;
	
	$update = $REALM_DB->prepare("UPDATE `".$db_translation['characters']."` SET `positionX` = bindpositionX, `positionY` = bindpositionY, `positionZ` = bindpositionZ, `mapId` = bindmapId, `zoneId` = bindzoneId, `deathstate` = 0 WHERE guid = :charid LIMIT 1");
	$update->bindParam(':charid', $guid, PDO::PARAM_INT);
	
	if (!$update->execute())
	{
		$fail = $update->errorInfo();
	}
	
	return $fail;
}

function teleport($guid,$x,$y,$z,$map,$newGold)//returns
{
	global $REALM_DB, $db_translation;
	
	$fail=false;
	
	$res = $REALM_DB->prepare("UPDATE `".$db_translation['characters']."` SET `positionX` = :x, `positionY` = :y, `positionZ` = :z, `mapid` = :map, `".$db_translation['characters_gold']."` = :gold WHERE `guid` = :guid LIMIT 1");
	$res->bindParam(':guid', $guid, PDO::PARAM_INT);
	$res->bindParam(':x', $x, PDO::PARAM_STR);
	$res->bindParam(':y', $y, PDO::PARAM_STR);
	$res->bindParam(':z', $z, PDO::PARAM_STR);
	$res->bindParam(':map', $map, PDO::PARAM_STR);
	$res->bindParam(':gold', $newGold, PDO::PARAM_INT);
	
	if (!$res->execute())
	{
		$fail = $res->errorInfo();
	}
	
	unset($res);

	return $fail;
}


/***************************************
* 	 ACCOUNT MANAGEMENT FUNCTIONS
***************************************/

function create_account($user,$pass,$email)//gotta be logged in for this, returns
{
	global $db_translation, $ACC_PDO;
	
	$pass_enc=sha1(strtoupper($user).':'.strtoupper($pass));
	
	$insert = $ACC_PDO->prepare("INSERT INTO `".$db_translation['accounts']."` (".$db_translation['login'].",".$db_translation['password'].",".$db_translation['encrypted_password'].",".$db_translation['gm'].",".$db_translation['banned'].",".$db_translation['email'].",".$db_translation['flags'].") VALUES (:username, :pass, :passhash, :gmlevel, :banned, :email, :flags)");
	$insert->bindParam(':username', $user, PDO::PARAM_STR);
	$insert->bindParam(':pass', $pass, PDO::PARAM_STR);
	$insert->bindParam(':passhash', $pass_enc, PDO::PARAM_STR);
	$insert->bindValue(':gmlevel', 0, PDO::PARAM_INT);
	$insert->bindValue(':banned', 0, PDO::PARAM_INT);
	$insert->bindParam(':email', $email, PDO::PARAM_STR);
	$insert->bindValue(':flags', 24, PDO::PARAM_INT);
	
	$report = false;
	
	if (!$insert->execute())
	{
		$report = $insert->errorInfo();
	}
	
	unset($insert);
	
	if (!$report)
		return false;
	else
		return $report;
}

function passchange($newpass, $userid=false)//gotta be logged in for this, returns
{
	global $db_translation, $a_user, $ACC_PDO;
	
	if (!$userid)
	{
		$userid = $a_user[$db_translation['acct']];
		$username = $a_user[$db_translation['login']];
	}
	else
	{
		$res = $ACC_PDO->prepare("SELECT ".$db_translation['acct'].", ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['acct']."` = :acc LIMIT 1");
		$res->bindParam(':acc', $userid, PDO::PARAM_INT);
		$res->execute();
		
		$row = $res->fetch(PDO::FETCH_ASSOC);
		unset($res);
		
		$username = $row[$db_translation['login']];	
	}	
	
	$newpass_enc = sha1(strtoupper($username).':'.strtoupper($newpass));
	
	$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET `".$db_translation['password']."` = :pass, `".$db_translation['encrypted_password']."` = :passhash WHERE `".$db_translation['acct']."` = :id LIMIT 1");
	$update->bindParam(':id', $userid, PDO::PARAM_INT);
	$update->bindParam(':pass', $newpass, PDO::PARAM_STR);
	$update->bindParam(':passhash', $newpass_enc, PDO::PARAM_STR);
	$update->execute();
	
	if (!$update->execute())
	{
		$report = $update->errorInfo();
	}
	
	unset($update);
	
	if (!$report)
		return false;
	else
		return $report;
}
//
//execute this when user wants to login and user/pass variables are $_post-ed thru
//
function special_core_exec_onlogin($username)
{	
	global $ACC_PDO;
	
	//For Ascent: we will check if user has password aleady encrypted, if not we will do this here and now
	$res = $ACC_PDO->prepare("SELECT encrypted_password, password FROM `accounts` WHERE `login` = :username LIMIT 1");
	$res->bindParam(':username', $username, PDO::PARAM_STR);
	$res->execute();
	
	if ($res->rowCount() == 1)
	{
		$a1 = $res->fetch(PDO::FETCH_ASSOC);
		//nevermind if user already has encrypted passwod, we will reupdate it
		$update = $ACC_PDO->prepare("UPDATE `accounts` SET `encrypted_password` = :passhash WHERE `login` = :username LIMIT 1");
		$update->bindParam(':passhash', sha1(strtoupper($username).':'.strtoupper($a1['password'])), PDO::PARAM_STR);
		$update->bindParam(':username', $username, PDO::PARAM_STR);
		$update->execute();
		unset($update);
	}
	
	unset($res);
}

/***************************************
* 	    FILE SPECIFIC VARIABLES
***************************************/
//
//   /hk.php and /honor.php
//
$hk_where="banned='0' or banned='' and";



/***************************************
* 	    SERVER PATCHES
***************************************/
function patch_notice()//will be shown in admin panel
{
	return false; //none for ascent
}
function patch_include($patchname,$output=false)
{
	global $server_core;
	//inside /htdocs/include/core/ folder
	//include files named $server_core_$patchname.php
	if (file_exists(PATHROOT.'include/core/'.$server_core.'_'.$patchname.'.php'))
	{
		if ($output)
			echo "File ".'<b>'.PATHROOT.'include/core/'.$server_core.'_'.$patchname.'.php</b>'. " is loaded.";
		require_once(PATHROOT.'include/core/'.$server_core.'_'.$patchname.'.php');
	}
	else 
	{
		if ($output)
			echo "File ".'<b>'.PATHROOT.'include/core/'.$server_core.'_'.$patchname.'.php</b>'. " is not loaded.";
		return false;
	}
}