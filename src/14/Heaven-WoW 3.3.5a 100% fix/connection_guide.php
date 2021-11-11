<?php
if (!defined('AXE'))
	exit;


//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include


//

$box_simple_wide->setVar("content", $cont1);
print $box_simple_wide->toString(); ?>


							<?php 
							$cont2='<table cellpadding="2" cellspacing="2"> <tr> <td valign="top">
							</div> <div class="sub-box1" align="left">
		<strong>*Connection Guide</strong> <br/>
     <strong><font color="#464646">1)</font></strong> Open C:\Program Files\World of Warcraft\Data\enGB/enUS\realmlist.wtf with notepad.<br/>
     <strong><font color="#464646">2)</font></strong> 
	  Remove all and add <font color="#9a2828">set realmlist Logon.heavenwow.com</font> and save.<br/>
     <strong><font color="#464646">3)</font></strong> Register an account above.<br/>
     <strong><font color="#464646">4)</font></strong> Enjoy the realms of Heaven-WoW!<br/>
	 <br>
	 <br>
	 <strong><font color="#464646">- </font></strong>You need World of Warcraft Patch 3.3.5a<br/>
		</div>
</center>
								

';

							 $cont2.='</td></tr></table>'; 
?>
                           
<?php
$box_wide->setVar("content_title", "Connection Guide");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				