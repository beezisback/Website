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
	
	$res = $ACC_PDO->prepare("SELECT * FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :login AND `".$db_translation['email']."` = :email LIMIT 1");
	$res->bindParam(':login', $login, PDO::PARAM_STR);
	$res->bindParam(':email', $email, PDO::PARAM_STR);
	$res->execute();
		
	if ($res->rowCount() == 1)
	{
		//$ispass= $db->fetch_assoc($result);
		//check sec question and answer
		$res2 = $WEB_PDO->prepare("SELECT question_id, answer FROM `accounts_more` WHERE UPPER(acc_login) = :login LIMIT 1");
		$res2->bindParam(':login', strtoupper($login), PDO::PARAM_STR);
		$res2->execute();
		
		if ($res2->rowCount() == 0)
		{
			$body = 'Hi, '.$login.'<br><br>Your Password is: '.$randpass.'<br><br>If you didn\'t take part in this email, then just ignore this email.<br><br> Staff!<br>'.$domain_url;
			
			//include PHP send mail function
			require_once "smtp.php";
			
			$mailit = duloSendMail(trim($email), $title.' - Password Retrievel', $body);
			
			if ($mailit)
			{
				//resetting pass:
				$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET `".$db_translation['encrypted_password']."` = :passhash WHERE `".$db_translation['login']."` = :login LIMIT 1");
				$update->bindValue(':passhash', sha1(strtoupper($login).':'.strtoupper($randpass)), PDO::PARAM_STR);
				$update->bindParam(':login', $login, PDO::PARAM_STR);
				$update->execute();
				unset($update);
			
				box('Success!', 'We\'ve sent you an mail with your new password, please login with your new password and then change it if you like.');
				//SMTP END
			}
			else
			{
				box('Sorry',"We don't have a way to send you an automated e-mail with a new password, if this is your account, please contact administrator to reset your password.");
			}
			
			$tpl_footer = new Template("styles/".$style."/footer.php");
			$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
			print $tpl_footer->toString();
			exit;
		}
		else
		{
			$secur = $res2->fetch(PDO::FETCH_ASSOC);
			
			if ($secur['question_id']==$_POST['question'] and $secur['answer']==$_POST['answer'])
			{
				//resetting pass:
				$update = $ACC_PDO->prepare("UPDATE `".$db_translation['accounts']."` SET `".$db_translation['encrypted_password']."` = :passhash WHERE `".$db_translation['login']."` = :login LIMIT 1");
				$update->bindValue(':passhash', sha1(strtoupper($login).':'.strtoupper($randpass)), PDO::PARAM_STR);
				$update->bindParam(':login', $login, PDO::PARAM_STR);
				$update->execute();
				unset($update);
				
				box('Success!',"Your new password is: ".$randpass);
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
		unset($res2);
	}
	else
	{
		$warn = "<font color='red'>(!)</font>";
		$wrong = "<font color='red'><strong>*There is no account with this username and email address.*</strong></font>";
	}
	
} 

	$cont2.='
	    <center>
	    <div class="sub-box1" align="left">
	    <form action="" method="post">
		&nbsp;Server Login:<br/>								
		<input name="login" type="text" /><br/> ';
		$cont2.= $warn ;
		$cont2.='&nbsp;Email: <br/>
        <input name="email" type="text" /><br/> ';
		$cont2.= $warn; 
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