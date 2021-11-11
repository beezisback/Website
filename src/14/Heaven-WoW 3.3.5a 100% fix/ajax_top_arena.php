<?php
require("config.php");

if ($server_core=='')
	$server_core='trinity';
	
require_once './include/dblayer/common_db.php';
require_once './include/core/'.$server_core.'.php';

//check if we want to resolve faction of character
if (isset($_POST['resolveFaction']))
{
	$error = false;
	//check if the realm and character are passed
	if (isset($_POST['realm']) and isset($_POST['guid']))
	{
		$realmid = (int)$_POST['realm'];
		$guid = (int)$_POST['guid'];
		
		$TC2 = false;
		//check if our realm is TC2
		foreach ($TopArenaTeams as $data)
		{
			if ($data['realmid'] == $realmid)
			{
				if (isset($data['TC2']))
				{
					$TC2 = true;
				}
			}
		}
		
		$teams = new TopArenaTeams($TC2);
		
		//open database connection
		$REALM_DB = newRealmPDO($realmid);
		
		//check if we got realm database connection
		if ($REALM_DB)
		{
			$teams->setDatabase($REALM_DB);
			$faction = $teams->resolveFaction($guid);
			
			//check if the faction resolve has failed
			if (!$faction)
			{
				$error = true;
			}
		}
		else
		{
			$error = true;
		}
		unset($REALM_DB);
		unset($teams);
	}
	else
	{
		$error = true;
	}
	
	//if the faction is resolved
	if (!$error)
	{
		//only first letter capital
		echo ucfirst(strtolower($faction));
		die;
	}
	else
	{
		echo '0';
		die;
	}
}

//check if we need to lookup arena team
if (isset($_POST['lookupArenaTeam']))
{
	$error = false;
	//check if the realm and arenateamid are passed
	if (isset($_POST['realm']) and isset($_POST['arenateamid']))
	{
		$realmid = (int)$_POST['realm'];
		$teamid = (int)$_POST['arenateamid'];
		
		$TC2 = false;
		//check if our realm is TC2
		foreach ($TopArenaTeams as $data)
		{
			if ($data['realmid'] == $realmid)
			{
				if (isset($data['TC2']))
				{
					$TC2 = true;
				}
			}
		}
		
		$teams = new TopArenaTeams($TC2);
		
		//open database connection
		$REALM_DB = newRealmPDO($realmid);
		
		//check if we got realm database connection
		if ($REALM_DB)
		{
			$teams->setDatabase($REALM_DB);
			//get team details
			$info = $teams->getTeamInfo($teamid);
			
			if (!$info)
			{
				$error = true;
			}
			else
			{
				//get the team captain
				$captain = $teams->getTeamCaptain($teamid);
				//get team members
				$membersRes = $teams->getTeamMembers($teamid);

				//predefined variables
				$captainHTML = false;
				$membersHTML = false;
			
				//if we got team members
				if ($membersRes)
				{
					$membersHTML = '';
					$i = 1;
					while ($row = $membersRes->fetch(PDO::FETCH_ASSOC))
					{
						//check if the current members is the captain
						if ($row['guid'] == $captain)
						{
							$captainHTML = '<ul>
											<li class="col-title">Team Captain:</li>
											<li class="col-info">'.$row['name'].'</li>
										</ul>';
						}
						else
						{
							$membersHTML .= '<ul>
											<li class="col-title">Member '.$i.':</li>
											<li class="col-info">'.$row['name'].'</li>
										</ul>';
							$i++;
						}
					}
					unset($membersRes);
				}
			}
		}
		else
		{
			$error = true;
		}
		unset($REALM_DB);
		unset($teams);
	}
	else
	{
		$error = true;
	}
	
	if (!$error)
	{
		$html = '<ul>
					<li class="team-name">'.$info['name'].'</li>
				</ul>
				<ul>
					<li class="col-title">Games:</li>
					<li class="games-won">'.$info['wins'].' Won</li>
					<li class="games-lost">'.$info['lost'].' Lost</li>
				</ul>
				<ul>
					<li class="col-title">Type:</li>
					<li class="col-info">'.$info['type'].'</li>
				</ul>
				<ul>
					<li class="col-title">Rating:</li>
					<li class="col-info">'.$info['rating'].'</li>
				</ul>';
				
		//if we have team captain
		if ($captainHTML)
		{
			$html .= $captainHTML;
		}
		//if we have team members
		if ($membersHTML)
		{
			$html .= $membersHTML;
		}
		
		echo $html;
		die;
	}
	else
	{
		echo '0';
		die;
	}
}



