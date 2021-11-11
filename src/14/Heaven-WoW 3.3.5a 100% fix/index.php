<?php
require_once("header.php"); 

//right sidebar template
$tpl_sidebar = new Template("styles/".$style."/sidebar.php");
$tpl_sidebar->setVar("imagepath", './styles/'.$style.'/images/');     
$tpl_index = new Template("styles/".$style."/index_body.php");
$tpl_index->setVar("imagepath", './styles/'.$style.'/images/');  
//
//this is content,  the middle section
//
if ($upozorenje<>'')
$tpl_index->setVar("account_warnning", upozorenje($upozorenje));
//vote buttons
if (count($voteurls)>='1')
include_once "vote_links.php";
 //$vote_links;
//vote buttons end
include_once "news.php";
 //$news_content;
include_once "inc_latestplayers.php";
//This is the custom slider we added
include_once "slider.php";

 // $inc_latestplayers
/*****************************
* IMPORTANT!
* every include script must
* outout its content as a
* string, after that here
* page is printed in a templ.
* - $vote_links
* - $news_content (news.php)
* - $inc_latestplayers
******************************/
$tpl_index->setVar("inc_latestplayers", $inc_latestplayers); 
$tpl_index->setVar("vote_links", $vote_links); 
$tpl_index->setVar("news_content", $news_content); 
$tpl_index->setVar("slider", $slider);

/****************************
*****************************
*****************************/
if ($a_user['is_guest'])
{
	if ($smtp_h<>'')
		$sidebar_guest.= "Mail with your password will be sent to your e-mail."; 

	$tpl_sidebar->setVar("sidebar_guest.smtp",$sidebar_guest);
	$tpl_sidebar->setVar("sidebar_guest.imagepath", 'styles/'.$style.'/images/');
	if ($voteurls[1]<>'') 
		$tpl_sidebar->setVar("sidebar_vote.vote1",'<a href="'.$voteurls[1].'" title="" target="_blank"><img src="styles/'.$style.'/images/1.jpg" alt=""></a>');
	else 
		$tpl_sidebar->setVar("sidebar_vote.vote1",'');
	
	$i=2;
	$votedata2=false;
	while ($i<=count($voteurls))
	{
		$votedata2.='<a href="'.$voteurls[$i].'" title="" target="_blank"><img src="styles/'.$style.'/images/'.$i.'.jpg" alt="[Vote here]"></p><p>';
		$i++;
	}
	if ($votedata2)
		$tpl_sidebar->setVar("sidebar_vote.vote2", $votedata2);
	else
		$tpl_sidebar->setVar("sidebar_vote.vote2",'');
}
else
{
	$tpl_sidebar->setVar("sidebar_loggedin.username", ucfirst(strtolower($a_user[$db_translation['login']])));
	$tpl_sidebar->setVar("sidebar_loggedin.gm", $a_user['dp']);
	$tpl_sidebar->setVar("sidebar_loggedin.vp", $a_user['vp']);
	
	$tpl_sidebar->setVar("sidebar_loggedin.vp", $a_user['vp']);
	
	if ($a_user[$db_translation['banned']]=='0')
	{
		$banned= '<font class="colorgood">Not Banned</font><br>';
	}
	else 
	{
		$banned= '<font class="colorbad"><strong>Banned!</strong><br>'; 
		if ($a_user['banreason']<>'')
		{ 
			$banned.= ' Reason: "'.$a_user['banreason'].'"';
		} 
		$banned.= '</font>';
	}
	 
	if($a_user[$db_translation['lastip']]<>get_remote_address())
	{
		$banned.= '<br /><strong>Last IP:</strong> <font size="1">'.$a_user[$db_translation['lastip']].'</font><br><strong>Your IP:</strong> <font size="1">'.get_remote_address().'.</font>'; $banned.='<br /><br /><a href="./quest.php?name=passchange">&raquo; Change pass now!</a>';
	}; 
	$tpl_sidebar->setVar("sidebar_loggedin.banned",$banned);
}

//Get the GM accounts for the GM's online
if ($server_core == 'trinity' or $server_core == 'trinity_ra')
{
	$res = $ACC_PDO->query("SELECT * FROM `account_access` WHERE `".$db_translation['gm']."` IN (".$db_translation['az'].", ".$db_translation['a'].")");
	//filter the array, we dont need double records if we have RealmID -1	
	$gmAccounts = array();
	while ($row = $res->fetch(PDO::FETCH_ASSOC))
	{
		if (isset($gmAccounts[$row['id']]))
		{
			if ($row['RealmID'] == '-1')
			{
				$gmAccounts[$row['id']] = '-1';
			}
			else
			{
				if (is_array($gmAccounts[$row['id']]))
					array_push($gmAccounts[$row['id']], $row['RealmID']);
			}
		}
		else
		{
			if ($row['RealmID'] == '-1')
			{
				$gmAccounts[$row['id']] = '-1';
			}
			else
			{
				//we dont have taht account in the array
				$gmAccounts[$row['id']] = array($row['RealmID']);
			}
		}
	}
	unset($res);
}
else
{
	$res = $ACC_PDO->query("SELECT ".$db_translation['acct'].", ".$db_translation['gm']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['gm']."` IN (".$db_translation['az'].", ".$db_translation['a'].")");
	$gmAccounts = array();
	while ($row = $res->fetch(PDO::FETCH_ASSOC))
	{
		array_push($row[$db_translation['acct']], $gmAccounts);
	}
	unset($res);
}

