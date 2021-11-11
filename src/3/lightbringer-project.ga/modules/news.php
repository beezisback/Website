<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{

print '	
<body class="bg">
<h1 class="logo-w-250">Endless Login</h1>
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
                    <a class="nav-link active" href="/news.wow">NEWS</a>
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
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> '. $a_user[$db_translation['login']].' <i class="fa fa-chevron-down"></i>
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
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/changelog">Changelog</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="news-posts-list">
        <div class="row">
            <div class="col-lg-8">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane show active">
                        <div class="row">
                                    <div class="col-md-12">
									
									
								 <div class="post">
                <a class="title" href="/news/11">Important! TBC Release</a>
            <div class="date">Tuesday, 11 December 2019</div>
            <div class="description"><div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/IBHL_-biMrQ"></iframe>
</div>
<p>Coming soon our new realm tbc!</p></div>
                <a class="read-more" href="/news/11">
                    Read more
                    <i class="fa fa-chevron-right"></i>
                </a>
        </div>			
									
        <div class="post">
                <a class="title" href="/news/11">Trailer and release date</a>
            <div class="date">Tuesday, 11 December 2019</div>
            <div class="description"><div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vlVSJ0AvZe0"></iframe>
</div>
<p>Check out our latest video in which you will find more information about the project and its features. We re also happy to announce the server will be released in February 2020!</p></div>
                <a class="read-more" href="/news/11">
                    Read more
                    <i class="fa fa-chevron-right"></i>
                </a>
        </div>
		
		
    </div>


'; 
?>   
<?php
$box_wide->setVar("content", $cont2);			
print $box_wide->toString();
include "top.php";							
?>	