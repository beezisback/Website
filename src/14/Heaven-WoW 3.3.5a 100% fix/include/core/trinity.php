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
		"az"						=> "10",
		"a"							=> "4",
		"gm_normalplayer"			=> "0", //gm premission for normal player
		//
		// Expansion data in sql
		//
		"expansion_normal"			=> "0",
		"expansion_tbc"				=> "1",
		"expansion_wotlk"			=> "2",
		"expansion_cata"			=> "0",
		//
		// Accounts Table
		//
		"accounts" 					=> "account",	 	//table 'accounts'
			"acct"					=> "id",
			"login"    				=> "username",   		
			"password" 				=> "",	 	//leave blank if doesnt exits
														//if exists  website will try update raw pass here 
			"encrypted_password"	=> "sha_pass_hash",
			"gm"					=> "gmlevel",
			"banned"				=> "locked",
			"lastip"				=> "last_ip",
			"lastlogin"				=> "last_login",
			"flags"					=> "expansion",
			"email"					=> "email", //for gimmepass.php
		//
		// Characters Table
		//
		"characters"				=> "characters",  //table 'characters'
			"characters_acct"		=> "account",
			"characters_guid"		=> "guid",
			"characters_name"		=> "name",
			"characters_honorPoints"=> "totalHonorPoints",
			"characters_killsLifeTime"=>"totalKills",
			"characters_online"		=> "online",
			"characters_level"		=> "level",
			"characters_class"		=> "class",
			"characters_race"		=> "race",
			"characters_gender"		=> "gender",
			"characters_gold"		=> "money",
		//
		// Item Table
		//
		"items"						=> "item_template",
			"items_name1"			=> "name",
			"items_quality"			=> "Quality",
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
* 	 	  TOP ARENA FUNCTIONS
***************************************/

class TopArenaTeams
{
	private $db = false;
	private $translate = NULL;
	private $config = NULL;
	private $TC2 = false;
	
	public function __construct($TC2)
	{
		global $db_translation;
		
		$this->translate = $db_translation;
		$this->TC2 = $TC2;
		
		return true;
	}
		
	public function setDatabase($db)
	{
		$this->db = $db;
		
		return true;
	}
	
	public function setConfig($conf)
	{
		$this->config = $conf;
	}
	
