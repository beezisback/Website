<?php
if (!defined('AXE'))
	exit;
//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
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
			//resetting pass:
			$db->select_db($acc_db);
			$db->query("UPDATE ".$db_translation['accounts']." SET ".$db_translation['encrypted_password']."='".sha1(strtoupper($login).':'.strtoupper($randpass))."' WHERE ".$db_translation['login']."='".$db->escape($login)."' LIMIT 1")or die(mysql_error());
			
			$db->select_db($db_name);
			if ($smtp_h<>'' and $smtp_u<>'')
			{
				
				
				//SMTP START
				$from = trim($email);
				$to = trim($email);
				$subject = $title." - Password Retrievel";
				
				$body = "Hi, ".$login."\n\nYour Password is: ".$randpass."\n\nIf you didn't take part in this email, then just ignore this email.\n\n Staff!\n\n".$domain_url;
				require_once "smtp.php";
				box('Success!',$smtpme);
				//SMTP END
			}
			
			else
			{
				box('Success!',"Your new password is: ".$randpass);
				
			}
			$tpl_footer = new Template("styles/".$style."/footer.php");
			$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
			print $tpl_footer->toString();
			exit;
		}
		else//no additional data, do nothing if no stmp
		{
			$secur= $db->fetch_assoc($result2);
			if ($secur['question_id']==$_POST['question'] && $secur['answer']==$_POST['answer'])
			{
				if ($smtp_h<>'' and $smtp_u<>'')
				{
					//resetting pass:
					$db->select_db($acc_db);
					$db->query("UPDATE ".$db_translation['accounts']." SET ".$db_translation['encrypted_password']."='".sha1(strtoupper($login).':'.strtoupper($randpass))."' WHERE ".$db_translation['login']."='".$db->escape($login)."' LIMIT 1")or die(mysql_error());
					$db->select_db($db_name);
					//SMTP START
					$from = trim($email);
					$to = trim($email);
					$subject = $title." - Password Retrievel";
					$body = "Hi, ".$login."\n\nYour Password is: ".$randpass."\n\nIf you didn't take part in this email, then just ignore this email.\n\n Staff!\n\n".$domain_url;
					require_once "smtp.php";
					box('Success!',$smtpme);
					//SMTP END
				}
				else
					box('Sorry',"We don't have a way to send you an automated e-mail with a new password, if this is your account, please contact administrator to reset your password.");
				
				$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
			}
			else
			{
				$war4 = "<font color='red'>Security answer is wrong!</font>";
			}
		
		}
		
	}
	else
	{
		$warn = "<font color='red'>(!)</font>";
		$wrong = "<font color='red'><strong>*Username and password do not match.*</strong></font>";
	}
	
} 


	$cont2.='
	    <center>
	    <div class="sub-box1" align="left">
	    <form action="" method="post">
		&nbsp;Server Login:<br/>								
		<input name="login" type="text" /><br/> ';$cont2.= $warn ;$cont2.='									
		&nbsp;Email: <br/>
        <input name="email" type="text" /><br/> '; $cont2.=$warn; 
    $cont2.='
		&nbsp;Security Question:<br/>
		<div class="bord1">
         <label><input class="fix1" name="question" type="radio" value="1"  />&nbsp; Your middle name?</label> <br/>
		 <label><input class="fix1" name="question" type="radio" value="2" />&nbsp; Your birth town?</label> <br/>
		 <label><input class="fix1" name="question" type="radio" value="3" />&nbsp; Your pet\'s name?</label> <br/>
		 <label><input class="fix1" name="question" type="radio" value="4" />&nbsp; Your mother maiden name?</label> <br/>
		 </div>					
       &nbsp;Security Answer:<br/>
        <input type="text" id="answer" maxlength="100" name="answer" />  '.$war4.'											

        '.$wrong .'<br />If the information was filled in correctly, you\'ll be granted a new password. Please change this in the account panel as soon as possible.
<br />
								<br />
		<div id="log-b2"><input type="submit" name="action" value="Retrieve" class="button doit" /></div>
		</form>
		</div>
        </center>
';


$box_wide->setVar("content_title", "Password Retrieval");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	