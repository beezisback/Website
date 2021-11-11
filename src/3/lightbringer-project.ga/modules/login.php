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
//if session set, then we shoudlnt be here
if (!$a_user['is_guest'])
{
	
	$cont2= "You are now logged in! <meta http-equiv='refresh' content='0;url=news.wow'/>";
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
	if (pun_htmlspecialchars($_POST['username'])=='')
		{
			$cont2= "Your user name needs to be filled in. <meta http-equiv='refresh' content='2;url=login.wow'/>";
		}
		elseif (pun_htmlspecialchars($_POST['username'])=='')
		{
			$cont2= "Your password needs to be filled in. <meta http-equiv='refresh' content='2;url=login.wow'/>";
		}
	//lets select acc db
	mysql_select_db($acc_db);
	special_core_exec_onlogin(pun_htmlspecialchars($_POST['username']));
	
	$a  = mysql_query("SELECT ".$db_translation['encrypted_password']." FROM ".$db_translation['accounts']." WHERE ".$db_translation['login']." = '".$db->escape(pun_htmlspecialchars($_POST['username']))."'") or die (mysql_error());
	$a2 = mysql_fetch_array($a);
	if ($a2[0]==sha1(strtoupper(pun_htmlspecialchars($_POST['username'])).':'.strtoupper(pun_htmlspecialchars($_POST['password'])))) 
	{
		if (pun_htmlspecialchars($_POST['username'])=='')
		{
			$cont2= "Your user name needs to be filled in. <meta http-equiv='refresh' content='0;url=login.wow'/>";
		}
		elseif (pun_htmlspecialchars($_POST['password'])=='')
		{
			$cont2= "Your password needs to be filled in. <meta http-equiv='refresh' content='0;url=login.wow'/>";
		}
		else
		{
			$_SESSION['user']=pun_htmlspecialchars($_POST['username']);
			header("Location: accounts.wow");
			//$cont2= "<font size='4'>You are now logged in! </font><meta http-equiv='refresh' content='0;url=accounts.wow'/>";
		}
		$cont2= "You are now logged in! <meta http-equiv='refresh' content='0;url=news.wow'/>";
        $box_wide->setVar("content", $cont2);					
        print $box_wide->toString();
		include "top.php";
		$tpl_footer = new Template("styles/".$style."/footer.php");
	    print $tpl_footer->toString();
	    exit;
	    }
	    else
	    {
		$warn = "<font color='red'>(!)</font>";
				$warn2 = "						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div id='TheBlogWidgets'>
</div>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Incorrect username or password!</div>
</div>
</div>";
	}
} 
$cont2='
<body class="bg">
<h1 class="logo-w-250">Endless Login</h1>
<section class="container dark-content-sm">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form action="" method="post">
                <div class="text-danger validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
</ul></div>
                <div class="form-label-group">
                    <input class="form-control" placeholder="Account name" autocomplete="off" autofocus type="text" data-val="true" data-val-required="The account name field is required." id="Input_Username" name="username" value="" />
                    <label for="Input_Username">Account name</label>
                </div>
					<td style="text-align: center;">'. $warn2.'</td>
                <div class="form-label-group">
                    <input class="form-control" placeholder="Password" type="password" data-val="true" data-val-required="The password field is required." id="Input_Password" name="password" />
                    <label for="Input_Password">Password</label>
                </div>
                <div class="form-group">
                    <button type="submit" name="action" class="btn btn-block btn-primary">Log in</button>
                </div>
                <a href="register.wow">Create an account</a>
                <a class="pull-right" href="account_recovery.wow">Forgot password?</a>
            </form>
        </div>
    </div>
</section>

';	 
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();
?>