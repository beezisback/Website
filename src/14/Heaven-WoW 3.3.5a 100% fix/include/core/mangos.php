<?php

/***********************************************
* DB query structure for MaNGOS, by AXE
* 3.2.2010. american date
* All functions here must always exist
************************************************/


$db_translation = array(
		//
		// GM premisions translation (all that are used by this cms)
		//
		"az"						=> "3",	//admin
		"a"							=> "2", //gm
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
		"accounts" 					=> "account",	 //table 'accounts'
			"acct"					=> "id",
			"login"    				=> "username",   
			"password" 				=> "",			 //leave blank if doesnt exits, 
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
		"gm_tickets"				=> "character_ticket",
			"gm_tickets_guid"		=> "ticket_id",
			"gm_tickets_playerGuid"	=> "guid",
			"gm_tickets_timestamp" 	=> "ticket_lastchange",
			"gm_tickets_message" 	=> "ticket_text",
			
);

/***************************************
* 	 	  TOP ARENA FUNCTIONS
***************************************/

class TopArenaTeams
{
	private $db = false;
	private $translate = NULL;
	
	public function __construct()
	{
		global $db_translation;
		
		$this->translate = $db_translation;
				
		return true;
	}
		
	public function setDatabase($db)
	{
		$this->db = $db;
		
		return true;
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
		$res = $this->db->prepare("
								SELECT 
									`arena_team_member`.`arenateamid` AS arenateamid, 
									`arena_team_member`.`guid` AS guid, 
									`".$this->translate['characters']."`.`".$this->translate['characters_name']."` AS name
								FROM `arena_team_member` 
								RIGHT JOIN `".$this->translate['characters']."` ON `".$this->translate['characters']."`.`".$this->translate['characters_guid']."` = `arena_team_member`.`guid` 
								WHERE `arena_team_member`.`arenateamid` = :team ORDER BY guid ASC");
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
		$res = $this->db->prepare("SELECT `captainguid` FROM `arena_team` WHERE `arenateamid` = :team LIMIT 1");
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
		
	$update = $REALM_DB->prepare("UPDATE `".$db_translation['characters']."` INNER JOIN `character_homebind`
																			 ON `".$db_translation['characters']."`.`guid` = character_homebind.guid AND  `".$db_translation['characters']."`.`guid` = :charid
																			 SET `".$db_translation['characters']."`.`position_X` = character_homebind.position_x,
																			 `".$db_translation['characters']."`.`position_Y` = character_homebind.position_y,
																			 `".$db_translation['characters']."`.`position_z` = character_homebind.position_z");
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
	
	$res = $REALM_DB->prepare("UPDATE `".$db_translation['characters']."` SET `position_X` = :x, `position_Y` = :y, `position_Z` = :z, `map` = :map, `".$db_translation['characters_gold']."` = :gold WHERE `guid` = :guid LIMIT 1");
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
	
	$insert = $ACC_PDO->prepare("INSERT INTO `".$db_translation['accounts']."` (".$db_translation['login'].",".$db_translation['encrypted_password'].",".$db_translation['gm'].",".$db_translation['banned'].",".$db_translation['email'].",".$db_translation['flags'].") VALUES (:username, :passhash, :gmlevel, :banned, :email, :flags)");
	$insert->bindParam(':username', strtoupper($user), PDO::PARAM_STR);
	$insert->bindParam(':passhash', $pass_enc, PDO::PARAM_STR);
	$insert->bindValue(':gmlevel', 0, PDO::PARAM_INT);
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

function passchange($newpass,$userid=false)//gotta be logged in for this, returns
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
	
	$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET `".$db_translation['encrypted_password']."` = :passhash, `v` = '' WHERE `".$db_translation['acct']."` = :id LIMIT 1");
	$update->bindParam(':id', $userid, PDO::PARAM_INT);
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
	return false;
}

/***************************************
* 	    FILE SPECIFIC VARIABLES
***************************************/

//
//   /hk.php and /honor.php
//
$hk_where="";

/***************************************
* 	    SERVER PATCHES
***************************************/
function patch_notice()//will be shown in admin panel
{
	global $db_translation,$a_user,$ra_user,$ra_pass, $ACC_PDO, $WEB_PDO;
	
	//=======================================
	// 	        REMOTE ACCESS PANEL
	//=======================================
	$output = "<script type='text/javascript'>function loadiframe(){var text = \"<iframe src='./include/core/mangos_iframe_ratest.php' style='width:99%; height:130px;'>Your browser does not support iframes. <a href='./include/core/mangos_iframe_ratest.php' target='_blank'>Click to test connection</a></iframe>\";
	document.getElementById('raiframe').innerHTML=text;}</script>
	
	
	<fieldset id='remote'><legend>Remote Access:</legend>
	<u><big>1) Enable RA in your MaNGOS server config (mangosd.conf)</big></u><br>
		<blockquote><fieldset style='border:solid 1px'><legend>Edit mangosd.conf</legend>Ra.Enabled = <span class='colorgood'>1</span><br>
         Ra.IP = 0.0.0.0<br>
         Ra.Port = 3443<br>
         Ra.MinLevel = 3<br>
         Ra.Secure = 1</fieldset></blockquote><br>";
		 
	//add/edit config.php ra_user and ra_pass
	$output .= '<u><big>2) Add admin account info for remote access</big></u><br>';
	if (isset($_POST['mangos1']))
	{	
		//first check if password is valid
		if (sha1(strtoupper($a_user[$db_translation['login']]).':'.strtoupper($_POST['ra_pass']))==$a_user[$db_translation['encrypted_password']])
		{
			/**************READ AND UPDATE config.php***************/
			/*                                                     */
			$fail=false;
			$config_file_content = file_get_contents('./config.php') or ($fail= 'ERROR 1: Could not read file "config.php"');
			
			if ($fail)
			{$output .='<blockquote><fieldset style="border:solid 1px"><legend>Admin Username and Password (gmlevel greater or equal than Ra.MinLevel):</legend><center><span class="colorbad">'.$fail.'</span></fieldset>
			</blockquote><br>';
			}
			else
			{
				$config_file_content=str_replace('$ra_user="'.$ra_user.'"','$ra_user="'.strtoupper($a_user[$db_translation['login']]).'"',$config_file_content);
				$config_file_content=str_replace('$ra_pass="'.$ra_pass.'"','$ra_pass="'.str_replace("\"","",$_POST['ra_pass']).'"',$config_file_content);
				//$output .= pun_htmlspecialchars($config_file_content);
				//finally writte new config
				$fh = fopen('./config.php', 'w') or ($fail= 'ERROR 2: Could not writte file "config.php"');
				if ($fail)
				{
					$output .='<blockquote><fieldset style="border:solid 1px"><legend>Admin Username and Password (gmlevel greater or equal than Ra.MinLevel):</legend><center><span class="colorbad">'.$fail.'</span> <a href="./quest.php?name=admincp#remote">Click here refresh this box</a></fieldset>
			</blockquote><br>';
				}
				else
				{
					fwrite($fh, $config_file_content);
					fclose($fh);
					$output .='<blockquote><fieldset style="border:solid 1px"><legend>Admin Username and Password (gmlevel greater or equal than Ra.MinLevel):</legend><center><span class="colorgood">File config.php is now updated.</span> <a href="./quest.php?name=admincp&1#remote">Click here refresh this box</a></fieldset>
			</blockquote><br>';
				}
				
			}
			/*                                                     */
			/********************************************************/
		}
		else//pass not valid
		{
			/**************PRINT WRONG PASS*************************/
			/*                                                     */
			$output .='<blockquote><fieldset style="border:solid 1px"><legend>Admin Username and Password (gmlevel greater or equal than Ra.MinLevel):</legend><center><span class="colorbad">Password for this account is incorrect. <a href="./quest.php?name=admincp&2#remote">Click to try again.</a></span></fieldset>
			</blockquote><br>';
			/*                                                     */
			/********************************************************/
		}
		
	}
	else
	{
		$output .='
		<form action="./quest.php?name=admincp#remote" method="POST">
		<blockquote>
			<fieldset style="border:solid 1px"><legend>Admin Username and Password (gmlevel greater or equal than Ra.MinLevel):</legend>
		
		<table width="100%" border="0">
	  <tr>
		<td><i><strong>User:</strong></i> '.strtoupper($a_user[$db_translation['login']]).' (CAPS on)</td>
		<td>[stored: \''.$ra_user.'\']</td>
	  </tr>
	  <tr>
		<td><i><strong>Pass:</strong></i> <input name="ra_pass" type="password" value="" /></td>
		<td>[stored: \''.$ra_pass[0];$i=2;while ($i<=strlen($ra_pass)){$output .='*';$i++;}
		
		$output .='\']</td>
	  </tr>
	</table><center><input name="mangos1" type="submit" value="Update" /></center>
			</fieldset>
		</blockquote></form><br>';
	}
		 
	$output .= "<u><big>3) Test Connection</big></u><br><noscript><div style='border: solid 1px red; padding: 3px' class='colorbad'>Please enable javascript in order for testing to work.</div></noscript><blockquote><fieldset style='border:solid 1px'><legend><a onclick='javascript:loadiframe(); return false' href='#'>Click here to start connection test (wait few moments to load)</a></legend><center><div id='raiframe'></div></center></fieldset></blockquote></fieldset>
		";
		
	//=======================================
	// 	        FAILED MAIL REPORTS
	//=======================================
	
	$output.="<br /><fieldset id='failedmail'><legend>Failed mail logs:</legend>
	
	";
	if (isset($_POST['failedmail']))//return points and delete
	{
		//delete filename and return points
		//-get user points atm
		
		if($_POST['dorv']=='1')//dp
		{
			$update = $WEB_PDO->prepare("UPDATE `accounts_more` SET `dp` = :dp WHERE `acc_login` = :login LIMIT 1");
			$update->bindParam(':dp', $_POST['numpoints_total_dp'], PDO::PARAM_INT);
			$update->bindParam(':login', $_POST['username'], PDO::PARAM_STR);
			$update->execute();
			unset($update);
		}
		elseif($_POST['dorv']=='0')//vp
		{	
			$update = $WEB_PDO->prepare("UPDATE `accounts_more` SET `vp` = :vp WHERE `acc_login` = :login LIMIT 1");
			$update->bindParam(':vp', $_POST['numpoints_total_vp'], PDO::PARAM_INT);
			$update->bindParam(':login', $_POST['username'], PDO::PARAM_STR);
			$update->execute();
			unset($update);
		}
		
		unlink("./include/core/mangos_iframe_mailcheck_log/".$_POST['filename']) or ($unlink=false);
		$output.="<br><br><center><a href='./quest.php?name=admincp&ok#failedmail'>Report is deleted and points returned, click here to refresh box.</a></center><br><br>";
		
	}
	elseif (isset($_POST['failedmail2']))//just delete report
	{
		unlink("./include/core/mangos_iframe_mailcheck_log/".$_POST['filename']) or ($unlink=false);
		$output.="<br><br><center><a href='./quest.php?name=admincp&ok#failedmail'>Report is deleted, click here to refresh box.</a></center><br><br>";
	}
	else
	{
		$handle4 = opendir("./include/core/mangos_iframe_mailcheck_log/");
		$output.="Mail sometimes can't be sent due to busy server, and console commands via web PHP arn't  100% reliable. This reports are from Vote Shop and Donation Shop. If there is any item/point loss, it will be in this report:<br>";
		# Making an array containing the files in the current directory:
		while ($file4 = readdir($handle4))
		{
			$files4[] = $file4;
		}
		closedir($handle4);
			$output.="<br><table width=\"98%\" border=\"0\" cellspacing='0'>
					  <tr>
						<td><strong>Username</strong><br><br></td>
						<td><strong>Time</strong><br><br></td>
						<td><strong>Action</strong><br><br></td>
					  </tr>";
		#echo the files
		foreach ($files4 as $file4) {
	
			if ($file4<>'..' && $file4<>'.')
			{
				  $f4= str_replace(".txt", "", $file4);
				  //$file4 -> userid_timestamp
				  $f4=explode("_",$f4);
				  $file4_content = file_get_contents("./include/core/mangos_iframe_mailcheck_log/".$f4[0]."_".$f4[1].".txt") or ($report_error='ERROR 1: Could not read log file');
				  $file4_content=explode("|",$file4_content);
				  
				  //get username and other infro from id
				  $res = $ACC_PDO->prepare("SELECT * FROM `".$db_translation['accounts']."` WHERE `".$db_translation['acct']."` = :acc LIMIT 1");
				  $res->bindParam(':acc', $f4[0], PDO::PARAM_INT);
				  $res->execute() or ($report_error = $res->errorInfo());
				  				  
				  $fsql2 = $res->fetch(PDO::FETCH_ASSOC);
				  
				  unset($res);
				  
				  $output.=$report_error;
				  $report_error=false;
				  
				  //get item info
				  $res = $WEB_PDO->prepare("SELECT * FROM `shop` WHERE `id` = :id LIMIT 1");
				  $res->bindParam(':id', $file4_content[1], PDO::PARAM_INT);
				  $res->execute() or ($report_error = $res->errorInfo());
				  
				  $output.=$report_error; 
				  $report_error=false;
				  
				  $fsql2_it = $res->fetch(PDO::FETCH_ASSOC);
				  
				  unset($res);
				  
				  $output.="[itemid: ".$fsql2_it['itemid']."]";
				  
				  
				  $output.= "<tr>
						<td>".$fsql2[$db_translation['login']]."<hr></td>
						<td>".date("j M'y@g:ia",$f4[1])." ";
					 $output.='<span class="headed" onmouseover="$WowheadPower.showTooltip(event, \''.$fsql2_it['name'].'<br>';
					 if ($fsql2_it['donateorvote']=='1')  $output.="<small>Donation item</small>";
					 else if($fsql2_it['donateorvote']=='0') $output.="<small>Vote item</small>";
					 $output.='<br><small>Points to return: '.$fsql2_it['cost'].'</small>\')" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();">[itemid: '.$fsql2_it['itemid'].']</span>';	
					 
					 //get accounts_more
				 	 $res = $WEB_PDO->prepare("SELECT dp,vp FROM `accounts_more` WHERE `acc_login` = :login LIMIT 1");
				  	 $res->bindParam(':login', $fsql2[$db_translation['login']], PDO::PARAM_STR);
				  	 $res->execute() or ($report_error = $res->errorInfo());
					 
					 $fsql_account2 = $res->fetch(PDO::FETCH_ASSOC);
					 
				 	 unset($res);
					 
					$output.="<hr></td>
						<td>".'<center><form action="./quest.php?name=admincp#failedmail" method="POST">
						
<input name="dorv" type="hidden" value="'.$fsql2_it['donateorvote'].'" />
<input name="numpoints_total_vp" type="hidden" value="';
if ($fsql2_it['donateorvote']=='0') $output.= ($fsql_account2['vp']+$fsql2_it['cost']);
else	$output.="0";
$output.='" />
<input name="numpoints_total_dp" type="hidden" value="';
if ($fsql2_it['donateorvote']=='1') $output.= ($fsql_account2['dp']+$fsql2_it['cost']);
else	$output.="0";
$output.='" />
<input name="username" type="hidden" value="'.$fsql2[$db_translation['login']].'" />
<input name="filename" type="hidden" value="'.$f4[0].'_'.$f4[1].'.txt" />

<input name="failedmail" type="submit" value="Return pt & del" /> <input name="failedmail2" type="submit" value="Just del" /></form></center></center>'."</td>
					  </tr>";
				  
			}
		
		} 
		$output.="</table>";
	}//end _POST
	
	$output.="</fieldset>";
	
	
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