<div id="menu">
<ul>
<li><a href="./">News | </li> <li class="active">Register Account | </li> <li><a href="accounts.wow"> Account Manager </a> | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
<?php

if (!defined('AXE'))
	exit;
	
	
if (!$a_user['is_guest'])
{
	//header("Location: accounts.wow");
	 box ('Account Manager','<meta http-equiv="refresh" content="0;url=accounts.wow"/>');
	//box ('Hmm','You are already logged in, why would you want a new account? <br>Please continue...');//
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
	//do login stuff:
	$login = preg_replace( "/[^A-Za-z0-9]/", "", $_POST['username'] ); //only letters and numbers
	
	if ($login=='')
	{
		$war1="<font color='red'>Enter your username</font>";
	}
	else //pass empty
	{
		$db->select_db($acc_db);
		$result = $db->query("SELECT ".$db_translation['login']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']." = '".$db->escape($login)."' LIMIT 1") or die(mysql_error());
		$rows   = $db->num_rows($result);
		if ($rows>=1)
		{
			$war1="<font color='red'>The username '".$login."' already exists, please pick another.</font>";
			$db->select_db($db_name);
		}
		else //pass username
		{
			if ($smtp_h=='')
			{
				$pass1 = preg_replace( "/[^A-Za-z0-9]/", "", $_POST['password'] ); //only letters and numbers
				$pass2 = preg_replace( "/[^A-Za-z0-9]/", "", $_POST['password2'] ); //only letters and numbers
				if ($pass1=='')
				{
					box ('Fail',"Type in password.");
					$tpl_footer = new Template("styles/".$style."/footer.php");
					print $tpl_footer->toString();
					exit;
				}
				else //pass empty
				{
					if ($pass1<>$pass2) 
					{
						box ('Failure',"Passwords do not match.");
						$tpl_footer = new Template("styles/".$style."/footer.php");
						print $tpl_footer->toString();
						exit;
					}
				}
			}
			$email = pun_htmlspecialchars($_POST['email']);
			if ($email=='')
			{
				$war3="<font color='red'>Type in your e-mail address</font>";
			}
			else //pass empty
			{
				$db->select_db($acc_db);
				$result = $db->query("SELECT ".$db_translation['login']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['email']." = '".$db->escape($email)."' LIMIT 1") or die(mysql_error());
				$rows   = $db->num_rows($result);
				if ($rows>=1)
				{
					$war3="<font color='red'>The e-mail address '".$email."' is already in use!</font><br/>";
					$db->select_db($db_name);
				}
				
		if( $_POST['randimage_txt'] != $_SESSION['image_random_value'] )
              {
                  $errors[code] = '<font color="red">Incorrect captcha code.</font>';
               }
			   
				   else
					{	
					
						//random pass
						if ($smtp_h<>'' && $smtp_u<>'') //check if there is smtp info
						{
							$pass1=random_pass('6');
						}
						
						$db->select_db($acc_db);
						//create_account($user,$pass,$email,$securityq,$securitya)
						$createacc=create_account($login,$pass1,$db->escape($email));
						if ($createacc)
						{
							box ('Fail',$createacc);
							$tpl_footer = new Template("styles/".$style."/footer.php");
							print $tpl_footer->toString();
							exit;
						}
						$db->select_db($db_name);
						//add additional data
						$result2 = $db->query("INSERT INTO accounts_more (acc_login, vp, question_id, answer, dp) VALUES ('".strtoupper($login)."','0','".$question."','".$db->escape($answer)."','0')") or die(mysql_error());

						
						//SMTP START
						if ($smtp_h<>'' && $smtp_u<>'') //check if there is smtp info
						{
							$from =trim($email);
							$to = trim($email);
							$subject =  $title." - Account Info";
							$body = "Thank you for creating account, ".$login."!\n\nYour password: ".$pass1."\n\nEnjoy your stay!\n\n".$domain_url;
							require_once "smtp.php";
							
						}
						//SMTP END
						header("Location: accounts.wow");
						//$thisboxstring.='<span class="colorgood">You have successfully created your account. You are now logged in.</span><br><br>'.$smtpme;
						if ($smtp_h=='' && $smtp_u<>'') //check if there is smtp info
						{
							$thisboxstring.=' Your password is <strong>'.$pass1.'</strong>. You can change it from the Account Panel.';
						}
						$thisboxstring.="<font size='4'>YGo to the Account Panel</font><meta http-equiv='refresh' content='0;url=accounts.wow'/>";
						//$thisboxstring.='<a href="accounts.wow">Go to the Account Panel</a>';//
						box ('Success',$thisboxstring);
						//login
						$_SESSION['user']=pun_htmlspecialchars($login);
						
						
						
						$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
					}
					
				}
			}

		}
		}

$cont2='	
	<p>Here you can register a new account to play in our Server. Please
 use a valid email, since you will need it later in case you loose your 
password or something happens to your account.</p> 
				<p>We will <b>not</b> use your email for anything else.</p><br>
				 <form action="" method="post">
				<table width="100%" align="center">
				<tbody><tr><td style="width: 40%;"><b>Nickname</b></td>
				<td style="width: 30%;"><input style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;" name="username" type="textbox"><br />'. $war1.'</td>
				<td style="width: 20%;">Only Alphanumeric Characters</td></tr>
				<tr><td><b>Password</b></td>
				<td><input style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;" name="password" type="password"></td><td>Min 5 chars / Alphanumeric Chars</td></tr>
				<tr><td><b>Rewrite your password</b></td>
				<td><input style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;" name="password2" type="password"></td><td>Min 5 chars / Alphanumeric Chars</td><br />'. $war2.'</tr>
				<tr><td><b>Email</b></td>
				<td><input style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;" name="email" type="textbox"></td><td>Valid E-mail</td><br />'. $war3.'</tr>
				<tr><td><b>Confirmation Code</b></td>
				<td><input style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;" name="randimage_txt" type="textbox"> '.$errors[code].'</td>
				<td><img id="captcha" src="randomcode.php"  width="205" height="45" border="1" alt="CAPTCHA"><a href="#" onclick="document.getElementById(\'captcha\').src = \'randomcode.php?\' + Math.random(); return false">Reload Image</a></td></tr>
				<tr><td colspan="3"><input style="border: 1px solid black; width: 50px; height: 24px;" name="action" value="Register" type="submit"></td><td></td></tr>
				</tbody></table>
              </form>
			  ';
$box_wide->setVar("content_title", "Register Account");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();
?>
<?php
include "top.php";
?>