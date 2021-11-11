<div id="menu">
<ul>
<li><a href="index.wow">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li class="active">Account Manager | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
<?php
if (!defined('AXE'))
	exit;
if (!isset($_SESSION['user'])) 
{
include "content.php";
header("Location: accounts.wow");
include "top.php";
	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
}

	//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include
if (isset($_POST['unstuck'])) 
{
	$realmid=$_POST['realm'];
	$realmid = preg_replace( "/[^0-9]/", "", $_POST['realm'] ); //only letters and numbers
	
	
	$i=1;
	while ($i<=count($realm))
	{
		if ($realmid==$i)
		{
			$db->select_db($realm[$i]['db']);
		}
	
		$i++;
	}
	
	
	$char_guid = preg_replace( "/[^0-9]/", "", $_POST['chars'] ); //only letters and numbers
	$a=unstuck($char_guid);
	if ($a)
	{
		box ('Fail',$a);
	}
	else
	{
		box ('Account Manager','Your character has been unstuck! It is now located at its innkeeper. All auras has been cleared and the character was revived. You must be logged out for this to work.');
	}

		

	
	$tpl_footer = new Template("styles/".$style."/footer.php");
	include "top.php";
	print $tpl_footer->toString();
	exit;
} 

$cont2='<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
</p><p style="clear: both;"></p>
	<table>
		<tbody><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Home" href="accounts.wow"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/home.png" border=""><br>Home</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Get Item" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/getitem.png" border=""><br>Get Item</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donate" href="account.wow?i=donate"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/donate.png" border=""><br>Donate</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Teleport" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/teleport.png" border=""><br>Teleport</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Unstucker" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/unstucker.png" border=""><br>Unstucker</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Vote" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/vote.png" border=""><br>Vote</a></td>
	</tr><tr height="20"></tr><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="SMS" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/sms.png" border=""><br>SMS</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="change" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/pass.png" border=""><br>Change Pass</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="change" href="#"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/transfer.png" border=""><br>Transfer</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Gold" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/gold.png" border=""><br>Gold</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Level" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/up.png" border=""><br>Level</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" target="hidd" title="Logout" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/logout.png" border=""><br>Logout</a></td>
	</tr>
</tbody></table>
		<br>
		<p>If your character has become stuck, you can use this option to return it to your hearthstone location.</p> <br>
		
';



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
	<form method="POST" action="">
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
	
	
$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
							
?>	
<?php
include "top.php";		
?>		