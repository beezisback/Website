<?php
require_once("header.php"); 
/*common include*/
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php"); 
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
/*end common include*/ 
?>
<td id="page2">
<?php
$cont1='<center><div class="realms_holder" style="padding: 10px;">';

$realmid = (int)$_GET['realm']; //only numbers

if (!isset($_GET['realm']) or $realmid == '')
{
	$realmid = 1;
}

$REALM_DB = newRealmPDO($realmid);

foreach ($realm as $id => $data)
{
	$cont1.=  '&nbsp;&nbsp;<a href="./hk.php?realm='.$id.'">'.$data['name'].'</a>&nbsp;&nbsp;';
	if ($realmid == $id)
	{
		$rname = $data['name'];
	}
}

$cont1.='</div></center>';
$box_simple_wide->setVar("content", $cont1);
print $box_simple_wide->toString();

if ($REALM_DB)
{
    //(c) AXE
	$cont2_title='Top Kills for the '.$rname.' Realm';
	 
	$cont2.= "<font size='2' face='Arial, Helvetica, sans-serif' color='white'>";
	$cont2.= "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
	$cont2.= "<tr height='30' valign='top'><td></td><td><u><a href='./honor.php?realm=".$realmid."'>Honor</a></u></td><td>HK's</td><td>Character</td><td>Level</td><td></td><td></td></tr>";

	$a = 1;
	
	if ($server_core=='trinity' or $server_core=='trinity_ra')
	{
		$res = $REALM_DB->prepare("SELECT * FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_honorPoints']."` <> '0' ORDER BY ".$db_translation['characters_killsLifeTime']." DESC LIMIT 20");
		$res->execute();
			
		// no banned and no 0 kills
		while ($char2 = $res->fetch(PDO::FETCH_ASSOC))
		{
			$resACC = $ACC_PDO->prepare("SELECT gmlevel, locked, ac.id, username FROM `account` AS ac LEFT JOIN `account_access` AS aa ON aa.id = ac.id LEFT JOIN `account_banned` AS ab ON ab.id = ac.id WHERE ac.id = :charAccId GROUP BY username");
			$resACC->bindParam(':charAccId', $char2[$db_translation['characters_acct']], PDO::PARAM_INT);
			$resACC->execute();
				
			$SQLwow3 = $resACC->fetch(PDO::FETCH_NUM);
				
			if (($SQLwow3[0]=="0" or $SQLwow3[0]=="") && ($SQLwow3[1]=="0" or $SQLwow3[1]==""))
			{
				//no gm's and banned accs
				if ($char2[race]=="1" || $char2[race]=="3" || $char2[race]=="4" || $char2[race]=="7" || $char2[race]=="11")
	            { 
					$side="0"; 
				}
				else
				{
					$side="1";
				}
				if ($char2[$db_translation['characters_online']]=="1")
				{
					$onl="lime";
				}
				else
				{
					$onl="white";
				}
				$cont2.= "<tr><td align='center'>$a. ";
				$cont2.= "<td align='center' >".$char2[$db_translation['characters_honorPoints']]." </td>";
				$cont2.= "<td align='center' style='font-size:14px'><strong>".$char2[$db_translation['characters_killsLifeTime']]."</strong> </td>";
				$cont2.= "<td align='center'><font color='$onl'>".$char2[$db_translation['characters_name']]."</font></td>";
				$cont2.= "<td align='center'>lvl <strong>".$char2[$db_translation['characters_level']]."</strong></td>";
				$cont2.= "<td align='center'><img src='images/icon/class/".$char2[$db_translation['characters_class']].".gif' title='Class' />&nbsp;<img src='images/icon/race/".$char2[$db_translation['characters_race']]."-".$char2[$db_translation['characters_gender']].".gif'  title='Race' /></td>";
				if ($SQLwow3[3]=='')
				{
					$SQLwow3[3] = '<span clas="colorbad"><i>Bugged.</i></span>';
				}
				$cont2.= "<td></td>";
				$cont2.= "</tr>";
				//increase the number
				$a++;
			}
			unset($resACC);
		}
		unset($res);
	}
	else
	{	
		$res = $REALM_DB->prepare("SELECT * FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_honorPoints']."` <> '0' ORDER BY ".$db_translation['characters_killsLifeTime']." DESC LIMIT 20");
		$res->execute();
			
		while ($char2 = $res->fetch(PDO::FETCH_ASSOC))
		{
			$resACC = $ACC_PDO->prepare("SELECT ".$db_translation['gm'].", ".$db_translation['banned'].", ".$db_translation['acct'].", ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['acct']."` = :charAccId");
			$resACC->bindParam(':charAccId', $char2[$db_translation['characters_acct']], PDO::PARAM_INT);
			$resACC->execute();
				
			$SQLwow3 = $resACC->fetch(PDO::FETCH_NUM);
							
			if (($SQLwow3[0]=="0" or $SQLwow3[0]=="") && ($SQLwow3[1]=="0" or $SQLwow3[1]==""))
			{ 
				//no gm's and banned accs
				if ($char2[race]=="1" || $char2[race]=="3" || $char2[race]=="4" || $char2[race]=="7" || $char2[race]=="11")
	            {
					$side="0";
				}
				else
				{
					$side="1";
				}
				if ($char2[$db_translation['characters_online']]=="1")
				{
					$onl="lime";
				}
				else
				{
					$onl="white";
				}
				$cont2.= "<tr><td align='center'>$a. ";
				$cont2.= "<td align='center' >".$char2[$db_translation['characters_honorPoints']]." </td>";
				$cont2.= "<td align='center' style='font-size:14px'><strong>".$char2[$db_translation['characters_killsLifeTime']]."</strong> </td>";
				$cont2.= "<td align='center'><font color='$onl'>".$char2[$db_translation['characters_name']]."</font></td>";
				$cont2.= "<td align='center'>lvl <strong>".$char2[$db_translation['characters_level']]."</strong></td>";
				$cont2.= "<td align='center'><img src='images/icon/class/".$char2[$db_translation['characters_class']].".gif' title='Class' />&nbsp;<img src='images/icon/race/".$char2[$db_translation['characters_race']]."-".$char2[$db_translation['characters_gender']].".gif'  title='Race' /></td>";
				if ($SQLwow3[3]=='')
				{
					$SQLwow3[3]= '<span clas="colorbad"><i>Bugged.</i></span>';
				}
				$cont2.= "<td></td>";
				$cont2.= "</tr>";
				//increase the number
				$a++;
			}
			unset($resACC);
		}
		unset($res);
	}
	
	$cont2.= "</table>";
	$cont2.= "</center>";
}
else
{
	box('Fail', 'Cannot connection to the Realm Database.');
}

$box_wide->setVar("content_title", $cont2_title); 
$box_wide->setVar("content", $cont2);
print $box_wide->toString();
	?></td><?php
	
$tpl_footer = new Template("styles/".$style."/footer.php");
$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
print $tpl_footer->toString();
?>