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
				box('Fail', $tok); $tpl_footer = new Template("styles/".$style."/footer.php");
				$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
				print $tpl_footer->toString();
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
		 		box('Success', "Password is changed from <strong>".pun_htmlspecialchars($_POST['pass_old'])."</strong> to <strong>".pun_htmlspecialchars($_POST['pass_new1'])."</strong>. <br><br>Don't forget your password."); $tpl_footer = new Template("styles/".$style."/footer.php");
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



$cont2.='
<center>      
<div class="sub-box1" align="left">
        <form action="" method="post">							
		<div class="form-row clearfix">
<p id="left">Old Password:</p>
<p id="right" align="left"><input type="password" id="username" maxlength="20" name="pass_old"/><br/> </p>
</div>'. $warn1 .'									
		<div class="form-row clearfix">
<p id="left">New Password:</p>
<p id="right" align="left"><input type="password" id="password" maxlength="20" name="pass_new1"/><br/> </p>
</div> '. $warn2 .'
		<div class="form-row clearfix">
<p id="left">Confirm your new password:</p>
<p id="right" align="left"><input type="password" id="password" maxlength="20" name="pass_new2"/></p>
</div>'. $warn2 .'
    <div class="form-row form-comment clearfix">
<p id="left"></p>
<p id="right" align="left">
<span id="comment-symbol">*</span>
<span id="comment-text">Your password may only contain numbers and letters.<br/> </span>
</p>
</div>
<div class="form-row clearfix">
<p id="left"></p>
<p id="right" align="left"><input type="submit" name="action" value="Change Password" class="button doit"/></p>
</div>
</form>
</div>
</center>
';

$box_wide->setVar("content_title", "Password Changer");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();		
}


?>



