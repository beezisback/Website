<?php
if (!defined('AXE')) exit;

if ($a_user['is_guest']) 
{
	print "You are not logged in."; $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}

//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

$data_Expansions[$db_translation['expansion_normal']] = array('key' => 'expansion_normal', 'string' => 'Vanilla');
$data_Expansions[$db_translation['expansion_tbc']] = array('key' => 'expansion_tbc', 'string' => 'The Burning Crusade');
$data_Expansions[$db_translation['expansion_wotlk']] = array('key' => 'expansion_wotlk', 'string' => 'Wrath of the Lick King');
$data_Expansions[$db_translation['expansion_cata']] = array('key' => 'expansion_cata', 'string' => 'Cataclysm');

if (isset($_POST['submit']))
{
	$expansion = $_POST['expansion'];
	
	if ($expansion != $a_user['expansion'])
	{
		//if the cofing for this exp is not set or it's set to true, allow the action
		if (!isset($config_Expansions['allowed'][$data_Expansions[$expansion]['key']]) or $config_Expansions['allowed'][$data_Expansions[$expansion]['key']] == true)
		{
			$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET  `".$db_translation['flags']."` = :flags WHERE `".$db_translation['login']."` = :login LIMIT 1");
			$update->bindParam(':login', strtoupper($a_user['username']), PDO::PARAM_STR);
			$update->bindParam(':flags', $expansion, PDO::PARAM_INT);
			$update->execute() or error('WTF Error!');
			
			$cont2.='
			<center>Account Expansion successfully changed to "'.$data_Expansions[$expansion]['string'].'".</center><br>
			<center><a href="./quest.php?name=account">Go back.</a></center><br>';
		}
		else
		{
			//this expansion is not allowed
			$cont2.='
			<center>Account Expansion change failed. Changing to "'.$data_Expansions[$expansion]['string'].'" is not allowed.</center><br>
			<center><a href="./quest.php?name=account">Go back.</a></center><br>';
		}
	}
	else
	{
		$cont2.='
		<center>Account Expansion successfully changed to "'.$data_Expansions[$expansion]['string'].'".</center><br>
		<center><a href="./quest.php?name=account">Go back.</a></center><br>';
	}
}
else
{
	$cont2= '
	<center>
    <div class="sub-box1" align="left">
	<center>Select an Expansion you wish to change to from the select form:</center>
	<br><br>
	<form method="POST" action="quest.php?name=exp_changer">
		<center><select name="expansion">';			
			$cont2 .= ($config_Expansions['allowed']['expansion_normal']) ? '<option value="'.$db_translation['expansion_normal'].'" '.(($a_user['expansion'] == $db_translation['expansion_normal']) ? 'selected="selected"' : '').'>Vanilla</option>' : '';
			$cont2 .= ($config_Expansions['allowed']['expansion_tbc']) ? '<option value="'.$db_translation['expansion_tbc'].'" '.(($a_user['expansion'] == $db_translation['expansion_tbc']) ? 'selected="selected"' : '').'>The Burning Crusade</option>' : '';
			$cont2 .= ($config_Expansions['allowed']['expansion_wotlk']) ? '<option value="'.$db_translation['expansion_wotlk'].'" '.(($a_user['expansion'] == $db_translation['expansion_wotlk']) ? 'selected="selected"' : '').'>Wrath of the Lick King</option>' : '';
			$cont2 .= ($config_Expansions['allowed']['expansion_cata']) ? '<option value="'.$db_translation['expansion_cata'].'" '.(($a_user['expansion'] == $db_translation['expansion_cata']) ? 'selected="selected"' : '').'>Cataclysm</option>' : '';
		$cont2 .= '
		</select></center>
		<br/>
	    <div id="log-b2">
			<center><input name="submit" type="submit" value="Change" /> </center>
		</div>
	</form>
	<br>
	</div></center>';
}
	
//*********************
$box_wide->setVar("content_title", "Account Expansion Changer");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	