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
if (isset($_POST['unstuck'])) 
{
	$realmid=$_POST['realm'];
	$realmid = preg_replace( "/[^0-9]/", "", $_POST['realm'] ); //only letters and numbers
	
	
	$i=1;
	while ($i<=count($realm))
	{
		if ($realmid==$i)
		{
			$db->select_db($realm[$i]['db']);
		}
	
		$i++;
	}
	
	
	$char_guid = preg_replace( "/[^0-9]/", "", $_POST['chars'] ); //only letters and numbers
	$a=unstuck($char_guid);
	if ($a)
	{
		box ('Fail',$a);
	}
	else
	{
		
		$thisboxstring.="						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Your character has been unstuck!</div>
<div class='buttons'>
        <a class='popup_button' href='accounts.wow'><span>Account Panel</span></a>
		 <meta http-equiv='refresh' content='2;url=accounts.wow'/>
    </div>
</div>
</div>";
box ($thisboxstring);

	}

	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
} 

$cont2='<body class="bg">
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
                Unstucker
            </div>
            <div class="card-body">
                    		<p>If your character has become stuck, you can use this option to return it to your hearthstone location.</p> <br>


		
';

//***START DROPDOWN****(c)axe
	$user=$a_user[$db_translation['login']];
	$db->select_db($acc_db);
	$SQLwow ="SELECT * from ".$db_translation['accounts']." where ".$db_translation['login']."='".$db->escape($a_user[$db_translation['login']])."'";
	$SQLwow2=mysql_query($SQLwow) or die("Could not get user character information".mysql_error());
	$SQLwow3=mysql_fetch_array($SQLwow2);
	
	
	$i=1;
	while ($i<=count($realm))
	{
		
	$cont2.= '
	<form style="text-align: center;" action="" method="post">
	<input name="realm" type="hidden" value="'.$i.'" />
	<select name="chars" style="width: 200px;background-color: #0F0F0F;color: #ffcf00;border: 1px solid #1e1e1e; font-size: 14px; height: 29px;">
    <option selected="selected"  value="">Select your character</option>
	';
	
	$db->select_db($realm[$i]['db']);
	$SQLawow ="SELECT * from ".$db_translation['characters']." where ".$db_translation['characters_acct']."='".$SQLwow3[$db_translation['acct']]."'";
	$char=mysql_query($SQLawow) or die("Could not get user character information");
		
	while ($char2=mysql_fetch_array($char))
		{

	$cont2.= '<option value="'.$char2[$db_translation['characters_guid']].'">'.$realm[$i][''].' '.$char2[$db_translation['characters_name']].'</option>';
	}
		$i++;					
	}
	
$cont2.= "</select><br><br>";
$cont2.= '<input style="border: 0px solid black;" class="shop_button" name="unstuck" value="Unstuck" type="submit">';
$cont2.= '</form>            </div>
        </div>
    </div>
</div>

</section>';
			
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
							
?>	