<?php
if (!defined('AXE'))
	exit;
	
	
if (!$a_user['is_guest'])
{
	box ('Hmm','You are already logged in, why would you want a new account? <br>Please continue...');
	$tpl_footer = new Template("styles/".$style."/footer.php");
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
if (isset($_POST['action']))
{
	//do login stuff:
	$login = trim($_POST['username']);
	
	if ($login=='')
	{
		$war1="<font color='red'>Enter your username</font>";
	}
	else if (!ctype_alnum($login))
	{
		$war1="<font color='red'>Username may only contain letters and digits (A-Z, a-z, 0-9).</font>";
	}
	else //pass empty
	{
		$res = $ACC_PDO->prepare("SELECT ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :username LIMIT 1");
		$res->bindParam(':username', $login, PDO::PARAM_STR);
		$res->execute();
		
		$rows = $res->rowCount();
		
		unset($res);
		
		if ($rows >= 1)
		{
			$war1="<font color='red'>The username '".$login."' already exists, please pick another.</font>";
		}
		else //pass username
		{
			if ($smtp_h=='')
			{
				$pass1 = trim($_POST['password']);
				$pass2 = trim($_POST['password2']);
				
				if (!isset($_POST['password']) or !isset($_POST['password2']))
				{
					box ('Fail',"Type in password.");
					$tpl_footer = new Template("styles/".$style."/footer.php");
					$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
					print $tpl_footer->toString();
					exit;
				}
				else //pass empty
				{
					if (strcasecmp($pass1, $pass2) < 0) 
					{
						box ('Failure',"Passwords do not match.");
						$tpl_footer = new Template("styles/".$style."/footer.php");
						$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
						print $tpl_footer->toString();
						exit;
					}
				}
			}
			$email = pun_htmlspecialchars($_POST['email']);
			if (!isset($_POST['email']))
			{
				$war3="<font color='red'>Type in your e-mail address</font>";
			}
			else //pass empty
			{
				$res2 = $ACC_PDO->prepare("SELECT ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['email']."` = :email LIMIT 1");
				$res2->bindParam(':email', $email, PDO::PARAM_STR);
				$res2->execute();
				
				$emailRows = $res2->rowCount();
				
				unset($res2);
				
				if ($emailRows >= 1)
				{
					$war3="<font color='red'>The e-mail address '".$email."' is already in use!</font><br/>";
				}
				else //pass
				{
					$question = $_POST['question'];
					$answer = $_POST['answer'];
					
					if (!isset($_POST['answer']))
					{
						$war4="<font color='red'>Make sure you type in your answer.</font><br/>";
					}
					else //pass final
					{							
						//create_account($user,$pass,$email,$securityq,$securitya)
						$createacc = create_account($login, $pass1, $email);
						if ($createacc)
						{
							box ('Fail',$createacc);
							$tpl_footer = new Template("styles/".$style."/footer.php");
							$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
							print $tpl_footer->toString();
							exit;
						}
						
						//add additional data
						$insert = $WEB_PDO->prepare("INSERT INTO `accounts_more` (acc_login, vp, question_id, answer, dp) VALUES (:login, :vp, :question, :answer, :dp)");
						$insert->bindParam(':login', strtoupper($login), PDO::PARAM_STR);
						$insert->bindValue(':vp', 0, PDO::PARAM_INT);
						$insert->bindParam(':question', $question, PDO::PARAM_INT);
						$insert->bindParam(':answer', $answer, PDO::PARAM_STR);
						$insert->bindValue(':dp', 0, PDO::PARAM_INT);
						$insert->execute();
						
						unset($insert);
						
						if ($question=='1')
						{
							$questi="Your middle name?";
						}
						elseif ($question=='2')
						{
							$questi="Your birth town?";
						}
						elseif ($question=='3')
						{
							$questi="Your pet's name?";
						}
						elseif ($question=='4')
						{
							$questi="Your mother's maiden name?";
						}
						else
						{
							print "Something was wrong with your security question.<br/>";
						}
						
						//SMTP START
						//include PHP send mail function
						require_once "smtp.php";
						
						$body = "Thank you for registering.<br><br>Your username is ".$login."!<br><br>Your password is: ".$pass1."<br><br>Enjoy your stay!<br><br>".$domain_url;
						
						$mailit = duloSendMail(trim($email), $title.' - Account Information', $body);
						//SMTP END
						
						$thisboxstring.='<span class="colorgood">You have successfully created your account. You are now logged in.</span><br><br>';						
						$thisboxstring.='<a href="./quest.php?name=account">Go to the Account Panel</a>';
						box ('Success',$thisboxstring);
						//login
						$_SESSION['user']=pun_htmlspecialchars($login);
						
						$tpl_footer = new Template("styles/".$style."/footer.php");
						$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
						print $tpl_footer->toString();
						exit;
					}
					
				}
			}

		}
		}
	
	}	

$cont2='<center>
        <div class="sub-box1" align="left">
        <form action="" method="post">
		 &nbsp;Username:<br/>
		 <input type="text" id="username" maxlength="20" name="username" /><br/> '. $war1.'
';
								if ($smtp_h=='') //check if there is smtp info
								{
$cont2.='
		&nbsp;Password:<br/>
		<input type="password" id="password" maxlength="20" name="password" /><br/>											
		&nbsp;Confirm Password:<br/>
		<input type="password" id="password2" maxlength="20" name="password2" /> <br/>'. $war2.'											
';}
$cont2.='
        &nbsp;Email Address:<br/>
		<input type="text" id="email" maxlength="40" name="email" /><br/> '. $war3.'										
		&nbsp;Security Question:<br/>
		<div class="bord1">
          <label><input class="fix1" name="question" type="radio" value="1"  />&nbsp; Your middle name?</label><br />
		  <label><input class="fix1" name="question" type="radio" value="2" checked="checked" />&nbsp; Your birth town?</label><br />
		  <label><input class="fix1" name="question" type="radio" value="3" />&nbsp; Your pet\'s name?</label><br />
		  <label><input class="fix1" name="question" type="radio" value="4" />&nbsp; Your mother maiden name?</label><br />	
		</div>					
        &nbsp;Security Answer:<br/>
        <input type="text" id="answer" maxlength="100" name="answer" /><br/> '.$war4.'										
         May only contain alphabetic letters (A-Z, a-z) and numbers (0-9).<br/><br/>
		<div id="log-b2"><input type="submit" name="action" value="Create Account" class="button doit" /></div>
		</form>
		</div>
		
		   <br/>
		   
		<div class="sub-box1" align="left">
		<strong>*Connection Guide</strong> <br/>
     <strong><font color="#464646">1)</font></strong> Open C:\Program Files\World of Warcraft\Data\enGB/enUS\realmlist.wtf with notepad.<br/>
     <strong><font color="#464646">2)</font></strong> 
	  Remove all and add set realmlist <font color="#9a2828">heavenwow.no-ip.Biz</font> and save.<br/>
     <strong><font color="#464646">3)</font></strong> Register an account above.<br/>
     <strong><font color="#464646">4)</font></strong> Enjoy the realms of Heaven WoW!<br/>
		</div>
</center>
';

$box_wide->setVar("content_title", "Registration");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	