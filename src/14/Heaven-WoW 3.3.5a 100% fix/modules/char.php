<?php
if (!defined('AXE')) exit;

//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

if (isset($_POST['unstuck'])) 
{
	$realmid = (int)$_POST['realm'];
	
	$REALM_DB = newRealmPDO($realmid);
	
	if ($REALM_DB)
	{
		$char_guid = (int)$_POST['char_guid'];
	
		$a = unstuck($char_guid);
		if ($a)
		{
			box ('Fail', $a);
		}
		else
		{
			box ('Success','Your character has been unstuck! It is now located at its innkeeper. All auras has been cleared and the character was revived. You must be logged out for this to work.');
		}
	}
	else
	{
		box ('Fail', 'Failed to connect to the Realm Database.');
	}
	
	unset($REALM_DB);
	
	$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
} 

foreach ($realm as $id => $data)
{
	$cont2.= '<br>'.$data['name'];
	
	//make database connection
	$REALM_DB = newRealmPDO($id);
	
	$res = $REALM_DB->prepare("SELECT * FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_acct']."` = :accid");
	$res->bindParam(':accid', $a_user[$db_translation['acct']], PDO::PARAM_INT);
	$res->execute();
		
	while ($char = $res->fetch(PDO::FETCH_ASSOC))
	{
		//set race
		if ($char[$db_translation['characters_race']] == "1" || $char[$db_translation['characters_race']] == "3" || $char[$db_translation['characters_race']] == "4" || $char[$db_translation['characters_race']] == "7" || $char[$db_translation['characters_race']]=="11")
		{ 
			$side="0"; 
		}
		else
		{
			$side="1";
		}
		//set avvy
		if ($char[$db_translation['characters_level']]<="50") 
		{
			$avvy = "<img src='./images/portraits/wow-default/".$char[$db_translation['characters_gender']]."-".$char[$db_translation['characters_race']]."-".$char[$db_translation['characters_class']].".gif' border='0' class='avatar'>"; 
		} 
		elseif ($char[$db_translation['characters_level']]>="51" && $char[$db_translation['characters_level']]<="69" )
		{
			$avvy = "<img src='./images/portraits/wow/".$char[$db_translation['characters_gender']]."-".$char[$db_translation['characters_race']]."-".$char[$db_translation['characters_class']].".gif' border='0' class='avatar'>";  
		}
		else 
		{
			$avvy = "<img src='./images/portraits/wow-70/".$char[$db_translation['characters_gender']]."-".$char[$db_translation['characters_race']]."-".$char[$db_translation['characters_class']].".gif' border='0' class='avatar'>"; 
		}
		
		
		//end
		//set money
		$gold=substr($char[$db_translation['characters_gold']], 0, -4); if ($gold=='') {$gold="0";}
		$silver=substr($char[$db_translation['characters_gold']], 0, -2); 
		$silver2=substr($silver, -2); if ($silver2=='') {$silver2="0";}
		$copper=substr($char[$db_translation['characters_gold']], -2); if ($copper=='') {$copper="0";}
		
		$cont2.= '<form action="" method="post">';
		
		$cont2.= '<input name="char_guid" type="hidden" value="'.$char[$db_translation['characters_guid']].'" />';
		$cont2.= '<input name="realm" type="hidden" value="'.$id.'" />';
		
		$cont2.= '<br>';
		$cont2.= '<table width="100%" border="0" style=" background-color:#181818; border: solid 1px black;" cellpadding="3">
		<tr>
		<td width="70">'.$avvy.'</td>
		<td valign="top" align="right"><strong>'.$char[$db_translation['characters_name']].'</strong> - Level: '.$char[$db_translation['characters_level']].'  - Money: '.$gold.'g '.$silver2.'s '.$copper.'c 
		<br><br><img src="./images/icon/class/'.$char[$db_translation['characters_class']].'.gif" title="Class" />&nbsp;&nbsp;<img src="./images/icon/race/'.$char[$db_translation['characters_race']].'-'.$char[$db_translation['characters_gender']].'.gif"  title="Race" />&nbsp;&nbsp;<img src="./images/icon/pvpranks/rank_default_'.$side.'.gif"  title="Faction" /><br>
		</td>
		<td width="100px"  valign="middle" style="text-align:right">
		<div id="log-b2"><input type="submit" name="unstuck" value="Unstuck" /></div></td>
		</tr>
		</table>';
		$cont2.= '</form>';
	}
	unset($res);
	unset($REALM_DB);
}
	
//#########################################CHAR END
$cont2.='<br /><br />';

$box_wide->setVar("content_title", "Characters");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
							
?>					