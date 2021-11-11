<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{

print '	
<body class="bg">
<h1 class="logo-w-250">Lightbringer Login</h1>
<section class="container dark-content-sm">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form action="login.wow" method="post">
                <div class="text-danger validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
</ul></div>
                <div class="form-label-group">
                    <input class="form-control" placeholder="Account name" autocomplete="off" autofocus type="text" data-val="true" data-val-required="The account name field is required." id="Input_Username" name="username" value="" />
                    <label for="Input_Username">Account name</label>
                </div>
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

	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
}
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include


//

?>
<?php 
$cont2='
<body class="bg">
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
    
<div class="row">
    <div class="col-md-9">
        <div class="infocard">
            <div class="card-header">
                Details
            </div>
            <div class="card-body">
                <table class="table-transp">
                    <tbody class="account-info">
                        <tr>
                            <td>Account</td>
                            <td>'. $a_user[$db_translation['login']].'</td>
                        </tr>
						
                        <tr>
                       
                            Your account was last used on: <strong><font color="#CCC">'. $a_user[$db_translation['lastlogin']].'</font></strong><br />
							Your account was last used by IP: <strong><font color="#CCC">'. $a_user[$db_translation['lastip']].'</font></strong><br />
							Your current IP is: <strong><font color="#CCC">'. get_remote_address().'</font></strong><br />

                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><font color="#ffcf00"><b>'. $a_user[$db_translation['email']].'</b></font></td>
                        </tr>
                       
						<tr>
                            <td>Welcome</td>
                            <td> <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> </td>
                        </tr>
						
						
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="infocard">
            <div class="card-header">
                Test Services
            </div>
            <div class="card-body services-list">
                <a href="/account/services/dualspecialization">Dual Spec</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Account Manager
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><a class="card-link" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><a class="card-link" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><a class="card-link" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" border=""></div>
                        <div class="card-body text-center">
                            Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><a class="card-link" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><a class="card-link" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                         <div class="card-header"><a class="card-link" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/golds.png" border=""></div>
                        <div class="card-body text-center">
                           Get gold</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

'; 

?>          
<?php
$box_wide->setVar("content", $cont2);			
print $box_wide->toString();							
?>	