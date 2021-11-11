<div id="menu">
<ul>
<li><a href="index.wow">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li class="active">Account Manager | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
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
		$body = 'Lastwow Staff';

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
			$sendingmail.="<script type='text/javascript'> alert('VP Points are taken.'); </script>";	
			
			
		}
		else
		{
		
	   	  //$newpoints=$a_user['vp']-$cost;
		    $newdonate=$a_user['dp']-$dp;
			$db->select_db($db_name);
			$delpoints2 = $db->query("UPDATE accounts_more SET dp='".$newdonate."' WHERE acc_login='".$a_user[$db_translation['login']]."'") or die(mysql_error());
			$sendingmail.="<script type='text/javascript'> alert('DP Points are taken.'); </script>";
		
		}
	}


	box ('Account Manager',$sendingmail);
	$tpl_footer = new Template("styles/".$style."/footer.php");
	include "top.php";
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

$cont2='<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
</p><p style="clear: both;"></p>
	<table>
		<tbody><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Home" href="accounts.wow"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/home.png" border=""><br>Home</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Get Item" href="account.wow?i=getitem"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/getitem.png" border=""><br>Get Item</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donation Shop" href="account.wow?i=Donation_Shop"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/shop.gif" width="42" height="42" border=""><br>Donate Shop</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Donate" href="account.wow?i=donate"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/donate.png" border=""><br>Donate</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Unstucker" href="account.wow?i=unstucker"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/unstucker.png" border=""><br>Unstucker</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Vote" href="account.wow?i=vote"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/vote.png" border=""><br>Vote</a></td>
	</tr><tr height="20"></tr><tr>
		<td width="110" align="center"><a style="text-decoration: none;" title="Teleport" href="account.wow?i=teleport"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/teleport.png" border=""><br>Teleport</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Change" href="account.wow?i=change"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/pass.png" border=""><br>Change Pass</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Transfer" href="#"><img style="opacity: 1;" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/transfer.png" border=""><br>Transfer</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Gold" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/gold.png" border=""><br>Gold</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" title="Level" href="#"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/up.png" border=""><br>Level</a></td>
		<td width="110" align="center"><a style="text-decoration: none;" target="hidd" title="Logout" href="account.wow?i=logout&hash='.$u.'.'.$p.'"><img onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=1" src="styles/'.$style.'/Images/logout.png" border=""><br>Logout</a></td>
	</tr>
</tbody></table>
<br>'; 
$cont2.='<div class="voteshop1">';
$cont2.='
<div class="new_vote_searchdiv" align="center">
 <input type="hidden" name="i" value="getitem">
<div class="searc-inp">		
<p> Here you can use vote or donation points to get items. Just type the name of your desired item.</p> 
<input autocomplete="off" type="textbox" id="inputString" onchange="showitems(this.value)" onKeyup="lookup(this.value);" onblur="fill();" onclick=this.value="" value="Type the name of your item here" style="font-size: 15px; padding-top: 4px; border: 1px solid black; width:299px; height: 24px; text-align:center; font-weight:bold" />  
<div class="autocomplete-w1" id="suggestions"  style="display: none;">
<div style="width:297px;" id="autoSuggestionsList" class="autocomplete"></div>
</div>
<form method="post" action="">
<table border="0" width="650px" align="center" cellpadding="0" cellspacing="0">	
<div id="lookup_items"></div>';

$cont2 .='</form><br>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- mp3auto -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7001804713907847"
     data-ad-slot="5448241613"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</table></div></div></div>';
						$box_wide->setVar("content_title", "Account Manager");	
                        $box_wide->setVar("content", $cont2);					
                        print $box_wide->toString();
?>
<?php
include "top.php" ;
?>