//a function to extract the GM accounts for given realm from array
function parseArrayForRealm($id, $array)
{
	$arr = array();
	foreach ($array as $accId => $realms)
	{
		//if the account is for all realms, put the acc id in the temp array
		if ($realms == '-1')
		{
			array_push($arr, $accId);
		}
		else
		{
			//if the account has specified realms, check if the realm is in the realms data for this account
			if (is_array($realms) and in_array($id, $realms))
			{
				array_push($arr, $accId);
			}
		}
	}
	//return array or false
	return (count($arr) > 0 ? $arr : false);
}

///REALMS, by ChoMPi! AXE NUB!
foreach ($realm as $id => $data)
{
	//open database connection
	$REALM_DB = newRealmPDO($id);
	
	//$res2 = $REALM_DB->prepare("SELECT COUNT(".$db_translation['characters_guid'].") AS totchar FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_online']."` = '1'");
	//$res2->execute() or error('Something is wrong with characters table in server #'.$i.' database. <br><br></strong>MySQL reported:<strong> '.$res2->errorInfo().'.<br><br></strong>', __FILE__, __LINE__);
	
	//count the GMs
	if ($server_core == 'trinity' or $server_core == 'trinity_ra')
	{
		//get the accounts with GM permissions for this realm
		$gmAccountsRealm = parseArrayForRealm($id, $gmAccounts);
		//if we have GM's for this realm
		if ($gmAccountsRealm)
		{
			//if the array contains single record
			if (count($gmAccountsRealm) == 1)
			{
				$gmQueryString = "= '" . $gmAccountsRealm[0] . "'";
			}
			else
			{
				//more than one account
				$gmQueryString = "IN (";
				$gmQueryString .= implode(", ", $gmAccountsRealm);
				$gmQueryString .= ")";
			}
						
			$resgm = $REALM_DB->prepare("SELECT COUNT(".$db_translation['characters_guid'].") AS gmchars FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_online']."` = '1' AND `".$db_translation['characters_acct']."` ".$gmQueryString);
			$resgm->execute();
			$rowgm = $resgm->fetch(PDO::FETCH_ASSOC);
			unset($resgm);
			$gmCount = $rowgm['gmchars'];
		}
		else
		{
			//no GM's return 0 ?
			$gmCount = '0';
		}
	}
	else
	{
		//check if we have gm accounts
		if (count($gmAccounts) > 0)
		{
			if (count($gmAccounts) == 1)
			{
				$gmQueryString = "= '" . $gmAccounts[0] . "'";
			}
			else
			{
				//more than one account
				$gmQueryString = "IN (";
				$gmQueryString .= implode(", ", $gmAccounts);
				$gmQueryString .= ")";
			}

			$resgm = $REALM_DB->prepare("SELECT COUNT(".$db_translation['characters_guid'].") AS gmchars FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_online']."` = '1' AND `".$db_translation['characters_acct']."` ".$gmQueryString);
			$resgm->execute();
			$rowgm = $resgm->fetch(PDO::FETCH_ASSOC);
			unset($resgm);
			$gmCount = $rowgm['gmchars'];
		}
		else
		{
			$gmCount = '0';
		}
	}
		
	//count the Alliance
	$res3 = $REALM_DB->prepare("SELECT COUNT(".$db_translation['characters_guid'].") AS achars FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_online']."` = '1' AND `".$db_translation['characters_race']."` IN (1, 3, 4, 7, 11)");
	$res3->execute() or error('Something is wrong with characters table in first server database. <br><br></strong>MySQL reported:<strong> '.$res1->errorInfo().'.<br><br></strong>', __FILE__, __LINE__);
	$allyRes = $res3->fetch(PDO::FETCH_ASSOC);
	
	//Count the Horde
	$res4 = $REALM_DB->prepare("SELECT COUNT(".$db_translation['characters_guid'].") AS hchars FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_online']."` = '1' AND `".$db_translation['characters_race']."` IN (2, 5, 6, 8, 10)");
	$res4->execute() or error('Something is wrong with characters table in first server database. <br><br></strong>MySQL reported:<strong> '.$res1->errorInfo().'.<br><br></strong>', __FILE__, __LINE__);
	$hordeRes = $res4->fetch(PDO::FETCH_ASSOC);

	//get the count
	$allyCount = $allyRes['achars'];
	$hordeCount = $hordeRes['hchars'];
	$totalCount = $allyCount + $hordeCount;
							
	//Select realm UpTime some shit
	$res = $ACC_PDO->prepare("SELECT * FROM `".$acc_db."`.`uptime` WHERE `RealmID` = :realmid ORDER BY starttime DESC LIMIT 1");
	$res->bindParam(':realmid', $id, PDO::PARAM_INT);
	$res->execute();

	$accRow = $res->fetch(PDO::FETCH_ASSOC);
	
	unset($res);
	
	$seconds= $accRow['uptime'];
	$days = floor($seconds / 86400);
    $hours = floor($seconds % 86400 / 3600);
    $minutes = floor($seconds % 3600 / 60);
    $seconds = $seconds % 60;
		
	unset($res3);
	unset($res4);
					
	$tpl_sidebar->gotoNext("realms");
	$tpl_sidebar->setVar("realms.uptime","".$days."d&nbsp;".$hours."h&nbsp;".$minutes."m&nbsp;");
	$tpl_sidebar->setVar("realms.s1name",$data['name']);
	$tpl_sidebar->setVar("realms.realm_description", $data['descr']);
	$tpl_sidebar->setVar("realms.online1","<span id='server".$id."'></span><script type='text/javascript'>ajax_loadContent('server".$id."','./dynamic/status.php?id=".$id."');</script>");
	$tpl_sidebar->setVar("realms.totcharacters", $totalCount);
	$tpl_sidebar->setVar("realms.gmCount", $gmCount);
	$tpl_sidebar->setVar("realms.AllianceCount", $allyCount);
	$tpl_sidebar->setVar("realms.HordeCount", $hordeCount);
	$i++;
	
	unset($REALM_DB);
}

###############################################
## TOP ARENA TEAMS by ChoMPi
###############################################

//loop the realms
foreach ($TopArenaTeams as $data)
{
	$TC2 = false;
	if (isset($data['TC2']))
	{
		$TC2 = true;
	}
	
	$teams = new TopArenaTeams($TC2);
	
	$REALM_DB = newRealmPDO($data['realmid']);
	
	if ($REALM_DB)
	{
		$teams->setDatabase($REALM_DB);
		
		//get the team resources
		$res = $teams->getTeams($data['limit']);
		//if we have resources
		if ($res)
		{
			$html = '
			<div class="sidebar_box">
				<div class="sidebar_box_head"><p>TOP '.$data['limit'].' ARENA ('.$realm[$data['realmid']]['name'].')</p><span></span></div>
  				<div class="sidebar_box_cont arena_top_teams">
  					<ul>
    					<li id="head">
      						<span class="number">N</span>
      						<span class="t_name">Team Name</span>
      						<span class="t_rating">Rating</span>
      						<span class="t_faction">Faction</span>
    					</li>';
			
			$i = 1;
			while ($row = $res->fetch(PDO::FETCH_ASSOC))
			{
				$html .= ' 
    				<li>
     					<span class="number">'.$i.'</span>
      					<span class="t_name">
							<a style="cursor: pointer;" rel="top-arena-tooltip" realm="'.$data['realmid'].'" teamid="'.$row['arenateamid'].'">
								'.$row['name'].'
							</a>
						</span>
      					<span class="t_rating">'.$row['rating'].'</span>
      					<span class="t_faction" id="'.$data['realmid'].'-'.$i.'">
							&nbsp;Loading...
							<script type="text/javascript">
								$(document).ready(function()
								{
									resolveFaction(\''.$data['realmid'].'-'.$i.'\', \''.$row['captain'].'\', \''.$data['realmid'].'\');
								});
							</script>
						</span>
    				</li>';
				$i++;
			}
			unset($res);
			
			$html .= '
			  		</ul>
 				</div>
			</div>';
			$tpl_sidebar->gotoNext("TopArena");
			$tpl_sidebar->setVar("TopArena.HTML", $html);
		}
	}
	unset($REALM_DB);
	unset($teams);
}

##############################################

## SHOUTBOX ##################################
##############################################

if (!isset($_SESSION['user'])) 
{
      $tpl_sidebar->setVar("shoutbox","
	  <div class='sidebar_box'>
      	<div class='sidebar_box_head'><p>SHOUTBOX</p></div> 
	  	<div class='sidebar_box_cont'>
	  		Login to use the shoutbox
	  	</div>
      </div>
	  ");
}
else
{
	 $tpl_sidebar->setVar("shoutbox","
	 <div class='sidebar_box'>
     	<div class='sidebar_box_head'><p>SHOUTBOX</p></div> 
	 	<div class='sidebar_box_cont'>
	 		<form method='post' id='shout-box-form'>
     			<input type='hidden' id='shout-box-nick' value='".$_SESSION['user']."' />
    			<textarea id='shout-box-message' style='width: 98%; height: 50px;'></textarea><br/>
	 			<div id='log-b'><input type='submit' value='Shout' /></div>
	 		</form> 
	 	</div>
    </div>");
}


//right sidebar print:
$tpl_index->setVar("sidebar_content", $tpl_sidebar->toString()); 
//ShoutBoxComments

//FINALLY PRINT BODY TEMPLATE 
echo $tpl_index->toString();

$tpl_footer = new Template("styles/".$style."/footer.php");
$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
echo $tpl_footer->toString();

