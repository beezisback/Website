<?php
if (!defined('AXE'))
	exit;

//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

$cont2='<center><table cellpadding="2" cellspacing="2">
			<tr>
				<td valign="top">
					<div class="sub-box1" align="left">
						Thank you for your donation <font color="#9a2828"><strong>'.$a_user[$db_translation['login']].'</strong></font>.<br>Your points have been updated and you should be able to spend them.<br><br><a href="quest.php?name=account">Go back.</a>
					</div>
				</td>
			</tr>
		</table></center>'; 

$box_wide->setVar("content_title", "Donation Failed");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				