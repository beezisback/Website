<?php
if (!defined('AXE'))
	exit;
	
if (!$a_user['is_guest'])
{
	alert_box('You are already logged in, why would you want a new account? <br>Please continue...<br><br><a href="index.php">Go Back.</a>');
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
						
						//////////////////////////////////////////////////////////////////////////////
						//////// VBulletin Integration ///////////////////////////////////////////////
						if (isset($vb_config['enable']) and $vb_config['enable'])
						{
							define('SALT_LENGTH', 30);
							
							//setup the PDO to the VBulletin database
							try 
							{
								//Construct PDO
								$VB_PDO = new PDO('mysql:dbname='.$vb_config['db_name'].'; host='.$vb_config['db_host'].';', $vb_config['db_user'], $vb_config['db_pass'], NULL);
								//set error handler exception
								$VB_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
								//set default fetch method
								$VB_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
								//set encoding
								$VB_PDO->query("SET NAMES '".$db_encoding."'");
							}
							catch (PDOException $e)
							{
								$thisboxstring.= '<strong>Database Connection to the VBulletin Database failed. Your account was not inserted.</strong><br><br>';
							}
							
							function fetch_user_salt($length = SALT_LENGTH)
							{
								$salt = '';
								for ($i = 0; $i < $length; $i++)
								{
									$salt .= chr(rand(33, 126));
								}
								return $salt;
							}
							function hash_password($password, $salt)
							{
								// if the password is not already an md5, md5 it now
								$password = md5($password);
								// hash the md5'd password with the salt
								return md5($password . $salt);
							}
							
							function validip($ip)
							{
								if (!empty($ip) && $ip == long2ip(ip2long($ip)))
								{
									$reserved_ips = array (
										array('0.0.0.0','2.255.255.255'),
										array('10.0.0.0','10.255.255.255'),
										array('127.0.0.0','127.255.255.255'),
										array('169.254.0.0','169.254.255.255'),
										array('172.16.0.0','172.31.255.255'),
										array('192.0.2.0','192.0.2.255'),
										array('192.168.0.0','192.168.255.255'),
										array('255.255.255.0','255.255.255.255')
									);

									foreach ($reserved_ips as $r)
									{
										$min = ip2long($r[0]);
										$max = ip2long($r[1]);
										if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
									}
									return true;
								}
								else return false;
    						}

    						function getip()
							{
    							if (isset($_SERVER)) {
     								if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && validip($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       		  							$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	 							} elseif (isset($_SERVER['HTTP_CLIENT_IP']) && validip($_SERVER['HTTP_CLIENT_IP'])) {
      		  							$ip = $_SERVER['HTTP_CLIENT_IP'];
     								} else {
       		  							$ip = $_SERVER['REMOTE_ADDR'];
     								}
   	 							} else {
    								if (getenv('HTTP_X_FORWARDED_FOR') && validip(getenv('HTTP_X_FORWARDED_FOR'))) {
       		  							$ip = getenv('HTTP_X_FORWARDED_FOR');
    	 							} elseif (getenv('HTTP_CLIENT_IP') && validip(getenv('HTTP_CLIENT_IP'))) {
     	      							$ip = getenv('HTTP_CLIENT_IP');
     	 							} else {
     	      							$ip = getenv('REMOTE_ADDR');
     								}
    							}

      						return $ip;
    						}
							
							//define the variables
							$vb_salt = fetch_user_salt();
							$vb_passhash = hash_password($pass1, $vb_salt);
							$passDate = date('Y-m-d');
							$joindate = time();
							$vb_ip = getip();
							
							$vb_res = $VB_PDO->prepare("SELECT COUNT(userid) FROM `user` WHERE `username` = :login LIMIT 1");
							$vb_res->bindParam(':login', $login, PDO::PARAM_STR);
							$vb_res->execute();
							
							$vb_count = $vb_res->fetch(PDO::FETCH_NUM);
							
							//check if we have that account
							if ($vb_count[0] == 0)
							{
								//insert new VBulletin record
								$vb_insert = $VB_PDO->prepare("INSERT INTO `user` (`usergroupid`, `username`, `password`, `passworddate`, `email`, `showvbcode`, `showbirthday`, `usertitle`, `joindate`, `reputation`, `reputationlevelid`, `timezoneoffset`, `options`, `ipaddress`, `languageid`, `salt`) VALUES (2, :login, :passhash, :passdate, :email, 1, 0, 'Junior Member', :joindate, 10, 5, '0', 45091927, :ip, 1, :salt);");
								$vb_insert->bindParam(':login', $login, PDO::PARAM_STR);											
								$vb_insert->bindParam(':passhash', $vb_passhash, PDO::PARAM_STR);
								$vb_insert->bindParam(':passdate', $passDate, PDO::PARAM_STR);
								$vb_insert->bindParam(':email', $email, PDO::PARAM_STR);
								$vb_insert->bindParam(':joindate', $joindate, PDO::PARAM_INT);
								$vb_insert->bindParam(':ip', $vb_ip, PDO::PARAM_STR);
								$vb_insert->bindParam(':salt', $vb_salt, PDO::PARAM_STR);
								if ($vb_insert->execute())
								{
									$vb_account = true;
								}
								unset($vb_insert);
								unset($VB_PDO);
							}
							else
							{
								$thisboxstring.='Forum account was not created, this username is already registred in the forums.<br><br>';
							}
						}
						//////////////////////////////////////////////////////////////////////////////
						//////////////////////////////////////////////////////////////////////////////
						
						//SMTP START
						//include PHP send mail function
						require_once "smtp.php";
						
						$body = "Thank you for registering.<br><br>Your username is ".$login."!<br><br>Your password is: ".$pass1."<br><br>Enjoy your stay!<br><br>".$domain_url;
						
						$mailit = duloSendMail(trim($email), $title.' - Account Information', $body);
						//SMTP END
						
						$thisboxstring.='<span class="colorgood">You have successfully created your account. You are now logged in.</span><br><br>';					
						
						//check if we had VB account
						if (isset($vb_account) and $vb_account == true)
						{
							$thisboxstring.='<span class="colorgood">Forum account successfuly created, you will be able to login in our community forums with this account information.</span><br><br>';
						}
						
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
		&nbsp;Password:<br/>
		<input type="password" id="password" maxlength="20" name="password" /><br/>											
		&nbsp;Confirm Password:<br/>
		<input type="password" id="password2" maxlength="20" name="password2" /> <br/>'. $war2.'											
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
	  Remove all and add set realmlist <strong><font color="#9a2828"> Logon.heavenwow.Com</font> and save.<br/>
     <strong><font color="#464646">3)</font></strong> Register an account above.<br/>
     <strong><font color="#464646">4)</font></strong> Enjoy the realms of Heaven Wow!<br/>
		</div>
</center>
';

$box_wide->setVar("content_title", "Registration");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	