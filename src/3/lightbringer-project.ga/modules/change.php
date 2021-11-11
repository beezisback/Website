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
	margin-top: 40px;
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
if (!isset($_SESSION['user'])) 
{
include "content.php";
header("Location: accounts.wow");
include "top.php";
	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
}
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
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
				
				
				$changes = "						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div id='TheBlogWidgets'>
</div>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Your password has been changed.</div>
<meta http-equiv='refresh' content='2;url=accounts.wow'/>
</div>
</div>";
box ($changes);   
			//	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');//
				//print $tpl_footer->toString();//
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
				
$changes1 = "						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div id='TheBlogWidgets'>
</div>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Your password has been changed.</div>
<meta http-equiv='refresh' content='2;url=accounts.wow'/>
</div>
</div>";
box ($changes1); 

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
$cont2.='<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.png" class="logo-sm d-lg-none d-md-none d-sm-inline" />
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav ml-auto">
			<li class="nav-item">
                    <a class="nav-link " href="news.wow">NEWS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/soonstreams">STREAMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/armory">ARMORY</a>
                </li>
<li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown"> '. $a_user[$db_translation['login']].' <i class="fa fa-chevron-down"></i>
                    </a>
                        <div class="dropdown-menu dropdown-menu-dark dropdown-menu-right" role="menu">
                            <a class="dropdown-item" href="accounts.wow"><i class="fa fa-cogs"></i>My account</a>
                            <a class="dropdown-item logout-btn" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><i class="fa fa-sign-out"></i>Log out</a>
                        </div>
                </li>
            </ul>
        </div>
    </div>
</nav>					
							
	
<div id="alert-container" class="sticky-top"></div>

<section class="container dark-content">
    
<p>
    <a href="accounts.wow">My account</a> / Change Password
</p>
<div class="row justify-content-center">
    <div class="col-md-12 pt-5">
        <div class="row">
            <div class="col-lg-6">
                <ul>
                    <li>Use 6-16 characters.</li>
                    <li>Use at least one digit (0-9).</li>
                    <li>Don t use a password similar to your account name.</li>
                </ul>
            </div>
            <div class="col-lg-6">
      <form action="" method="post">
                    
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Enter old password" type="password" data-val="true" data-val-required="Please enter your old password." id="Input_OldPassword" name="pass_old" />
						'. $warn1 .'
                        <label for="Input_OldPassword">Old Password</label>
                        <span class="text-danger field-validation-valid" data-valmsg-for="Input.OldPassword" data-valmsg-replace="true"></span>

                    </div>
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Enter new password" type="password" data-val="true" data-val-length="The new password must be at least 6 and at max 16 characters long." data-val-length-max="16" data-val-length-min="6" data-val-required="Please enter your new password." id="Input_NewPassword" maxlength="16" name="pass_new1" />
						'. $warn2 .'
                        <label for="Input_NewPassword">New Password</label>
                        <span class="text-danger field-validation-valid" data-valmsg-for="Input.NewPassword" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Re-enter new password" type="password" data-val="true" data-val-equalto="The new password and confirmation password do not match." data-val-equalto-other="*.NewPassword" id="Input_ConfirmPassword" name="pass_new2" />
                        <label for="Input_ConfirmPassword">Confirm Password</label>
                        <span class="text-danger field-validation-valid" data-valmsg-for="Input.ConfirmPassword" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group text-lg-right">
                        <button type="submit" name="action" class="btn btn-p-lg btn-primary">Save</button>
                        <a class="btn btn-p-lg btn-outline-primary" href="accounts.wow">Cancel</a>
                    </div>
</form>
            </div>
        </div>
    </div>
</div>

</section>
';
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();		
}


?>