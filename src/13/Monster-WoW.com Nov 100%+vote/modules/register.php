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
					$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
					print $tpl_footer->toString();
					exit;
				}
				else //pass empty
				{
					if ($pass1<>$pass2) 
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
							$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
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
						
						$thisboxstring.='<span class="colorgood">You have successfully created your account. You are now logged in.</span><br><br>'.$smtpme;
						if ($smtp_h=='' && $smtp_u<>'') //check if there is smtp info
						{
							$thisboxstring.=' Your password is <strong>'.$pass1.'</strong>. You can change it from the Account Panel.';
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
	
	

$cont2='<center>
        <div class="sub-box1" align="left">
        <form action="" method="post">
		<div class="form-row clearfix">
<p id="left">Username:</p>
<p id="right" align="left"><input type="text" id="username" maxlength="20" name="username"/><br/> </p>
</div>'. $war1.'
';
								if ($smtp_h=='') //check if there is smtp info
								{
$cont2.='
		<div class="form-row clearfix">
<p id="left">Password:</p>
<p id="right" align="left"><input type="password" id="password" maxlength="20" name="password"/></p>
</div>
<div class="form-row clearfix">
<p id="left">Confirm Password:</p>
<p id="right" align="left"><input type="password" id="password2" maxlength="20" name="password2"/> <br/></p>
</div>'. $war2.'											
';}
$cont2.='
       <div class="form-row clearfix">
<p id="left">Email Address:</p>
<p id="right" align="left"><input type="text" id="email" maxlength="40" name="email"/><br/> </p>
</div> '. $war3.'										

	  <div class="form-row form-comment clearfix">
<p id="left"></p>
<p id="right" align="left">
<span id="comment-symbol">*</span>
<span id="comment-text">The usage of REAL E-mail address is strongly recommended.</span>
</p>
</div>

<div class="form-row form-comment" align="right">
<div id="scrollBox" style="border: 1px solid #000000; padding: 10px; margin: 0 20px 0 0; overflow: auto; width: 450px; text-align:left; height: 175px; z-index: 1; background-color:#171717;">
<strong style="font-size:14px;">TERMS OF USE</strong><br/>
By accessing or using this Site, you ("User") agree to comply with the terms and conditions governing Users use of any areas of the Monster web site (the "Site") as set forth below.
<br/>
<br/>
<strong style="font-size:14px;">USE OF SITE</strong><br/>
This Site or any portion of this Site may not be reproduced, duplicated, copied, sold, resold, or otherwise exploited for any commercial purpose except as expressly permitted by Monster. Monster reserves the right to refuse service in its discretion, including, without limitation, if Monster believes that User conduct violates applicable law or is harmful to the interests of Monster or its affiliates.
<br/>
<br/>
<strong style="font-size:14px;">MONSTER ACCOUNT</strong><br/>
You may register a regular or premium account and password for the service. You are responsible for all activity under your account, associated accounts, and passwords. Monster is NOT responsible for unauthorized access to your account, regular or premium account, and any loss of virtual goods and commodities associated with it.
<br/>
<br/>
<strong style="font-size:14px;">SUBMISSION</strong><br/>
Monster does not assume any obligation with respect to any Submission and no confidential or fiduciary understanding or relationship is established by Monster?s receipt or acceptance of any Submission. All Submissions become the exclusive property of Monster and its affiliates. Monster and its affiliates may use any Submission without restriction and User shall not be entitled to any compensation.
<br/>
<br/>
<strong style="font-size:14px;">VERIFICATION AND "HEAVY USE" AGREEMENT</strong><br/>
USER MAY BE REQUIRED TO UNDERGO A VERIFICATION PROCEDURE INCLUDING, AND NOT LIMITED TO, SUBMISSION OF NECESSARY INFORMATION AND/OR DOCUMENTS TO ENSURE LEGITIMACY OF PAYMENTS SHOULD WE CONSIDER USE OF OUR SERVICES SUSPICIOUS. ACCOUNTS UNDERGOING VERIFICATION PROCEDURE REMAIN DISABLED UNTIL VERIFICATION PROCEDURE IS COMPLETE. SUBMITTED INFORMATION MAY BE DISCLOSED TO OUR AFFILIATES IN OUR MUTUAL EFFORTS TO PREVENT UNAUTHORIZED PAYMENTS AND/OR PURCHASES. REQUESTED INFORMATION IS TO BE SUBMITTED BY EMAIL/FAX/ONLINE FORM AND MAY INCLUDE VERIFICATION OF USERS IDENTITY .
<br/>
<br/>
<strong style="font-size:14px;">Third-Party Content</strong><br/>
Neither Monster, nor its affiliates, nor any of their respective officers, directors, employees, or agents, nor any third party, including any Provider, or any other User of this Site, guarantees the accuracy, completeness, or usefulness of any Content, nor its merchantability or fitness for any particular purpose. In some instances, the Content available through Monster may represent the opinions and judgments of Providers or Users. Monster and its affiliates do not endorse and shall not be responsible for the accuracy or reliability of any opinion, advice, or statement made on this Site by anyone other than authorized Monster employees. Under no circumstances shall Monster, or its affiliates, or any of their respective officers, directors, employees, or agents be liable for any loss, damage or harm caused by a Users reliance on information obtained through Monster. It is the responsibility of User to evaluate the information, opinion, advice, or other Content available through this Site.
<br/>
<br/>
<strong style="font-size:14px;">Disclaimers and Limitation of Liability</strong><br/>
User agrees that use of this Site is at Users sole risk. Neither Monster, nor its affiliates, nor any of their respective officers, directors, employees, agents, third-party content providers, merchants, sponsors, licensors or the like (collectively, "Providers"), warrant that this Site will be uninterrupted or error-free; nor do they make any warranty as to the results that may be obtained from the use of this Site, or as to the accuracy, reliability, or currency of any information content, service, or merchandise provided through this Site. THIS SITE IS PROVIDED BY Monster ON AN "AS IS"AND "AS AVAILABLE" BASIS. Monster MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THE SITE, THE INFORMATION, CONTENT, MATERIALS OR PRODUCTS, INCLUDED ON THIS SITE. TO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LAW, Monster DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. Monster WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF THIS SITE, INCLUDING BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE AND CONSEQUENTIAL DAMAGES. Under no circumstances shall Monster or any other party involved in creating, producing, or distributing this Site be liable for any direct, indirect, incidental, special, or consequential damages that result from the use of or inability to use this Site, including but not limited to reliance by a User on any information obtained from Monster-wow.net or that result from mistakes, omissions, interruptions, deletion of files or email, errors, defects, viruses, delays in operation or transmission, or any failure of performance, whether or not resulting from acts of God, communications failure, theft, destruction, or unauthorized access to Monsters records, programs, or services. User hereby acknowledges that these disclaimers and limitation on liability shall apply to all content, merchandise, and services available through this Site. In states that do not allow the exclusion of limitation or limitation of liability for consequential or incidental damages, User agrees that liability in such states shall be limited to the fullest extent permitted by applicable law.
<br/>
<br/>
<strong style="font-size:14px;">TERMINATION OF SERVICE</strong><br/>
Monster reserves the right, in its sole discretion, to change, suspend, limit, or discontinue any aspect of the Service at any time. Monster may suspend or terminate any Users access to all or part of Monster-wow.net and its servers, without notice, for any conduct that Monster, in its sole discretion, believes is in violation of its affiliates.
<br/>
<br/>
<strong style="font-size:14px;">Fees and Payments</strong><br/>
Monster reserves the right, in its sole discretion, at any time to charge fees for access to and use of the Service, or any portions of the Service. If Monster elects to charge fees, it will post notice on the Service of all provisions pertaining to fees and payments.
<br/>
<br/>
<strong style="font-size:14px;">ACKNOWLEDGEMENT</strong><br/>
By accessing or using this Site, USER AGREES TO BE BOUND BY THESE TERMS OF USE, INCLUDING DISCLAIMERS. Monster reserves the right to make changes to its Site and these terms and conditions, including disclaimers, at any time.
IF YOU DO NOT AGREE TO THE PROVISIONS OF THIS AGREEMENT OR ARE NOT SATISFIED WITH THE SERVICE, YOUR SOLE AND EXCLUSIVE REMEDY IS TO DISCONTINUE YOUR USE OF THE SERVICE.
<br/>
<br/>
<strong style="font-size:14px;">PRIVACY STATEMENT</strong><br/>
Certain user information collected through the use of this website is automatically stored for reference. We track such information to perform internal research on our users demographic interests and behavior and to better understand, protect and serve our customers and community. Payment or any other financial information is NEVER submitted, disclosed or stored on Monster and is bound to Terms of Use and Privacy Policy of our respective partners and/or payment processors. Basic user information (such as IP address, logs for using website interface and account management) may be disclosed to our partners in mutual efforts to counter potential illegal activities.
Monster makes significant effort to protect submitted information to prevent unauthorized access to that information in its internal procedures and technology. However, we do not guarantee, nor should you expect, that your personal information and private communications will always remain private.
<br/>
</div>
</div>
<div class="form-row form-comment" align="center">
If already understand and accept our Terms of Service!
Create Your Account!
</div>
<div id="log-b2" align="center"><input type="submit" name="action" value="Agree&amp;Create Account" class="button doit"/>
</div>

		</form>
		</div>

		

		   <br/>

		   

		<div class="sub-box1" align="left">

		  <p><strong>*Connection Guide</strong> <br/>

            <strong><font color="#e7e62c">1)</font></strong> Open C:\Program Files\World of Warcraft\Data\enGB/enUS\realmlist.wtf with notepad.<br/>

            <strong><font color="#e7e62c">2)</font></strong> 

	        Remove all and add set realmlist <font color="#339900">logon.Monster-wow.net</font> and save.<br/>

            <strong><font color="#e7e62c">3)</font></strong> Download <a href="#">Heavenwow.info</a>!* <br/>

            <strong><font color="#e7e62c">4)</font></strong>Register an account above.!<br/>

			<strong><font color="#e7e62c">5)</font></strong>Enjoy the Cataclysm !		  </p>

		  <p><strong>WE TAKE NO CREDIT FOR THE LOADER.<br/> 

	      </strong><strong>CHANGING YOUR CLIENT FILES IS ILLEGAL!!!</strong></p>

  </div>

</center>
';

$box_wide->setVar("content_title", "Registration");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	