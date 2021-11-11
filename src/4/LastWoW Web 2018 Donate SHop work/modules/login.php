<div id="menu">
<ul>
<li><a href="./">News</a> | </li> <li><a href="register.wow">Register Account</a> | </li> <li class="active">Account Manager | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
<?php
if (!defined('AXE'))
	exit;
//if session set, then we shoudlnt be here
if (!$a_user['is_guest'])
{
	
	header("Location: accounts.wow");
	
	//box ('Hmm','You are already logged in, why would you want a new account? <br>Please continue...');
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
	if (pun_htmlspecialchars($_POST['username'])=='')
		{
			$cont2= "Your user name needs to be filled in. <meta http-equiv='refresh' content='2;url=login.wow'/>";
		}
		elseif (pun_htmlspecialchars($_POST['username'])=='')
		{
			$cont2= "Your password needs to be filled in. <meta http-equiv='refresh' content='2;url=login.wow'/>";
		}
	//lets select acc db
	mysql_select_db($acc_db);
	special_core_exec_onlogin(pun_htmlspecialchars($_POST['username']));
	
	$a  = mysql_query("SELECT ".$db_translation['encrypted_password']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']." = '".$db->escape(pun_htmlspecialchars($_POST['username']))."'") or die (mysql_error());
	$a2 = mysql_fetch_array($a);
	if ($a2[0]==sha1(strtoupper(pun_htmlspecialchars($_POST['username'])).':'.strtoupper(pun_htmlspecialchars($_POST['password'])))) 
	{
		if (pun_htmlspecialchars($_POST['username'])=='')
		{
			$cont2= "Your user name needs to be filled in. <meta http-equiv='refresh' content='0;url=login.wow'/>";
		}
		elseif (pun_htmlspecialchars($_POST['password'])=='')
		{
			$cont2= "Your password needs to be filled in. <meta http-equiv='refresh' content='0;url=login.wow'/>";
		}
		else
		{
			$_SESSION['user']=pun_htmlspecialchars($_POST['username']);
			//header("Location: accounts.wow");//
			$cont2= "<font size='4'>You are now logged out.</font><meta http-equiv='refresh' content='0;url=accounts.wow'/>";
			//$cont2= "<font size='4'>You are now logged in! </font><meta http-equiv='refresh' content='0;url=accounts.wow'/>";
		}
		$box_wide->setVar("content_title", "Account Manager");	
        $box_wide->setVar("content", $cont2);					
        print $box_wide->toString();
		include "top.php";
		$tpl_footer = new Template("styles/".$style."/footer.php");
	    print $tpl_footer->toString();
	    exit;
	    }
	    else
	    {
		$warn = "<font color='red'>(!)</font>";
		$warn2 = "<font color='red'><strong>Incorrect username or password!</strong></font>";
	}
} 
$cont2='
<p>`<b>Welcome to your Account Manager</b></p>
<form action="" method="post">
<fieldset>
<table style="text-align: right;" width="100%" align="center">
<tr><td width="200">Username:</td><td width="140"><input name="username" type="text" onblur="validate(this.value,\'userok\');" onclick="this.value=\'\'" value="User" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td><img id="userok" style="display: none;" src="styles/'.$style.'/Images/ok.png"/></td></tr>
<tr><td width="200">Password:</td><td width="140"><input name="password" type="password" onblur="validate(this.value,\'passok\');" onclick="this.value=\'\'" value="Password" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td><img id="passok" style="display: none;" src="styles/'.$style.'/Images/ok.png"/></td></tr>
<tr><td style="text-align: center;" colspan="3">'. $warn2.'</td></tr>
<tr><td style="text-align: center;" colspan="3"><br/><input style="border: 1px solid black; width: 50px; height: 24px;" type="submit" name="action" value="Login"/></td></tr>
<tr><td style="text-align: center;" colspan="3">Don t remember your password? <a title="Password Recovery" href="account_recovery.wow">Click Here</a></td></tr>
<tr><td style="text-align: center;" colspan="3"><img src="styles/'.$style.'/Images/siteseal_gd_3_h_d_m.gif" /><span id="siteseal"><br/></span></td></tr> 
</table>
</fieldset>
</form>
';	 
$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();
?>
<?php 
include "top.php";
?>