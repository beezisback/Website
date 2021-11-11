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
						<strong>Thank you for your donation <font color="#9a2828"><strong>'. $a_user[$db_translation['login']].'</strong></font>! <br>
						Your Donation Points should be added now.</strong>
						<br><br/>
						<div class="acc-b-m">
							<table cellpadding="0" cellspacing="0">
								<tr>
                               	 <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/star2.png"></td>
                                	<td valign="top">
                                		<a href="./quest_ac.php?name=Donation_Shop"> Donation Shop </a> <br/>
                                		<div class="acc_b_de">Exchange your donation points and get rewards!</div>
                               		</td>
                          		</tr>
							</table>
						</div>
					</div>
				</td>
			</tr>
		</table></center>'; 

$box_wide->setVar("content_title", "Thank You!");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				