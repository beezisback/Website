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
//say hi to lazyness ^^

$timenow = date("U");

$s=0;//number of already voted sites
$zzs=0;
function check($site) 
{
	global $a_user,$timenow,$s,$sitepath,$db_translation;
	
	$getvote="SELECT timevoted FROM vote_data WHERE userid='".$a_user[$db_translation['acct']]."' AND siteid='".$site."'";
	$getvote2=mysql_query($getvote) or error('Unable to select vote data. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Suggestion:<strong> Re-importing sql database you got in part 1 of site download will probably fix problem', __FILE__, __LINE__);
	$getvote3=mysql_fetch_array($getvote2);
	if (!$getvote3[0]) {$getvote3[0]="0";}
	if ($getvote3[0]>=$timenow) {$s++;} 
}
function check2($site,$url) 
{
  global $a_user,$timenow,$s,$sitepath,$zzs,$style,$db_translation,$style;
  
  $getvote="SELECT timevoted FROM vote_data WHERE userid='".$a_user[$db_translation['acct']]."' AND siteid='".$site."'";
  $getvote2=mysql_query($getvote) or error('Unable to update vote data. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Suggestion:<strong> Re-importing sql database you got in part 1 of site download will probably fix problem', __FILE__, __LINE__);
  $getvote3=mysql_fetch_array($getvote2);
  $timeleft3 = $getvote3[timevoted]-$timenow;
  if (!$getvote3[0]) {$getvote3[0]="0";}
  
  $url2= str_replace('&',"[i]", $url);
  $timeaz=gmdate("G:i:s",$timeleft3);
  
	 if ($getvote3[0]>=$timenow) {
		 
       return "
	   
	   
	    <div class='col-md-4 security-box mb-lg-0'>
                        <div class='card-header'><img src='./styles/".$style."/images/vote/".$site.".jpg' border='' onmouseover='this.style.opacity=0.5' onmouseout='this.style.opacity=1' /></div>
                        <div class='card-body text-center'>
                            Time left: $timeaz</a>
                        </div>
                    </div>
"

     ;} 
	 
	 else 
	{
		if ($url=='')
		{
			$zzs=$zzs+1;
			
		}
		else
			
		
			return "
			
			   <div class='col-md-4 security-box mb-lg-0'>
                        <div class='card-header'><a href='./vote.php?vote=".$url2."' target='_blank'><img src='./styles/".$style."/images/vote/".$site.".jpg'></a></div>
                        <div class='card-body text-center'>
                           Vote Now</a>
                        </div>
                    </div>

			";
			
	
	}
}
$s1=0;$s2=0;$s3=0;$s4=0;

$i=1;
while ($i<=count($voteurls) && count($voteurls)<>'0')
{
	check($i);
	$i++;
}
	//voted sites <= 1
//is there any site left?
$siteleft=count($voteurls)-$s;

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

<div class="row">
    <div class="col-md-12">
        <div class="infocard">
            <div class="card-header">
                Vote for the server
            </div>
            <div class="card-body">  
';


  $i=1;
  	while ($i<=count($voteurls) && count($voteurls)<>'0')
	{
		
		$cont2.='';
		
		
    	$cont2.=check2($i,$voteurls[$i]);
		
		$cont2.=" ";
		
		
		if ($i==5 || $i==10 || $i==20 || $i==30){$cont2.="<br />";}
	
		$i++;
	}
	
	
    $cont2.="</div>
</div>
</div>
</div>
</section>";

$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
?>	