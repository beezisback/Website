<?php
if (!defined('AXE'))
	exit;

//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include
if (!$a_user['is_guest']) 
{

if (isset($_POST['action'])) 
{
	if (!isset($_POST['pass_old']))
	{
		$warn1 = "<font color='red'>(!)</font>";
	}
	else
	{
		//lets select acc db
		$resPass = $ACC_PDO->prepare("SELECT ".$db_translation['encrypted_password']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :username LIMIT 1");
		$resPass->bindParam(':username', $a_user[$db_translation['login']], PDO::PARAM_STR);
		$resPass->execute();
	
		$a2 = $resPass->fetch(PDO::FETCH_NUM);
	
		unset($resPass);
		
		$pass1 = trim($_POST['pass_new1']);
		$pass2 = trim($_POST['pass_new2']);
		
		if ($a2[0] == sha1(strtoupper($a_user[$db_translation['login']]).':'.strtoupper(pun_htmlspecialchars(($_POST['pass_old']))))) 
		{
			if ($pass1 == $pass2)
			{
				$tok=passchange($pass1);
				if ($tok)
				{
					box('Fail', $tok); $tpl_footer = new Template("styles/".$style."/footer.php");
					$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
					print $tpl_footer->toString();
					exit;
				}
				else
				{
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
		 				box('Success', "Password is changed from <strong>".pun_htmlspecialchars($_POST['pass_old'])."</strong> to <strong>".pun_htmlspecialchars($_POST['pass_new1'])."</strong>. <br><br>Don't forget your password."); $tpl_footer = new Template("styles/".$style."/footer.php");
					}
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
} 



$cont2.='
<center>      
<div class="sub-box1" align="left">
        <form action="" method="post">							
		&nbsp;Old Password: <br/>
        <input type="password" id="username" maxlength="20" name="pass_old" /><br/> '. $warn1 .'									
		&nbsp;New Password:<br/>
		<input type="password" id="password" maxlength="20" name="pass_new1" /><br/> '. $warn2 .'
		&nbsp;Confirm your new password:<br/>
		<input type="password" id="password" maxlength="20" name="pass_new2" /><br/>
		<br/>Your password may only contain numbers and letters.<br/><br/> '. $warn2 .'
        <div id="log-b2"><input type="submit" name="action" value="Change Password" class="button doit" /></div>
		</form>
</div>
</center>
';

$box_wide->setVar("content_title", "Password Changer");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();		
}


?>