	/**
	**  function getTeams(count) designed to get database resources by specified count
	** 
	**  Parameters:
	**  ------------------------------------------------------
	**  $count - limit the resources gethered from the database
	**
	**  Returns:
	**  ------------------------------------------------------
	**  PDO Statement executed and ready for fetching or false if there are no records
	**  - Columns:
	**  	 `arenateamid`
	**  	 `rating`
	**  	 `rank`
	**  	 `name`
	**  	 `captain`
	**  	 `type`
	**
	**/
	public function getTeams($count = 5)
	{
		//make sure the count param is digit
		if (!ctype_digit($count))
		{
			$count = 5;
		}
		
		if ($this->TC2)
		{
			$res = $this->db->prepare("
								SELECT 
									`arenaTeamId` AS arenateamid, 
									`rating`, 
									`rank`, 
									`name`, 
									`captainGuid` AS captain, 
									`type`
								FROM `arena_team` 
								ORDER BY rating DESC 
								LIMIT " . $count);
		}
		else
		{
			$res = $this->db->prepare("
								SELECT 
									`arena_team_stats`.`arenateamid` AS arenateamid, 
									`arena_team_stats`.`rating` AS rating, 
									`arena_team_stats`.`rank` AS rank, 
									`arena_team`.`name` AS name, 
									`arena_team`.`captainguid` AS captain, 
									`arena_team`.`type` AS type 
								FROM `arena_team_stats` 
								LEFT JOIN `arena_team` ON `arena_team_stats`.`arenateamid` = `arena_team`.`arenateamid`
								ORDER BY rating DESC 
								LIMIT " . $count);
		}
		
		$res->execute();
		
		if ($res->rowCount() > 0)
		{
			return $res;
		}
		else
		{
			unset($res);
			return false;
		}
	}

	/**
	**  function getTeamMembers(team) designed to get database resources about specifed team
	** 
	**  Parameters:
	**  ------------------------------------------------------
	**  $team - the arena team id
	**
	**  Returns:
	**  ------------------------------------------------------
	**  PDO Statement executed and ready for fetching or false if there are no records
	**  - Columns:
	**  	 `arenateamid`
	**  	 `guid`
	**  	 `name`
	**
	**/
	public function getTeamMembers($team)
	{
		if ($this->TC2)
		{
			$res = $this->db->prepare("
								SELECT 
									`arena_team_member`.`arenaTeamId` AS arenateamid, 
									`arena_team_member`.`guid` AS guid, 
									`".$this->translate['characters']."`.`".$this->translate['characters_name']."` AS name
								FROM `arena_team_member` 
								RIGHT JOIN `".$this->translate['characters']."` ON `".$this->translate['characters']."`.`".$this->translate['characters_guid']."` = `arena_team_member`.`guid` 
								WHERE `arena_team_member`.`arenateamid` = :team ORDER BY guid ASC");
		}
		else
		{
			$res = $this->db->prepare("
								SELECT 
									`arena_team_member`.`arenateamid` AS arenateamid, 
									`arena_team_member`.`guid` AS guid, 
									`".$this->translate['characters']."`.`".$this->translate['characters_name']."` AS name
								FROM `arena_team_member` 
								RIGHT JOIN `".$this->translate['characters']."` ON `".$this->translate['characters']."`.`".$this->translate['characters_guid']."` = `arena_team_member`.`guid` 
								WHERE `arena_team_member`.`arenateamid` = :team ORDER BY guid ASC");
		}
		
		$res->bindParam(':team', $team, PDO::PARAM_INT);
		$res->execute();
		
		if ($res->rowCount() > 0)
		{
			return $res;
		}
		else
		{
			unset($res);
			return false;
		}
	}
	
	public function getTeamCaptain($team)
	{
		if ($this->TC2)
		{
			$res = $this->db->prepare("SELECT `captainGuid` AS captainguid FROM `arena_team` WHERE `arenaTeamId` = :team LIMIT 1");
		}
		else
		{
			$res = $this->db->prepare("SELECT `captainguid` FROM `arena_team` WHERE `arenateamid` = :team LIMIT 1");
		}
		
		$res->bindParam(':team', $team, PDO::PARAM_INT);
		$res->execute();
		
		if ($res->rowCount() > 0)
		{
			$row = $res->fetch(PDO::FETCH_ASSOC);
			unset($res);
			return $row['captainguid'];
		}
		else
		{
			unset($res);
			return false;
		}
	}

	/**
	**  function getTeamInfo(team) designed to get database resources, fetch and parse
	** 
	**  Parameters:
	**  ------------------------------------------------------
	**  $team - the arena team id
	**
	**  Returns:
	**  ------------------------------------------------------
	**  false (bool) - on failure
	**  Columns:
	**  	 `arenateamid`
	**  	 `rating`
	**  	 `rank`
	**  	 `games`
	**  	 `wins`
	**  	 `lost`
	**  	 `name`
	**  	 `type`
	**
	**/
	public function getTeamInfo($team)
	{
		if ($this->TC2)
		{
			$res = $this->db->prepare("SELECT 
									`arenaTeamId` AS arenateamid, 
									`rating`, 
									`rank`, 
									`seasonGames` AS games, 
									`seasonWins` AS wins, 
									`name`, 
									`type`
								FROM `arena_team` 
								WHERE `arenaTeamId` = :team
								ORDER BY rating DESC 
								LIMIT 1");
		}
		else
		{
			$res = $this->db->prepare("SELECT 
									`arena_team_stats`.`arenateamid` AS arenateamid, 
									`arena_team_stats`.`rating` AS rating, 
									`arena_team_stats`.`rank` AS rank, 
									`arena_team_stats`.`played` AS games, 
									`arena_team_stats`.`wins2` AS wins, 
									`arena_team`.`name` AS name, 
									`arena_team`.`type` AS type 
								FROM `arena_team_stats` 
								LEFT JOIN `arena_team` ON `arena_team_stats`.`arenateamid` = `arena_team`.`arenateamid`
								WHERE `arena_team_stats`.`arenateamid` = :team
								ORDER BY rating DESC 
								LIMIT 1");
		}
		
		$res->bindParam(':team', $team, PDO::PARAM_INT);
		$res->execute();
				
		if ($res->rowCount() > 0)
		{
			$arr = $res->fetch(PDO::FETCH_ASSOC);
			
			//define array
			$row = array();
			$row['arenateamid'] = $arr['arenateamid'];
			$row['rating'] = $arr['rating'];
			$row['rank'] = $arr['rank'];
			$row['games'] = $arr['games'];
			$row['wins'] = $arr['wins'];
			$row['lost'] = $arr['games'] - $arr['wins'];
			$row['name'] = $arr['name'];
			
			//transalte the arena type
			if ($arr['type'] == 2)
			{
				$row['type'] = '2v2';
			}
			else if ($arr['type'] == 3)
			{
				$row['type'] = '3v3';
			}
			else
			{
				$row['type'] = '5v5';
			}
			
			unset($arr);
			
			return $row;
		}
		else
		{
			unset($res);
			return false;
		}
	}
	
	/**
	**  function resolveFaction finds out from wich faction the team is by looking at the team's captain record
	**
	**  Parameters:
	**  ----------------------------------------------
	**  $captain - character GUID of the team's captain
	**
	**  Returns:
	**  ----------------------------------------------
	**  alliance (string) 	- for alliance
	**  horde (string) 		- for horde
	**  false (bool)		- on failure
	**
	**/
	public function resolveFaction($captain)
	{
		$res = $this->db->prepare("SELECT ".$this->translate['characters_guid'].", ".$this->translate['characters_race']." FROM `".$this->translate['characters']."` WHERE `".$this->translate['characters_guid']."` = :guid LIMIT 1");
		$res->bindParam(':guid', $captain, PDO::PARAM_INT);
		$res->execute();
		
		if ($res->rowCount() > 0)
		{
			$row = $res->fetch(PDO::FETCH_ASSOC);
			
			$race = $row[$this->translate['characters_race']];
			
			//check if the faction is alliance
			if ($race == 1 or $race == 3 or $race == 4 or $race == 7 or $race == 11 or $race == 22)
			{
				unset($res);
				return 'alliance';
			}
			else
			{
				unset($res);
				return 'horde';
			}
		}
		else
		{
			unset($res);
			return false;
		}
	}
	
	public function __destruct()
	{
		unset($this->db);
	}
}
/***************************************
* 	 	  CHARACTER FUNCTIONS
***************************************/

function unstuck($guid)//returns
{
	global $REALM_DB, $db_translation;
	
	$fail=false;
	
	$res = $REALM_DB->prepare("SELECT * FROM `character_homebind` WHERE `guid` = :charid LIMIT 1");
	$res->bindParam(':charid', $guid, PDO::PARAM_INT);
	$res->execute();
	$row = $res->fetch(PDO::FETCH_ASSOC);
	unset($res);
		
	$update = $REALM_DB->prepare("UPDATE `characters` SET `position_x` = :x, `position_y` = :y, `position_z` = :z, `map` = :map, `zone` = :zone WHERE `guid` = :charid LIMIT 1");
	$update->bindParam(':charid', $guid, PDO::PARAM_INT);
	$update->bindParam(':x', $row['position_x'], PDO::PARAM_STR);
	$update->bindParam(':y', $row['position_y'], PDO::PARAM_STR);
	$update->bindParam(':z', $row['position_z'], PDO::PARAM_STR);
	$update->bindParam(':map', $row['map'], PDO::PARAM_STR);
	$update->bindParam(':zone', $row['zone'], PDO::PARAM_STR);
	
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
	
	$res = $REALM_DB->prepare("UPDATE `".$db_translation['characters']."` SET `position_x` = :x, `position_y` = :y, `position_z` = :z, `map` = :map, `money` = :gold WHERE `guid` = :guid LIMIT 1");
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
	
	$insert = $ACC_PDO->prepare("INSERT INTO `".$db_translation['accounts']."` (".$db_translation['login'].",".$db_translation['encrypted_password'].",".$db_translation['banned'].",".$db_translation['email'].",".$db_translation['flags'].") VALUES (:username, :passhash, :banned, :email, :flags)");
	$insert->bindParam(':username', strtoupper($user), PDO::PARAM_STR);
	$insert->bindParam(':passhash', $pass_enc, PDO::PARAM_STR);
	$insert->bindValue(':banned', 0, PDO::PARAM_INT);
	$insert->bindParam(':email', $email, PDO::PARAM_STR);
	$insert->bindParam(':flags', $db_translation['expansion_wotlk'], PDO::PARAM_INT);
	
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
	
	$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET `".$db_translation['encrypted_password']."` = :passhash, `sessionkey` = '', `v` = '', `s` = '' WHERE `".$db_translation['acct']."` = :id LIMIT 1");
	$update->bindParam(':id', $userid, PDO::PARAM_INT);
	$update->bindParam(':passhash', $newpass_enc, PDO::PARAM_STR);
	$update->execute();
	
	if (!$update->execute())
	{
		$report = print_r($update->errorInfo());
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
	return false;
}

//
// Unique function for trinity (exists only here for trinity)
//
function trinity_premissions()
{
	global $ACC_PDO, $WEB_PDO, $a_user, $db_translation;
	
	$end = false;
		
	$res = $WEB_PDO->prepare("SELECT acc_login, gmlevel FROM `accounts_more` WHERE UPPER(acc_login) = :acc");
	$res->bindParam(':acc', strtoupper($a_user[$db_translation['login']]), PDO::PARAM_STR);
	$res->execute();
	
	if ($res->rowCount() == 1)
	{
		$s2 = $res->fetch(PDO::FETCH_ASSOC);
		if ($s2['gmlevel']<>'')
		{
			return $s2['gmlevel'];
		}
	}
	unset($res);
	
	//select premission  from account_access
	$res = $ACC_PDO->prepare("SELECT * FROM `account_access` WHERE `id` = :acc ORDER BY gmlevel DESC LIMIT 1");
	$res->bindParam(':acc', $a_user[$db_translation['acct']], PDO::PARAM_INT);
	$res->execute();
	
	if ($res->rowCount() == 1)
	{
		$sql2 = $res->fetch(PDO::FETCH_ASSOC);
		return $sql2['gmlevel'];
	}
	else
	{
		return $db_translation['gm_normalplayer'];
	}
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
	global $WEB_PDO;
	//=======================================
	// 	ADD gmlevel field to accounts_more
	//=======================================
	$WEB_PDO->query("ALTER TABLE `accounts_more` ADD `gmlevel` int(11) default NULL");
	//=======================================
	// 	        HOW PREMISSIONS WORK
	//=======================================
	$output = "
	<big>How Website premissions for Trinity Core work:</big><br><br>
	Script will check <strong>accounts_more</strong> table for user premissions for this website, if there is no data, script will check for 1st realm (Realm ID 1 in trinity config) and will give website premissions as in Realm ID 1.<br><br><i>You can edit user premissions trough <u><a href='./quest.php?name=admincp3'>User Manager</a></u>.</i><br><br><br><big>External mail patch and SQL (required for vote/donation shops):</big><br><br><u><a href='./include/core/trinity_external_mail/external_patch.txt'>You can find patch here (Mail.cpp)</a><br><a href='./include/core/trinity_external_mail/sql.txt'>SQL is here (execute to character's DB's)</a></u>";
	return $output;
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