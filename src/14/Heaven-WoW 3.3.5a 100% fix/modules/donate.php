<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{
	print "You are not logged in.";
	$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
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
							</div> <br/><br /><br />
                                 
								<div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/sms.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=donate_sms"> Donate via SMS! </a> <br/>
                                <div class="acc_b_de">Donate to us via SMS to earn Donation Points!</div>
                                </td>
                                </tr></table></div>
								
										<div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/star.png"></td>
                                <td valign="top">
                                <a href="./quest_ac.php?name=Donate_with_PayPal_now!"> Donate with Paypal! </a> <br/>
                                <div class="acc_b_de">Donate to us via PayPal and earn Donation Points!</div>
                                </td>
                                </tr></table></div>
								
										<div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/star2.png"></td>
                                <td valign="top">
                                <a href="./quest_ac.php?name=Donation_Shop"> Donation Shop </a> <br/>
                                <div class="acc_b_de">Exchange your donation points and get rewards!</div>
                                </td>
                                </tr></table></div>
								
								

';

							 $cont2.='</td></tr></table>'; 
?>
                           
<?php
$box_wide->setVar("content_title", "Donate to us and earn Donation Points");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				