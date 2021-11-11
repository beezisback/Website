<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' type='text/javascript'></script>
<style>
#fanback {
display:none;
width:100%;
height:100%;
position:fixed;
top:0;
left:0;
z-index:99999;
}
#fan-exit {
width:100%;
height:100%;
}

.text {
    width: 100%;
    font-family: Beaufort;
    font-size: 24px;
    color: #f56464;
    text-align: center;
}

.buttons {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
    margin-top: 20px;
}


.buttons > .popup_button {
    width: 240px;
    height: 50px;
    display: block;
    overflow: hidden;
    border-radius: 4px;
    background: url(styles/default/images/button_orange_center.png) top center;
    background-size: auto 100%;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    border: none;
    cursor: pointer;
    transition: all .3s ease-in-out;
    margin-left: 10px;
    margin-right: 10px;
}

a {
    text-decoration: none;
    color: #fff;
}



.buttons > .popup_button > span {
    position: relative;
    z-index: 2;
    color: #250e01;
    font-family: Beaufort Bold;
    font-size: 22px;
    text-transform: uppercase;
    text-shadow: 0px 1px 1px rgba(255,193,113,0.5);
}

#JasperRoberts {
background: rgba(31, 17, 13, 0.93);
border: 1px solid rgba(56,52,49,0.3);
width:600px;
height:220px;
position:absolute;
top:58%;
left:53%;
margin:-220px 0 0 -375px;
border-radius: 4px;
margin: -220px 0 0 -375px;
}
#TheBlogWidgets {
float:right;
cursor:pointer;
background:url(styles/default/images/fanclose.png) repeat;
height:55px;
padding:20px;
position:relative;
padding-right:40px;
}

.close {
    position: absolute;
    top: 14px;
    right: 20px;
    font-size: 18px;
    color: #42302b;
    transition: all .3s ease-in-out;
    cursor: pointer;
}


.remove-borda {
height:2px;
width:376px;
margin:0 auto;
margin-top:16px;
position:relative;
margin-left:11px;
}
#linkit,#linkit a.visited,#linkit a,#linkit a:hover {
color:#80808B;
font-size:10px;
margin: 0 auto 5px auto;
float:center;
}

</style>
<?php

if (!defined('AXE'))
	exit;
	
	
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
	//do login stuff:
	$login = preg_replace( "/[^A-Za-z0-9]/", "", $_POST['username'] ); //only letters and numbers
	
	if ($login=='')
	{
		$war1="						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div id='TheBlogWidgets'>
</div>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Enter your username</div>

</div>
</div>";

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
						$result2 = $db->query("INSERT INTO accounts_more (acc_login, vp, question_id, answer, dp) VALUES ('".strtoupper($login)."','0','1','".$db->escape($answer)."','0')") or die(mysql_error());

						
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
										
$thisboxstring.="						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div class='remove-borda'>
</div>
<br>
<div class='text'>You have registered successfully</div>
<div class='buttons'>
        <a class='popup_button' href='accounts.wow'><span>Account Panel</span></a>
		<meta http-equiv='refresh' content='2;url=accounts.wow'/>
    </div>
</div>
</div>";

box ($thisboxstring);
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

<body class="bg">
<h1 class="logo-w-250">Endless Account Creation</h1>
<section class="container dark-content-sm">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 pt-3">
            <form method="post" action="">
                
                <div class="form-label-group">
                    <input class="form-control" placeholder="Account name" autocomplete="off" autofocus type="text" data-val="true" data-val-length="The account name must be at least 3 and at max 16 characters long." data-val-length-max="16" data-val-length-min="3" data-val-required="The account name field is required." id="Input_Username" maxlength="16" name="username" value="" />
                    <label for="Input_Username">Account name</label>
                    <span class="text-danger field-validation-valid" data-valmsg-for="Input.Username" data-valmsg-replace="true">'. $war1.'</span>
                </div>
                <div class="form-label-group">
                    <input class="form-control" placeholder="Email" type="email" data-val="true" data-val-email="The entered email is not valid." data-val-length="The field Email must be a string with a maximum length of 64." data-val-length-max="64" data-val-required="The email field is required." id="Input_Email" maxlength="64" name="email" value="" />
                    <label for="Input_Email">Email</label>
                    <span class="text-danger field-validation-valid" data-valmsg-for="Input.Email" data-valmsg-replace="true">'. $war3.'</span>
                </div>
                <div class="form-label-group">
                    <input class="form-control" placeholder="Password" type="password" data-val="true" data-val-length="The password must be at least 6 and at max 16 characters long." data-val-length-max="16" data-val-length-min="6" data-val-required="The password field is required." id="Input_Password" maxlength="16" name="password" />
                    <label for="Input_Password">Password</label>
                    <span class="text-danger field-validation-valid" data-valmsg-for="Input.Password" data-valmsg-replace="true"></span>
                </div>
                <div class="form-label-group">
                    <input class="form-control" placeholder="Confirm password" type="password" data-val="true" data-val-equalto="The password and confirmation password do not match." data-val-equalto-other="*.Password" id="Input_ConfirmPassword" name="password2" />
                    <label for="Input_ConfirmPassword">Confirm password</label>
                    <span class="text-danger field-validation-valid" data-valmsg-for="Input.ConfirmPassword" data-valmsg-replace="true">'. $war2.'</span>
                </div>
                <p class="register-policy-links">
                    By clicking on "Create account", I agree to the <a target="_blank" href="/policy/terms">Terms of Use <i class="fa fa-external-link"></i></a> and <a target="_blank" href="/policy/privacy">Privacy Policy <i class="fa fa-external-link"></i></a>.
                </p>
                <button type="submit" name="action" class="btn btn-block btn-primary mt-3">Create account</button>
                <a class="btn btn-block btn-outline-primary" href="login.wow">Already have an account?</a>
            </form>
        </div>
    </div>
</section>

			  ';
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();
?>