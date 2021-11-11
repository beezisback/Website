<div id="menu">
<ul>
<li><a href="index.wow">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li class="active">Account Manager | </li> <li><a href="#">Tools</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="#" target='_blank'>Forum</a></li>
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
if (isset($_POST['transfer'])) 
{
	$newAccount = $_POST['newAccount'];
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
	
	$newAccount = mysql_real_escape_string(html_entity_decode(htmlentities($newAccount)));
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
	<p> Here you can transfer your character(s) to a new account. The price of this service is 15000 Donation Points per transfer. </p>
	<br />
	
';

//***START DROPDOWN****(c)axe
	$user=$a_user[$db_translation['login']];
	$db->select_db($acc_db);
	$SQLwow ="SELECT * from ".$db_translation['accounts']." where ".$db_translation['login']."='".$db->escape($a_user[$db_translation['login']])."'";
	$SQLwow2=mysql_query($SQLwow) or die("Could not get user character information".mysql_error());
	$SQLwow3=mysql_fetch_array($SQLwow2);
	
	
	$i=1;
	while ($i<=count($realm))
	{
		
	$cont2.= '
	<form style="text-align: center;" action="" method="post">
	<input name="realm" type="hidden" value="'.$i.'" />
	<select name="chars" style="width: 200px;">
    <option selected="selected"  value="">Select your character</option>
	';
	
	$db->select_db($realm[$i]['db']);
	$SQLawow ="SELECT * from ".$db_translation['characters']." where ".$db_translation['characters_acct']."='".$SQLwow3[$db_translation['acct']]."'";
	$char=mysql_query($SQLawow) or die("Could not get user character information");
		
	while ($char2=mysql_fetch_array($char))
		{

	
	$cont2.= '<option value="'.$char2[$db_translation['characters_guid']].'">'.$realm[$i][''].' '.$char2[$db_translation['characters_name']].'</option>';
	
	}
		$i++;					
	}

$cont2.= "</select><br><br>";

$cont2.='<tr><td><b>Transfer To</b></td>
		<td><input style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;" name="newAccount" type="textbox"></td>
<br /><br />';

$cont2.= '<input style="border: 1px solid black; height: 23px; width:100px" name="transfer" value="Transfer" type="submit">';
$cont2.= '</form>';
			
$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
							
?>	
<?php
include "top.php";		
?>		