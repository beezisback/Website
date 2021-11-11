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
		<strong>Thank you for your donation <font color="#9a2828"><strong>'. $a_user[$db_translation['login']].'</font></strong>! <br>
		Your Donation Points have been added to your Account!</strong><br>		<br/>		<div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/star2.png"></td>
                                <td valign="top">
                                <a href="./quest_ac.php?name=Donation_Shop"> Donation Shop </a> <br/>
                                <div class="acc_b_de">Exchange your donation points and get rewards!</div>
                                </td>
                                </tr></table></div>
	
		</div>
</center>
								

';

							 $cont2.='</td></tr></table>'; 
?>
                           
<?php
$box_wide->setVar("content_title", "Thank You!");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				