<?php
if (!defined('AXE'))
	exit;
	
//if session set, then we shoudlnt be here
isLoggedInOrReturn();

if ($a_user[$db_translation['gm']] < $db_translation['az'])
{
	alert_box('You do not have access to this page.<br><br><a href="index.php">Go Back.</a>');
}

//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

if (isset($_POST['action'])) 
{
	$acclogin = $_POST['login'];
	$acctid = (int)$_GET['id']; //only numbers  
	$psw = $_POST['psw']; //only letters and numbers
	$gm = $_POST['gm']; //only numbers  0 or 1
	$gm_realm = (int)$_POST['gm_realm']; //only numbers  0 or 1
	$gm2 = preg_replace( "/[^A-Za-z0-9-]/", "", $_POST['gm'] );
	$banned = preg_replace( "/[^01]/", "", $_POST['banned'] ); //only numbers  0 or 1
	if ($banned=='')
	{
		$banned='0';
	}
	$flags = (int)$_POST['flags']; //only numbers  
	if ($flags=='')
	{
		$flags='8';
	}
	
	//$banreason = preg_replace( "/[^A-Za-z0-9]/", "", $_POST['banreason'] );
	//check pass:
	if (isset($_POST['psw']) and $_POST['psw'] != '')
	{		
		$text1 = passchange($psw, $acctid);
		$text1 .= "<br>The account info was updated.<br>";
		//box ( "Updated",$text1 );
	}
	else
	{
		$text1 = '';
		
		//query without pass
		$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET `".$db_translation['banned']."` = :banned, `".$db_translation['flags']."` = :flags WHERE `".$db_translation['acct']."` = :acc LIMIT 1");
		$update->bindParam(':banned', $banned, PDO::PARAM_INT);
		$update->bindParam(':flags', $flags, PDO::PARAM_INT);
		$update->bindParam(':acc', $_POST['acct'], PDO::PARAM_INT);
		$update->execute();
		
		if ($server_core=='trinity' or $server_core=='trinity_ra')
		{
			if ($a_user['web_master'] == '1' and isset($_POST['gm']) and $gm != '')
			{
				//update gm status
				$gmstatus1 = $ACC_PDO->prepare("SELECT * FROM `account_access` WHERE `RealmID` = :realm AND `id` = :id LIMIT 1");
				$gmstatus1->bindParam(':realm', $gm_realm, PDO::PARAM_STR);
				$gmstatus1->bindParam(':id', $acctid, PDO::PARAM_INT);
				$gmstatus1->execute();
				
				if ($gmstatus1->rowCount() == 0)
				{
					if ($gm_realm == '-1')
					{
						$del = $ACC_PDO->prepare("DELETE FROM `account_access` WHERE `id` = :acc AND `RealmID` != '-1'");
						$del->bindParam(':acc', $acctid, PDO::PARAM_INT);
						$del->execute();
						unset($del);
					}
					
					//create new row
					$insert = $ACC_PDO->prepare("INSERT INTO `account_access` (id, gmlevel, RealmID) VALUES (:acc, :gm, :realm)");
					$insert->bindParam(':acc', $acctid, PDO::PARAM_INT);
					$insert->bindParam(':gm', $gm, PDO::PARAM_INT);
					$insert->bindParam(':realm', $gm_realm, PDO::PARAM_STR);
					$insert->execute();
					unset($insert);
					$text1 = "In-game GM Level was updated.<br>";
				}
				elseif($gmstatus1->rowCount() == 1)
				{
					if ($gm_realm == '-1')
					{
						$del = $ACC_PDO->prepare("DELETE FROM `account_access` WHERE `id` = :acc AND `RealmID` != '-1'");
						$del->bindParam(':acc', $acctid, PDO::PARAM_INT);
						$del->execute();
						unset($del);
					}
					if ($gm_realm != '-1')
					{
						$del = $ACC_PDO->prepare("DELETE FROM `account_access` WHERE `id` = :acc AND `RealmID` = '-1'");
						$del->bindParam(':acc', $acctid, PDO::PARAM_INT);
						$del->execute();
						unset($del);
					}
					
					//update old one
					$update = $ACC_PDO->prepare("UPDATE `account_access` SET `".$db_translation['gm']."` = :gm WHERE `id` = :acc AND `RealmID` = :realm LIMIT 1");
					$update->bindParam(':acc', $acctid, PDO::PARAM_INT);
					$update->bindParam(':gm', $gm, PDO::PARAM_INT);
					$update->bindParam(':realm', $gm_realm, PDO::PARAM_STR);
					$update->execute();
					unset($update);
					$text1 = "In-game GM Level was updated.<br>";
				}
				unset($gmstatus1);
			}
		}
		
		$text1 .= "The account info was updated, the password was not changed.<br>";
		//box ( "Updated","Server account info updated! Password not changed." );
	}
	
	//check additional data
	if($_POST['additional'] == '1')
	{
		$vp = (int)$_POST['vp']; //only numbers
		if ($vp=='')
		{
			$vp=0;
		}
		$dp = (int)$_POST['dp']; //only numbers
		if ($dp=='')
		{
			$dp=0;
		}
		$question_id = (int)$_POST['question_id']; //only numbers 1234
		if ($question_id=='')
		{
			$question_id=1;
		}
		$answer = $_POST['answer']; //only letters and numbers
		if ($answer=='')
		{
			$answer='blackhell';
		}
		
		//additional data query
		$update = $WEB_PDO->prepare("UPDATE `accounts_more` SET `vp` = :vp, `question_id` = :question, `answer` = :answer, `dp` = :dp WHERE UPPER(acc_login) = :login");
		$update->bindParam(':vp', $vp, PDO::PARAM_INT);
		$update->bindParam(':question', $question_id, PDO::PARAM_INT);
		$update->bindParam(':answer', $answer, PDO::PARAM_STR);
		$update->bindParam(':dp', $dp, PDO::PARAM_INT);
		$update->bindParam(':login', $acclogin, PDO::PARAM_STR);
		$update->execute();
		unset($update);
			
		$text2 = "Additional data was updated.";
		
		$web_gmlevel = (int)$_POST['web_gmlevel'];
		
		if ($a_user['web_master'] == '1' and isset($_POST['web_gmlevel']) and ($web_gmlevel > 0 and $web_gmlevel != ''))
		{
			$update = $WEB_PDO->prepare("UPDATE `accounts_more` SET `gmlevel` = :gmlevel WHERE UPPER(acc_login) = :login");
			$update->bindParam(':gmlevel', $web_gmlevel, PDO::PARAM_INT);
			$update->bindParam(':login', $acclogin, PDO::PARAM_STR);
			$update->execute();
			unset($update);
			
			$text2 .= '<br>Website GM Level was update.';
		}
	}
	
	$cont2.= "<center><strong>Updated!</strong><br><br>";
	$cont2.= $text1.$text2."<br><br><u><a href='quest.php?name=admincp3&id=".$_GET['id']."'>Go back to user</a></u></center>";
	$box_wide->setVar("content_title", "User Manager");	
	$box_wide->setVar("content", $cont2);					
	print $box_wide->toString();
	
	$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}

