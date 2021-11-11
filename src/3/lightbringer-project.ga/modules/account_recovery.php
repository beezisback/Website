<div id="menu">
<ul>
<li><a href="./">News</a> | </li> <li><a href="register.wow">Register Account</a> | </li> <li class="active">Account Manager | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
<?php
if (!defined('AXE'))
	exit;
	
	
if (!$a_user['is_guest'])
{
	box ('Hmm','You are already logged in, why would you want a new account? <br>Please continue...');
	include "top.php";
	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
}
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include
if (isset($_POST['action'])) 
{
	$randpass=random_pass('6');
	$login=pun_htmlspecialchars($_POST['login']);
	$email=pun_htmlspecialchars($_POST['email']);
	//lets select acc db
	mysql_select_db($acc_db);
	$result=$db->query("SELECT * FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']."='".$db->escape($login)."' and ".$db_translation['email']."='".$db->escape($email)."' LIMIT 1")or die(mysql_error());	
	
	if ($db->num_rows($result)=='1')
	{
		//$ispass= $db->fetch_assoc($result);
		//check sec question and answer
		mysql_select_db($db_name);
		$result2=$db->query("SELECT question_id,answer FROM accounts_more WHERE UPPER(acc_login)='".strtoupper($db->escape($login))."' LIMIT 1")or die(mysql_error());
		if ($db->num_rows($result2)=='1')//additional data found, send with smtp or reset it
		{	
		
        $do = $email;
        $tema = "Last WoW TBC Server: - Recover Password";
        $site_mail = 'Recover@Lastwow.com';
        $sadarjanie = "<html><body>Dear $login, <br /><br />
		
		You have requested to recover your Last WoW TBC Server password. <br /><br />
		
		Your new Password is: <font color='red'><b>$randpass</b></font> <br /><br />
	
		If you did not request this password recovery, it is likely that someone else did this for you.<br />
        There is no harm if this is the case, simply delete this email.<br /><br />

		Last WoW TBC Server Staff.<br /><br />
		
		
		<b>IMPORTANT!</b><br />
        This is an automated message. Please do not reply to this e-mail.
		</body></html>";
        $headers='From: ' .$site_mail . "\r\n" .
                 'Reply-To: '.$site_mail . "\r\n".
                 "Content-Type: text/html; charset=ISO-8859-1\r\n".
                 "Content-Transfer-Encoding: 8bit\r\n";

			$db->select_db($acc_db);
			$db->query("UPDATE ".$db_translation['accounts']." SET ".$db_translation['encrypted_password']."='".sha1(strtoupper($login).':'.strtoupper($randpass))."' WHERE ".$db_translation['login']."='".$db->escape($login)."' LIMIT 1")or die(mysql_error());
			
			{

		      box('Success!',"Email was sent to: <b>$email</b> It should arrive within 5 minutes. If not, then check your spambox as well");
		      mail($do,$tema,$sadarjanie,$headers);
				
			}
			
			$tpl_footer = new Template("styles/".$style."/footer.php");
			include "top.php";
			print $tpl_footer->toString();
			exit;
		}
}

	else
	{
		$warn = "<font color='red'>(!)</font>";
		$wrong = "<font color='red'><strong>*There is no account with this username and email address.*</strong></font>";
	}

}


$cont2='

<p></p>
<form action="" method="post">
<fieldset>
<table style="text-align: right;" width="100%" align="center">
<tr><td width="200">Username:</td><td width="140"><input name="login" type="text" onblur="validate(this.value,\'userok\');" onclick="this.value=\'\'" value="" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td><img id="userok" style="display: none;" src="styles/'.$style.'/Images/ok.png"/></td></tr>
<tr><td width="200">Email:</td><td width="140"><input name="email" type="text" onblur="validate(this.value,\'passok\');" onclick="this.value=\'\'" value="" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td><img id="passok" style="display: none;" src="styles/'.$style.'/Images/ok.png"/></td></tr>
<tr><td style="text-align: center;" colspan="3">'.$wrong.'</td></tr>
<tr><td style="text-align: center;" colspan="3"><input style="border: 1px solid black; width: 120px; height: 24px;" type="submit" name="action" value="Recover password"/></td></tr>
<tr><td style="text-align: center;" colspan="3">
	<br/>Here you can recover your password if you lost it.
	<br/>This works through your email address on your Last WoW TBC Server account .
<br /><br /></td></tr>

</table>
</fieldset>
</form>
';


$box_wide->setVar("content_title", "Password recovery");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
?>
<?php
include "top.php";
?>