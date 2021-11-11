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
print '	
<p>`<b>Welcome to your Account Manager</b></p>
<form action="login.wow" method="post">
<fieldset>
<table style="text-align: right;" width="100%" align="center">
<tr><td width="200">Username:</td><td width="140"><input name="username" type="text" onblur="validate(this.value,\'userok\');" onclick="this.value=\'\'" value="User" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td><img id="userok" style="display: none;" src="styles/'.$style.'/Images/ok.png"/></td></tr>
<tr><td width="200">Password:</td><td width="140"><input name="password" type="password" onblur="validate(this.value,\'passok\');" onclick="this.value=\'\'" value="Password" style="padding: 2px; font-weight: bold; border: 1px solid black; width: 120px; height: 16px;"/></td>
<td><img id="passok" style="display: none;" src="styles/'.$style.'/Images/ok.png"/></td></tr>
<tr><td style="text-align: center;" colspan="3"></td></tr>
<tr><td style="text-align: center;" colspan="3"><br/><input style="border: 1px solid black; width: 50px; height: 24px;" type="submit" name="action" value="Login"/></td></tr>
<tr><td style="text-align: center;" colspan="3">Don t remember your password? <a title="Password Recovery" href="account_recovery.wow">Click Here</a></td></tr>
<tr><td style="text-align: center;" colspan="3"><img src="styles/'.$style.'/Images/siteseal_gd_3_h_d_m.gif" /><span id="siteseal"><br/></span></td></tr> 
</table>
</fieldset>
</form>
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
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include


//

?>
    
							<?php 
							
	
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

?>          
<?php
$box_wide->setVar("content_title", "Account Manager");	
$box_wide->setVar("content", $cont2);			
print $box_wide->toString();							
?>	
<?php
include "top.php";
?>