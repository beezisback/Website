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
if (!$a_user['is_guest']) 
{

if (isset($_POST['action'])) 
{
	
	//lets select acc db
	mysql_select_db($acc_db);
	$a  = mysql_query("SELECT ".$db_translation['encrypted_password']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']." = '".$a_user[$db_translation['login']]."'") or die (mysql_error());
	$a2 = mysql_fetch_array($a);
	
	if ($a2[0]==sha1(strtoupper($a_user[$db_translation['login']]).':'.strtoupper(pun_htmlspecialchars(($_POST['pass_old']))))) 
	{
		if ($_POST['pass_new1']==$_POST['pass_new2'])
		{
		
			$tok=passchange($_POST['pass_new1']);
			if ($tok)
			{
				
				box('Account Manager','<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
</p><p style="clear: both;"></p>
	<table>
		<tbody><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Home" href="accounts.wow"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/home.png" border=""><br>Home</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Get Item" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/getitem.png" border=""><br>Get Item</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donation Shop" href="account.wow?i=Donation_Shop"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/Shopping.png" border=""><br>Donate Shop</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donate" href="account.wow?i=donate"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/donate.png" border=""><br>Donate</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Unstucker" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/unstucker.png" border=""><br>Unstucker</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Vote" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/vote.png" border=""><br>Vote</a></td>
	</tr><tr height="20"></tr><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Teleport" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/teleport.png" border=""><br>Teleport</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Change" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/pass.png" border=""><br>Change Pass</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Transfer" href="#"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/transfer.png" border=""><br>Transfer</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Gold" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/gold.png" border=""><br>Gold</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Level" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/up.png" border=""><br>Level</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" target="hidd" title="Logout" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/logout.png" border=""><br>Logout</a></td>
	</tr>
</tbody></table>

		<br>
<script type="text/javascript">
	alert("Password is changed from '.pun_htmlspecialchars($_POST['pass_old']).' to '.pun_htmlspecialchars($_POST['pass_new1']).'. Don t forget your password.");
</script>
<center> Password is changed from '.pun_htmlspecialchars($_POST['pass_old']).' to '.pun_htmlspecialchars($_POST['pass_new1']).'. <br /> Don t forget your password. </center>
		');     include "top.php";
			//	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');//
				//print $tpl_footer->toString();//
				exit;
			}
			if ($smtp_h='' && $smtp_u='')
			{
				//SMTP START
				$from = $title." Administration <noreply@web-wow.net>";
				$to = $login." <".$email.">";
				$subject = "Your Account Password";
				$body = "Hi, ".$login."\n\nPassword: ".$pass1."\n\nEnjoy your stay!\n\n".$domain_url;
				require_once "./smtp.php";
				box('Success', "Password is changed. <br><br>You will recive e-mail with your password."); $tpl_footer = new Template("styles/".$style."/footer.php");
			}
			else
			{
			box('Account Manager','<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
</p><p style="clear: both;"></p>
	<table>
		<tbody><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Home" href="accounts.wow"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/home.png" border=""><br>Home</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Get Item" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/getitem.png" border=""><br>Get Item</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donation Shop" href="account.wow?i=Donation_Shop"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/Shopping.png" border=""><br>Donate Shop</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donate" href="account.wow?i=donate"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/donate.png" border=""><br>Donate</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Unstucker" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/unstucker.png" border=""><br>Unstucker</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Vote" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/vote.png" border=""><br>Vote</a></td>
	</tr><tr height="20"></tr><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Teleport" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/teleport.png" border=""><br>Teleport</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Change" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/pass.png" border=""><br>Change Pass</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Transfer" href="#"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/transfer.png" border=""><br>Transfer</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Gold" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/gold.png" border=""><br>Gold</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Level" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/up.png" border=""><br>Level</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" target="hidd" title="Logout" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/logout.png" border=""><br>Logout</a></td>
	</tr>
</tbody></table>

		<br>
<script type="text/javascript">
	alert("Password is changed from '.pun_htmlspecialchars($_POST['pass_old']).' to '.pun_htmlspecialchars($_POST['pass_new1']).'. Don t forget your password.");
</script>
<center> Password is changed from '.pun_htmlspecialchars($_POST['pass_old']).' to '.pun_htmlspecialchars($_POST['pass_new1']).'. <br /> Don t forget your password. </center>
		');  
		
		 include "top.php";
			}

		$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
		print $tpl_footer->toString();
		exit;
		
		}
		else
		{
			$warn2 = "<font color='red'>(!)</font>";
		}
	}
	else
	{
		$warn1 = "<font color='red'>(!)</font>";
	}
} 
$cont2.='<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
</p><p style="clear: both;"></p>
	<table>
		<tbody><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Home" href="accounts.wow"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/home.png" border=""><br>Home</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Get Item" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/getitem.png" border=""><br>Get Item</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donation Shop" href="account.wow?i=Donation_Shop"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/shop.gif" width="42" height="42" border=""><br>Donate Shop</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donate" href="account.wow?i=donate"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/donate.png" border=""><br>Donate</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Unstucker" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/unstucker.png" border=""><br>Unstucker</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Vote" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/vote.png" border=""><br>Vote</a></td>
	</tr><tr height="20"></tr><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Teleport" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/teleport.png" border=""><br>Teleport</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Change" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/pass.png" border=""><br>Change Pass</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Transfer" href="#"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/transfer.png" border=""><br>Transfer</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Gold" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/gold.png" border=""><br>Gold</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Level" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/up.png" border=""><br>Level</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" target="hidd" title="Logout" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/logout.png" border=""><br>Logout</a></td>
	</tr>
</tbody></table>

		<br>
<form action="" method="post">
<fieldset>
<table style="text-align: right;" width="100%" align="center">
<tr><td width="200"><b>Old-Password:</b></td><td width="140"><input name="pass_old" type="password" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td>'. $warn1 .'</td></tr>
<tr><td width="200"><b>New-Password:</b></td><td width="140"><input name="pass_new1" type="password" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td>'. $warn2 .'</td></tr>
<tr><td width="200"><b>Re-Ente:</b></td><td width="140"><input name="pass_new2" type="password" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<tr><td style="text-align: center;" colspan="3"></td></tr>
<tr><td style="text-align: center;" colspan="3"><br/><input style="border: 1px solid black; width: 60px; height: 24px;" type="submit" name="action" value="Change"/></td></tr>

</table>
</fieldset>
</form>
';

$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();		
}


?>
<?php
include "top.php";
?>

