<div id="menu">
<ul>
<li><a href="index.wow">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li class="active">Account Manager | </li> <li><a href="connection.wow">Connection guide</a> | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>
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
		 
       return "<td><img src='./styles/".$style."/Images/vote/".$site.".jpg' border='' onmouseover='this.style.opacity=0.5' onmouseout='this.style.opacity=1' /><br />Time left: $timeaz </td>"

     ;} 
	 
	 else 
	{
		if ($url=='')
		{
			$zzs=$zzs+1;
			
		}
		else
			
		
			return "
			<td><a href='./vote.php?vote=".$url2."' target='_blank'><img src='./styles/".$style."/Images/vote/".$site.".jpg'></a><br />&nbsp;&nbsp;&nbsp;&nbsp;Vote Now</td>
			
		
	

			
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


$cont2.='<p style="float: right;">Hello <b>'. $a_user[$db_translation['login']].'</b>, you have <b>'. $a_user['dp'].' DP</b> and <b>'. $a_user['vp'].' VP</b> 
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
		<br>
		<p>
		We have not reached the target in Xtremetop100 for this month, so no extra vote points are given. Remember you can get extra vote point when the server reaches the target position, so keep voting every day!
		</p>
		<table width="100%" style="padding:10px; margin-top: 20px; margin-left:50px; opacity:1;" > 
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
';


  $i=1;
  	while ($i<=count($voteurls) && count($voteurls)<>'0')
	{
		
		$cont2.=" ";
		
		
    	$cont2.=check2($i,$voteurls[$i]);
		
		$cont2.=" ";
		
		
		if ($i==5 || $i==10 || $i==20 || $i==30){$cont2.="<br />";}
	
		$i++;
	}
	
	
    $cont2.="</table>";

$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
?>	
<?php
include "top.php";
?>