if (isset($_GET['id'])) 
{   
	$a = $ACC_PDO->prepare("SELECT * FROM `".$db_translation['accounts']."` WHERE `".$db_translation['acct']."` = :id LIMIT 1");
	$a->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$a->execute();
	
	$acc = $a->fetch(PDO::FETCH_ASSOC);
	unset($a);
	
	$cont2.= '<br/><center><div class="sub-box1" align="left">';
	$cont2.= "<i>Editing user '".$acc[$db_translation['Login']]."':</i><br><br>";
	$cont2.= '<form action="./quest.php?name=admincp3&id='.$acc[$db_translation['acct']].'" method="post">
	<input name="" type="text" disabled="disabled" value="'.$acc[$db_translation['login']].'" /> - Username<br>
	<input name="acct" type="hidden" value="'.$acc[$db_translation['acct']].'" />
	<input name="login" type="hidden" value="'.$acc[$db_translation['login']].'" />
	<input name="psw" type="text" value="" /> - Passw. (Leave blank to not change.)<br>';
	$cont2.= '
	<input name="banned" type="text" value="'.$acc[$db_translation['banned']].'" /> - Banned (Value usually 1 or 0.)<br>
	<input name="flags" type="text" value="'.$acc[$db_translation['flags']].'" /> - Flags ('.$db_translation['expansion_normal'].' - WoW, '.$db_translation['expansion_tbc'].' - TBC, '.$db_translation['expansion_wotlk'].' - WOTLK)<br>';
	
	if ($server_core=='trinity' or $server_core=='trinity_ra')
	{
		if ($a_user['web_master'] == '1')
		{
			$cont2 .= '<input name="gm" type="text" placeholder="Enter GM Level" style="display: inline-block; float: left; width: 148px; margin-right: 4px;" />
			<input name="gm_realm" type="text" placeholder="Enter GM Realm" style="display: inline-block; width: 148px;" /> - In-game GM Level';
		}
	}
	
	$ad = $WEB_PDO->prepare("SELECT * FROM `accounts_more` WHERE UPPER(acc_login) = :login LIMIT 1") or die (mysql_error());
	$ad->bindParam(':login', $acc[$db_translation['login']], PDO::PARAM_STR);
	$ad->execute();
	
	if ($ad->rowCount() == 0)
	{
		$cont2.= "<br>No additional data for this user.<br><br><input name='additional' type='hidden' value='0' />";
	}
	else
	{
		$acd = $ad->fetch(PDO::FETCH_ASSOC);
		$cont2.= '<input name="additional" type="hidden" value="1" />';
		
		if ($a_user['web_master'] == '1')
		{
			$cont2.= '<input name="web_gmlevel" type="text"  value="'.$acd['gmlevel'].'" /> - Website GM Level';
		}

		$cont2.= '
		<input name="vp" type="text"  value="'.$acd['vp'].'" /> - Vote Points<br>
		<input name="dp" type="text"  value="'.$acd['dp'].'" /> - Donation Points<br>
		<input name="question_id" type="text"  value="'.$acd['question_id'].'" /> - Security Question ID<br>
		&nbsp;1 - Your middle name?<br>
		&nbsp;2 - Your birth town?<br>
		&nbsp;3 - Your pet\'s name?<br>
		&nbsp;4 - Your mother maiden name?<br><br>
		<input name="answer" type="text" value="'.$acd['answer'].'" /> - Security Answer<br>';
	}
	unset($ad);
	
	$cont2.= '
	<div id="log-b2"><input name="action" type="submit" value="Edit User"/></div>
	</form>
	<br><strong>Note:</strong> With passwords, only a-z, A-Z letters and numbers are allowed.
	</div></center>';
	
	$box_wide->setVar("content_title", "User Manager");	
	$box_wide->setVar("content", $cont2);					
	print $box_wide->toString();
}						
else
{
$cont2.='
<center>
<div class="sub-box1" align="left" style="width: 660px;">
<form action="./quest.php?name=admincp3&p=0" method="get">
	<input type="hidden" value="admincp3" name="name">
	User name : <br/>
	<input name="login" type="text" value="'.(isset($_GET['login']) ? $_GET['login'] : '').'" />
	<div id="log-b2">
		<input name="search" type="submit" value="Search"/>
	</div>
</form>
</div></center>';

$p = isset($_GET['p']) ? (int)$_GET['p'] : false;
$perPage = 10;

$pagies = new Pagination();

if (isset($_GET['search'])) 
{
	//count the accounts
	$count_res = $ACC_PDO->prepare("SELECT COUNT(*) FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` LIKE CONCAT('%', :login, '%')");
	$count_res->bindParam(':login', $_GET['login'], PDO::PARAM_STR);
	$count_res->execute();
	$count_row = $count_res->fetch(PDO::FETCH_NUM);
	$count = $count_row[0];			
	unset($count_res);

	//Let's setup our pagination
	$pagies->addToLink('?name='.$_GET['name'].'&login='.$_GET['login'].'&search=true');
						
	$pages = $pagies->calculate_pages($count, $perPage, $p);
	
	if ($count > 0)
	{
		$a = $ACC_PDO->prepare("SELECT * FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` LIKE CONCAT('%', :login, '%') ORDER BY ".$db_translation['login']." ASC LIMIT ".$pages['limit']);
		$a->bindParam(':login', $_GET['login'], PDO::PARAM_STR);
		$a->execute();
	}
}
else
{
	//count the accounts
	$count_res = $ACC_PDO->prepare("SELECT COUNT(*) FROM `".$db_translation['accounts']."`");
	$count_res->execute();
	$count_row = $count_res->fetch(PDO::FETCH_NUM);
	$count = $count_row[0];		
	unset($count_res);

	//Let's setup our pagination
	$pagies->addToLink('?name='.$_GET['name']);
						
	$pages = $pagies->calculate_pages($count, $perPage, $p);
	
	if ($count > 0)
	{
		$a = $ACC_PDO->prepare("SELECT * FROM `".$db_translation['accounts']."` ORDER BY ".$db_translation['acct']." DESC LIMIT ".$pages['limit']);
		$a->execute();
	}
}

	$cont2.='<br> 
	<div align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="3" class="dataTable-display" id="userManager">   
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>E-mail</th>
					<th>VP</th>
					<th>DP</th>
				</tr>
			</thead>
			<tbody>';
	if ($count > 0)
	{		
		while ($arr = $a->fetch(PDO::FETCH_ASSOC))
		{
			$res2 = $WEB_PDO->prepare("SELECT vp, dp FROM `accounts_more` WHERE `acc_login` = :login LIMIT 1");
			$res2->bindParam(':login', $arr[$db_translation['login']], PDO::PARAM_STR);
			$res2->execute();
		
			if ($res2->rowCount() > 0)
			{
				$arr2 = $res2->fetch();
				unset($res2);
			}
			else
			{
				$arr2 = array('vp' => 'none', 'dp' => 'none');
			}
		
			$cont2.='
			<tr>
				<td>' . $arr[$db_translation['acct']] . '</td>
				<td><a href="./quest.php?name=admincp3&id=' . $arr[$db_translation['acct']] . '">' . $arr[$db_translation['login']] . '</a></td>
				<td>' . $arr[$db_translation['email']] . '</td>
				<td>'.$arr2['vp'].'</td>
				<td>'.$arr2['dp'].'</td>
			</tr>';
		}
	}
	unset($a);
	
	$cont2.='</tbody>
		</table>
	</div>';
		
	if ($count > $perPage)
	{
		$cont2.='<br><center>
		<div class="sub-box1" align="center" style="width: 660px; height: 20px;">
			<ul class="pagination2">
				'.$pages['first'].'
				'.$pages['previous'].'
		 		'.$pages['pages'].'
				'.$pages['next'].'
				'.$pages['last'].'
        	</ul>
		</div></center>';
	}

$box_wide->setVar("content_title", "User Manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();
}
					