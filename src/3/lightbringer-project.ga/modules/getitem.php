<script>
function showitems(str) {
  if (str.length==0) {
    document.getElementById("lookup_items").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("lookup_items").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getitem.php?q="+str,true);
  xmlhttp.send();
}
</script>
<script type="text/javascript">
function lookup(inputString) {
	if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("items.php", {queryString: ""+inputString+""},
 function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
			else $('#suggestions').hide();
        });
    }
} // lookup

function fill(thisValue) {
                $('#inputString').val(thisValue);
     setTimeout("$('#suggestions').hide();", 200);
    }

</script>
<style>
.wm-ui-btn {
    background: #1c1c1c;
    background: -moz-linear-gradient(top, #1c1c1c 0%, #1a1a1a 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1c1c1c), color-stop(100%,#1a1a1a));
    background: -webkit-linear-gradient(top, #1c1c1c 0%,#1a1a1a 100%);
    background: -o-linear-gradient(top, #1c1c1c 0%,#1a1a1a 100%);
    background: -ms-linear-gradient(top, #1c1c1c 0%,#1a1a1a 100%);
    background: linear-gradient(to bottom, #1c1c1c 0%,#1a1a1a 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1c1c1c', endColorstr='#1a1a1a',GradientType=0 );
    text-shadow: 2px 2px 2px #202020;
    font-family: "FuturaEF-Book";
    color: #999;
    font-size: 14px;
    width: 193px;
    height: 42px;
    border-radius: 4px;
    line-height: 42px;
    text-align: center;
    cursor: pointer;
    border: none;
    outline: none;
}
</style>
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

//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include
patch_include("sendmail",false);
if (!isset($_SESSION['user'])) 
{
include "content.php";
print '	
<p><b>You are not logged in.</b></p>

</div>
</div>
</div>
</div>
';
include "top.php";
	$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;
}
if (isset($_POST['realm']))
 {
 
 $_SESSION['realm']= $_POST['id'];
 
 }



//now reduce points
$db->select_db($db_name) or die(mysql_error());

//send item to character
if (isset($_POST['action'])) 
{
	//we get char id
	if ($_POST['character']=='none')
	{
		box ('Account Manager','<center>You don\'t have any characters. Mail can\'t be sent.</center>'); 
		$tpl_footer = new Template("styles/".$style."/footer.php");
		print $tpl_footer->toString();
		exit;
	}
	$pieces = explode("-", $_POST['character']);
	$char = $pieces[0];  //char guid
	$realm_data123 = $pieces[1]; //realm
	
	
	
	if ($_POST['itemsgrup']=='')
	{
		box ('Account Manager','<center>No item selected.</center>');
		$tpl_footer = new Template("styles/".$style."/footer.php");
		include "top.php" ;
		print $tpl_footer->toString();
		exit;
	}
	
	$itemsgrup = $_POST['itemsgrup']; //this is shop ID
	//now we get all required data for this shop ID
	$checkshopid = $db->query("SELECT * FROM vote_items WHERE entry='".$itemsgrup."' LIMIT 1") or die(mysql_error());
		if (mysql_num_rows($checkshopid)=='0')
			{box ('Account Manager','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.webwow.totalh.com" target="_blank">AXE</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$a_user[$db_translation['login']].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? Stupid humans...'); 
		$tpl_footer = new Template("styles/".$style."/footer.php");
	print $tpl_footer->toString();
	exit;}
	
	$checkshopid2=mysql_fetch_assoc($checkshopid);
	
	$vote_costs2 = $db->query("SELECT * FROM vote_costs WHERE start_itemlevel <= ".$checkshopid2["ItemLevel"]." AND end_itemlevel >= ".$checkshopid2["ItemLevel"]." LIMIT 1") or die (mysql_error());
    $row2 = $db->fetch_assoc($vote_costs2);
	
	if (!$row2)
     $costpoints = '100';
     //$costpoints = '100';
    else
     $costpoints = $row2["points"];
     $donate = $row2["dp"];
	 
	$cost = $costpoints;
	$dp = $donate;
	
	$itemid = $checkshopid2['entry'];
	$item_stack = '1';

		//reduce points
		if ($a_user['vp']>=$cost OR $a_user['dp']>=$dp)
		{
		}
		else
		{
			box ('Account Manager','<center>You don\'t have enough points to buy that item.<br>You have '.$a_user['vp'].'  points and item costs '.$cost.' points. </center>');
			$tpl_footer = new Template("styles/".$style."/footer.php");
			include "top.php" ;
			print $tpl_footer->toString();
			exit;
		}

		//check if realm db is availavable and select db
		$i=1;
		while ($i<=count($realm))
		{
			if ($pieces[1]==$i)
			{
				if ($realm[$i]['db']=='')
				{box ('Fail','Realm '.$pieces[1].' does not exist!');
			   $tpl_footer = new Template("styles/".$style."/footer.php");
				print $tpl_footer->toString();
				exit;}
				$db->select_db($realm[$i]['db']);
			}
			$i++;
		}
		
		
		//now we check if this is truly char witch belongs to your account
		$checkchar = $db->query("SELECT ".$db_translation['characters_name'].",".$db_translation['characters_guid']." FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_guid']."='".$char."' AND ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."' LIMIT 1") or die(mysql_error());
		if (mysql_num_rows($checkchar)=='0')
			{box ('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.webwow.totalh.com" target="_blank">AXE</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$db_translation['login'].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? You CAN\'T SEND ITEMS TO CHARACTERS THAT AREN\'T ON YOUR ACCOUNT. Stupid humans...');
        $tpl_footer = new Template("styles/".$style."/footer.php");

	print $tpl_footer->toString();
	exit;}
		
		$charname=$db->fetch_array($checkchar);
		//add mail here
		$time = date("m-d-Y, h:i");
		$refnum=date("jnGis");
        $subject = 'VoteShop';//do not remove $refnum
		$body = 'Lastwow.ml';

		//refrence-> sendmail($playername,$playerguid, $subject, $text, $item, $shopid, $money=0,$realmid=false) //returns
		$sendingmail=sendmail($charname[0],$charname[1], $subject, $body, $itemid,'0','0',$pieces[1]);	
		//SQL
		
		
		if (substr($sendingmail, 0, 16)=="<!-- success -->")
			
		{
		

        if ($a_user['vp']>=$cost)
			
		{
			
		     $newpoints=$a_user['vp']-$cost;
		   // $newdonate=$a_user['dp']-$dp;
			$db->select_db($db_name);
			$delpoints = $db->query("UPDATE accounts_more SET vp='".$newpoints."' WHERE acc_login='".$a_user[$db_translation['login']]."'") or die(mysql_error());
				
								$sendingmail.="						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div class='remove-borda'>
</div>
<br>
<div class='text'>VP Points are taken.</div>
<div class='buttons'>
        <a class='popup_button' href='accounts.wow'><span>Account Panel</span></a>
		 
    </div>
</div>
</div>";
			
			
		}
		else
		{
		
	   	  //$newpoints=$a_user['vp']-$cost;
		    $newdonate=$a_user['dp']-$dp;
			$db->select_db($db_name);
			$delpoints2 = $db->query("UPDATE accounts_more SET dp='".$newdonate."' WHERE acc_login='".$a_user[$db_translation['login']]."'") or die(mysql_error());
			
			
					$sendingmail.="						
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div class='remove-borda'>
</div>
<br>
<div class='text'>DP Points are taken.</div>
<div class='buttons'>
        <a class='popup_button' href='accounts.wow'><span>Account Panel</span></a>
		 
    </div>
</div>
</div>";
	
			
		
		}
	}


	box ($sendingmail);
	$tpl_footer = new Template("styles/".$style."/footer.php");

	print $tpl_footer->toString();
	exit;
	}

//
//select web database
//
$db->select_db($db_name);

//
//	Display shop:
//

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
                Purchase items
            </div>
            <div class="card-body">            
';
$cont2.='<div class="voteshop1">';
$cont2.='
<div class="new_vote_searchdiv" align="center">
 <input type="hidden" name="i" value="getitem">
<div class="searc-inp">		
<p> Here you can use vote or donation points to get items. Just type the name of your desired item.</p> 
<input autocomplete="off" type="textbox" id="inputString" onchange="showitems(this.value)" onKeyup="lookup(this.value);" onblur="fill();" onclick=this.value="" value="Type the name of your item here" style="font-size: 15px; padding-top: 4px; border: 1px solid black; width:299px; text-align:center; font-weight:bold" />  
<div class="autocomplete-w1" id="suggestions"  style="display: none;">
<div style="width:297px;" id="autoSuggestionsList" class="autocomplete"></div>
</div>
<form method="post" action="">
<table border="0" width="650px" align="center" cellpadding="0" cellspacing="0">	
<div id="lookup_items"></div>';

$cont2 .='</form><br></table></div></div></div>
</div>
</div>
</div>
</div>
</section>
';				
$box_wide->setVar("content", $cont2);					
 print $box_wide->toString();
?>