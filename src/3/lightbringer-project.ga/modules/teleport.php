<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{
include "content.php";
header("Location: accounts.wow");
	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
}

//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include



if(isset($_POST['submit']))
{
	$guid1 = explode ('-',preg_replace( "/[^0-9-]/", "", $_POST['char'] ));
	$guid	 = $guid1[0];
	$realmid = $guid1[1];
	$i=1;
	while ($i<=count($realm))
	{
		if ($realmid==$i)
		{
			$db->select_db($realm[$i]['db']);
		}
	
		$i++;
	}
 
	$acct = "";							//acct id from db
	$race = "";							//characters race id
    $level = "";                        //Character Level


	$location = preg_replace( "/[^0-9]/", "", $_POST['location'] );

	$query = "SELECT ".$db_translation['characters_race'].", ".$db_translation['characters_level'].", ".$db_translation['characters_gold']." FROM ".$db_translation['characters']." WHERE  ".$db_translation['characters_guid']." = '".$guid."' AND ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."'";
	$result = mysql_query($query);
    $numrows = $result;
	
	if ($numrows == 0)
	{
		box('','<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />		
<script type="text/javascript">
	alert("That character does not exist on your account.");
</script>
		');
		
		$tpl_footer = new Template("styles/".$style."/footer.php");
	
	print $tpl_footer->toString();
	exit;
	}

	$row = mysql_fetch_array($result);
	$race = $row[0];
    $level = $row[1];

	if($row[2] < $module_teleporter_gold)
	{

			box('','<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />		
<script type="text/javascript">
	alert("Your character does not have enough gold to be teleported. ('.$row[2].')");
</script>
		');

	$tpl_footer = new Template("styles/".$style."/footer.php");

	print $tpl_footer->toString();
	exit;
	}
	$gold = $row[2];
	

	$map = "";
	$x = "";
	$y = "";
	$z = "";
	$place = "";

		switch($location)
	{
		//stormwind
		case 1:
			$map = "0";
			$x = "-8913.23";
			$y = "554.633";
			$z = "93.7944";
			$place = "Stormwind City";
			break;
		//ironforge
		case 2:
			$map = "0";
			$x = "-4981.25";
			$y = "-881.542";
			$z = "501.66";
			$place = "Ironforge";
			break;
		//darnassus
		case 3:
			$map = "1";
			$x = "9951.52";
			$y = "2280.32";
			$z = "1341.39";
			$place = "Darnassus";
			break;
		//exodar
		case 4:
			$map = "530";
			$x = "-3987.29";
			$y = "-11846.6";
			$z = "-2.01903";
			$place = "The Exodar";
			break;
		//orgrimmar
		case 5:
			$map = "1";
			$x = "1676.21";
			$y = "-4315.29";
			$z = "61.5293";
			$place = "Orgrimmar";
			break;
		//thunderbluff
		case 6:
			$map = "1";
			$x = "-1196.22";
			$y = "29.0941";
			$z = "176.949";
			$place = "Thunder Bluff";
			break;
		//undercity
		case 7:
			$map = "0";
			$x = "1586.48";
			$y = "239.562";
			$z = "-52.149";
			$place = "The Undercity";
			break;
		//silvermoon
		case 8:
			$map = "530";
			$x = "9473.03";
			$y = "-7279.67";
			$z = "14.2285";
			$place = "Silvermoon City";
			break;
		//shattrath
		case 9:
			$map = "530";
			$x = "-1863.03";
			$y = "4998.05";
			$z = "-21.1847";
			$place = "Shattrath";
			break;
		//for unknowness -> shattrath
		default:
		
		box('','<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />		
<script type="text/javascript">
	alert("That is an invalid location.");
</script>
		');

			break;
	}

	//disallows factions to use enemy portals
	switch($race)
	{
		//alliance
		case 1:
		case 3:
		case 4:
		case 7:
		case 11:
			if((($location >=5) && ($location <=8)) && ($location != 9))
			{
				
				box('','<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />		
<script type="text/javascript">
	alert("Alliance players may not be teleported to horde areas.");
</script>
		');
	
	$tpl_footer = new Template("styles/".$style."/footer.php");
	
	print $tpl_footer->toString();
	exit;
			}
			break;
		//horde
		case 2:
		case 5:
		case 6:
		case 8:
		case 10:
			if ((($location >=1) && ($location <=4)) && ($location != 9))
			{
				
				
				box('','<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />		
<script type="text/javascript">
	alert("Horde players may not be teleported to alliance areas.");
</script>
		');
		
	
	$tpl_footer = new Template("styles/".$style."/footer.php");
	
	print $tpl_footer->toString();
	exit;
			}
			break;
		default:
			die("<center>The selected race is not valid.<br><br></center>");
			break;
	}

    if($level < 58 && $location == 9)
    {
    	box('','<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />
<script type="text/javascript">
	alert("This location requires you to be at least level 58.");
</script>
<center><b>This location requires you to be at least level 58.</b></center>
');

	$tpl_footer = new Template("styles/".$style."/footer.php");
	
	print $tpl_footer->toString();
	exit;
    }

	$newGold = $gold - (module_teleporter_gold);

	$tele_p=teleport($guid,$x,$y,$z,$map,$newGold);//returns
	if ($tele_p)
	{
		$cont2=$tele_p;
	}
	else
	{
	
	$cont2= '<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />	
	<script type="text/javascript">
	alert("Your character has been teleported to '.$place.'.");
</script>
	         <form name="myform" method="post" action="account.wow?i=teleport">
		';

    $cont2.= "$lan[TELEPORTER]";
	//***START DROPDOWN****(c)axe
	$user=$a_user[$db_translation['login']];
	$db->select_db($acc_db);
	$SQLwow ="SELECT * from ".$db_translation['accounts']." where ".$db_translation['login']."='".$db->escape($a_user[$db_translation['login']])."'";
	$SQLwow2=mysql_query($SQLwow) or die("Could not get user character information".mysql_error());
	$SQLwow3=mysql_fetch_array($SQLwow2);
	$cont2.= "<center><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$cont2.= '<select name="char" style="width: 200px;"><option value="">Select your character</option>';
	$i=1;
	while ($i<=count($realm))
	{
		$db->select_db($realm[$i]['db']);
		$SQLawow ="SELECT * from ".$db_translation['characters']." where ".$db_translation['characters_acct']."='".$SQLwow3[$db_translation['acct']]."'";
		$char=mysql_query($SQLawow) or die("Could not get user character information");
		while ($char2=mysql_fetch_array($char))
		{
			$cont2.= "<option value=' ".$char2[$db_translation['characters_guid']]."-".$i."'>".$realm[$i]['']."  ".$char2[$db_translation['characters_name']]."</option>";
			}
		$i++;					
	}	
	
	
		  $cont2.= "</select>";
		  $cont2.= "</td><td>";

   //******END DROPDOWN********
	$cont2.= "<center> ";
	$cont2.= "<center><select name=location></center>";
	$cont2.= "<option value='1'>Stormwind</option>";
	$cont2.= "<option value='2'>Ironforge</option>";
	$cont2.= "<option value='3'>Darnassus</option>";
	$cont2.= "<option value='4'>Exodar</option>";
	$cont2.= "<option value='---------'>------------------</option>";
	$cont2.= "<option value='5'>Orgrimmar</option>";
	$cont2.= "<option value='6'>Thunder Bluff</option>";
	$cont2.= "<option value='7'>Undercity</option>";
	$cont2.= "<option value='8'>Silvermoon</option>";
	$cont2.= "<option value='---------'>------------------</option>";
	$cont2.= "<option value='9'>Shattrath</option>";
	$cont2.= "</select></td></tr></table></center>";
	if ($module_teleporter_gold<>'0')
	$cont2.= "";

	$cont2.= "<br><center><input style='border: 1px solid black; height: 23px; width:100px' type='submit' name='submit' value='Teleport now'></center>";
	
	
	$cont2.= "<div class='line2'></div>";
		
		
	
	}
	

	$cont2.= "</td></tr>";
	
}
else
{
	
	$cont2= '<body class="bg">
<nav class="navbar navbar-expand-md navbar-dark" role="navigation">
    <div class="container no-override">
        <a class="navbar-brand" href="news.wow">
            <img src="styles/'.$style.'/images/logo.png" class="logo d-none d-md-inline pt-md-3 pb-md-3" />
            <img src="styles/'.$style.'/images/logo-c.svg" class="logo-sm d-lg-none d-md-none d-sm-inline" />
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
                            <td>maikale</td>
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
                            <td>Join date</td>
                            <td>Wednesday, 11 December 2019</td>
                        </tr>
						
						<tr>
                            <td>Join date</td>
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
                Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-02.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Shop</p>
                            <a class="card-link" href="account.wow?i=getitem">Purchase items</a>
                        </div>
                    </div>
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-04.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Teleport character</p>
                            <a class="card-link" href="account.wow?i=teleport">Teleport</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/hs-active.png" width="115" height="128" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Unstuck character</p>
                            <a class="card-link" href="account.wow?i=unstucker">Unstucker</a>
                        </div>
                    </div>
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-07.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Vote</p>
                            <a class="card-link" href="account.wow?i=vote">Vote for the server</a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/images/cp-nav-hov-01.png" border=""></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="account.wow?i=change">Change password</a>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-4 security-box mb-lg-0">
                        <div class="card-header"><i class="fa fa-lock"></i></div>
                        <div class="card-body text-center">
                            <p class="card-text">Password never changed</p>
                            <a class="card-link" href="/account/manage/changepassword">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Recent activity
            </div>
            <div class="card-body">
                    <table class="table-transp mb-2">
                            <tr>
                                <td>Logged in 13 minutes ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 1 hour ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Logged in 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                            <tr>
                                <td>Failed login attempt 3 hours ago from 62.221.130.253</td>
                            </tr>
                    </table>
                <a class="pb-2" href="/account/manage/history">Show full history</a>
            </div>
        </div>
    </div>
</div>

</section>

<p> You can teleport your character from here to any main city.<br>For the teleporting process to be successful, you need to be <b>offline</b>.<br>This service has a cost of 5 gold.</p><br>
		<br />	
	         <form name="myform" method="post" action="account.wow?i=teleport">
		';

    $cont2.= "$lan[TELEPORTER]";
	//***START DROPDOWN****(c)axe
	$user=$a_user[$db_translation['login']];
	$db->select_db($acc_db);
	$SQLwow ="SELECT * from ".$db_translation['accounts']." where ".$db_translation['login']."='".$db->escape($a_user[$db_translation['login']])."'";
	$SQLwow2=mysql_query($SQLwow) or die("Could not get user character information".mysql_error());
	$SQLwow3=mysql_fetch_array($SQLwow2);
	$cont2.= "<center><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$cont2.= '<select name="char" style="width: 200px;"><option value="">Select your character</option>';
	$i=1;
	while ($i<=count($realm))
	{
		$db->select_db($realm[$i]['db']);
		$SQLawow ="SELECT * from ".$db_translation['characters']." where ".$db_translation['characters_acct']."='".$SQLwow3[$db_translation['acct']]."'";
		$char=mysql_query($SQLawow) or die("Could not get user character information");
		while ($char2=mysql_fetch_array($char))
		{
			$cont2.= "<option value=' ".$char2[$db_translation['characters_guid']]."-".$i."'>".$realm[$i]['']."  ".$char2[$db_translation['characters_name']]."</option>";
			}
		$i++;					
	}	
	
	
		  $cont2.= "</select>";
		  $cont2.= "</td><td>";

   //******END DROPDOWN********
	$cont2.= "<center> ";
	$cont2.= "<center><select name=location></center>";
	$cont2.= "<option value='1'>Stormwind</option>";
	$cont2.= "<option value='2'>Ironforge</option>";
	$cont2.= "<option value='3'>Darnassus</option>";
	$cont2.= "<option value='4'>Exodar</option>";
	$cont2.= "<option value='---------'>------------------</option>";
	$cont2.= "<option value='5'>Orgrimmar</option>";
	$cont2.= "<option value='6'>Thunder Bluff</option>";
	$cont2.= "<option value='7'>Undercity</option>";
	$cont2.= "<option value='8'>Silvermoon</option>";
	$cont2.= "<option value='---------'>------------------</option>";
	$cont2.= "<option value='9'>Shattrath</option>";
	$cont2.= "</select></td></tr></table></center>";
	if ($module_teleporter_gold<>'0')
	$cont2.= "";

	$cont2.= "<br><center><input style='border: 1px solid black; height: 23px; width:100px' type='submit' name='submit' value='Teleport now'></center>";
	
	
	$cont2.= "<div class='line2'></div>";

}
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
?>