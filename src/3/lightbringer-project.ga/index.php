<?php
require_once("header.php"); 
//right sidebar template
$tpl_sidebar = new Template("styles/".$style."/sidebar.php"); 
$tpl_index = new Template("styles/".$style."/index_body.php");
//
//this is content,  the middle section
//
if ($upozorenje<>'')
$tpl_index->setVar("account_warnning", upozorenje($upozorenje));
//vote buttons
if (count($voteurls)>='1')
include_once "vote_links.php";
 //$vote_links;


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


/****************************
*****************************
*****************************/
if ($a_user['is_guest'])
{

if ($smtp_h<>'') $sidebar_guest.= "Mail with your password will be sent to your e-mail."; 

$tpl_sidebar->setVar("sidebar_guest.smtp",$sidebar_guest);
$tpl_sidebar->setVar("sidebar_guest.imagepath", 'styles/'.$style.'/images/');
if ($voteurls[1]<>'') 
	$tpl_sidebar->setVar("sidebar_vote.vote1",'<a href="'.$voteurls[1].'" title="" target="_blank"><img src="styles/'.$style.'/images/1.jpg" alt=""></a>');
else 
	$tpl_sidebar->setVar("sidebar_vote.vote1",'');
	
$i=2;$votedata2=false;
while ($i<=count($voteurls))
{
	$votedata2.='<a href="'.$voteurls[$i].'" title="" target="_blank"><img src="styles/'.$style.'/images/'.$i.'.jpg" alt="[Vote here]"></p><p>';
	$i++;
}
	if ($votedata2)
		$tpl_sidebar->setVar("sidebar_vote.vote2",$votedata2);
	else
		$tpl_sidebar->setVar("sidebar_vote.vote2",'');
}
else
{
	$tpl_sidebar->setVar("sidebar_loggedin.username",ucfirst(strtolower($a_user[$db_translation['login']])));
	$tpl_sidebar->setVar("sidebar_loggedin.gm",$a_user['dp']);
	$tpl_sidebar->setVar("sidebar_loggedin.vp",$a_user['vp']);
	
	$tpl_sidebar->setVar("sidebar_loggedin.vp",$a_user['vp']);
	
	if ($a_user[$db_translation['banned']]=='0') {
		$banned= '<font class="colorgood">Not Banned</font><br>';
	} else 
	{
		$banned= '<font class="colorbad"><strong>Banned!</strong><br>'; if ($a_user['banreason']<>'') { $banned.= ' Reason: "'.$a_user['banreason'].'"';} $banned.= '</font>';
	}
	 
	if($a_user[$db_translation['lastip']]<>get_remote_address()) {$banned.= '<br /><strong>Last IP:</strong> <font size="1">'.$a_user[$db_translation['lastip']].'</font><br><strong>Your IP:</strong> <font size="1">'.get_remote_address().'.</font>'; $banned.='<br /><br />'; }; 
	$tpl_sidebar->setVar("sidebar_loggedin.banned",$banned);
	
	
	
	if ($a_user[$db_translation['gm']]==$db_translation['az'])
    $tpl_sidebar->gotoNext("sidebar_loggedin");
	$tpl_sidebar->setVar("sidebar_loggedin", $b);
	$b = array("descr2" 		=> "Logout here.",
				   "title2"		=> "Logout",
				   "linkpath2" 	=>'quest.php?name=logout&hash='.$u.'.'.$p);
	$tpl_sidebar->gotoNext("sidebar_loggedin");
	$tpl_sidebar->setVar("sidebar_loggedin", $b);
	

	

}

						$db->select_db($realm[1]['db']) or error('Unable to select characters database. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Suggestion:<strong> Please open "config.php" file, find variable $realm[1], and enter correct database name, this is first server database', __FILE__, __LINE__);
						$onl=$db->query("SELECT COUNT(".$db_translation['characters_guid'].") AS totchar FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_online']."='1'") or error('Something is wrong with characters table in first server database. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>', __FILE__, __LINE__);
					//	$sql1 = $db->query("SELECT * FROM ".$acc_db.".uptime WHERE RealmID='1' order by starttime DESc limit 1")or die(mysql_error());
                        $sql1 = $db->query("SELECT * FROM `".$acc_db."`.`uptime` WHERE  starttime")or die(mysql_error());
	$sql2=$db->fetch_assoc($sql1);
			$seconds= $sql2['uptime'];
	
	$days = floor($seconds / 86400);
    $hours = floor($seconds % 86400 / 3600);
    $minutes = floor($seconds % 3600 / 60);
    $seconds = $seconds % 60;
	$tpl_sidebar->setVar("uptime","".$days."d&nbsp;".$hours."h&nbsp;".$minutes."m&nbsp;");

						$totchar = $db->fetch_assoc($onl);
						$tpl_sidebar->setVar("s1name",$realm[1]['name']);
						$tpl_sidebar->setVar("online1","<span id='server1'></span><script type='text/javascript'>ajax_loadContent('server1','./dynamic/status.php?id=1');</script>");
						$tpl_sidebar->setVar("totcharacters",$totchar['totchar']);

					$i=2;
					while ($i<=count($realm))
					{
						$db->select_db($realm[$i]['db']) or error('Unable to select characters database. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Suggestion:<strong> Please open "config.php" file, find variable $realm['.$i.'], and enter correct database name, this is first server database', __FILE__, __LINE__);
						$onl=$db->query("SELECT COUNT(".$db_translation['characters_guid'].") AS totchar FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_online']."='1'") or error('Something is wrong with characters table in first server database. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>', __FILE__, __LINE__);
						
					$sql1 = $db->query("SELECT * FROM ".$acc_db.".uptime WHERE RealmID='$i' order by starttime DESc limit 1")or die(mysql_error());

	$sql2=$db->fetch_assoc($sql1);
			$seconds= $sql2['uptime'];

	$days = floor($seconds / 86400);
    $hours = floor($seconds % 86400 / 3600);
    $minutes = floor($seconds % 3600 / 60);
    $seconds = $seconds % 60;
	
						$totchar = $db->fetch_assoc($onl);
						
						$tpl_sidebar->gotoNext("server2and3");
						$tpl_sidebar->setVar("server2and3.uptime2","".$days."d&nbsp;".$hours."h&nbsp;".$minutes."m&nbsp;");
						$tpl_sidebar->setVar("server2and3.s2name",$realm[$i]['name']);
						$tpl_sidebar->setVar("server2and3.online2","<span id='server".$i."'></span><script type='text/javascript'>ajax_loadContent('server".$i."','./dynamic/status.php?id=".$i."');</script>");
						$tpl_sidebar->setVar("server2and3.totcharacters2",$totchar['totchar']);
						$i++;

					}
	


//right sidebar print:
$tpl_index->setVar("sidebar_content", $tpl_sidebar->toString()); 
//ShoutBoxComments

//FINALLY PRINT BODY TEMPLATE 
print $tpl_index->toString();
include "top.php";
$tpl_footer = new Template("styles/".$style."/footer.php");
print $tpl_footer->toString();
//include "./include/timer-footer.php";
?>