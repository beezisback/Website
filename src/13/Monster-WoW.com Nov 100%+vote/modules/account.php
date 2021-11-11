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
							$cont2='<center>

	<div class="acc-info-box text-shadow" align="left">

		<div>

			Hello,  <font color="#878573">'. $a_user[$db_translation['login']].'</font>!<br />

			Your account was last used on: <strong><font color="#57584f">'. $a_user[$db_translation['lastlogin']].'</font></strong><br />

			Your account was last used by IP: <strong><font color="#57584f">'. $a_user[$db_translation['lastip']].'</font></strong><br />

			Your current IP is: <strong><font color="#57584f">'. get_remote_address().'</font></strong><br /><br>Your expansion is: <font color="#9c601f">';
							if ($a_user[$db_translation['flags']]==$db_translation['expansion_tbc'])
								$cont2.= 'The Burning Crusaide';
							elseif ($a_user[$db_translation['flags']]==$db_translation['expansion_wotlk'])
								$cont2.= ' Wrath of the Lich King';
							elseif ($a_user[$db_translation['flags']]==$db_translation['expansion_cata'])
								$cont2.= 'Cataclysm ';
							else
								$cont2.= '';
								$cont2.='<br />
							Your account is '; if ($a_user[$db_translation['banned']]=='0' or $a_user[$db_translation['banned']]=='') { 
							$cont2.= "<span class='colorgood'><strong>not banned.</strong></color>";} else {$cont2.= "<font class='colorbad'><strong>banned.</strong></font>";};
							$cont2.='

		</div>

	</div>

	

	<div class="account-menu clearfix">

		<div id="left" class="text-shadow">

			<font color="#6f5933">'. $a_user['vp'].'</font> Vote Points &nbsp;&nbsp; & &nbsp;&nbsp; <font color="#6f5933">'. $a_user['dp'].'</font> Donate Points

		</div>

		<div id="right" class="text-shadow">

			<a href="quest.php?name=votesites">VOTE NOW</a>

			<a href="quest_ac.php?name=Donate_with_PayPal">DONATE</a>

		</div>

	</div>

				<div class="account-buttons-container clearfix">

		<div id="left-column" align="left">

				

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/icon_lock.png"></td>

						<td valign="top">

							<a href="./quest.php?name=passchange">Change Password</a>

							<div class="acc_b_de">Change your password here!</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/chars.png"></td>

						<td valign="top">

							<a href="./quest.php?name=char"> Character Unstucker </a>

							<div class="acc_b_de">Unstuck and check for character bans here.</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/movecharact.png"></td>

						<td valign="top">

							<a href="./quest.php?name=transfer"> Character Transfer </a>

							<div class="acc_b_de">Migrate your character to another account.</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/mount.png"></td>

						<td valign="top">

							<a href="./quest.php?name=Mount_Stable"> Mount Stable </a>

							<div class="acc_b_de">Visit the Stable and get a Mount</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/goblin.png"></td>

						<td valign="top">

							<a href="./quest.php?name=Goblin_workshop"> Goblin Workshop </a>

							<div class="acc_b_de">Time is Money friend!</div>

						</td>

					</tr>

				</table>

			</div>

		</div>

		

		<div id="right-column" align="left">

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/star.png"></td>

						<td valign="top">

							<a href="./quest_ac.php?name=Donate_with_PayPal"> Donate with PayPal </a>

							<div class="acc_b_de">Donate to us via UPS and to earn Donation Points!</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/modules.png"></td>

						<td valign="top">

							<a href="./quest_ac.php?name=Vote_Shop"> Vote Shop </a>

							<div class="acc_b_de">Exchange your vote points and get rewards!</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/star2.png"></td>

						<td valign="top">

							<a href="./quest_ac.php?name=Donation_Shop"> Donation Shop </a>

							<div class="acc_b_de">Buy your Character Level or Item!</div>

						</td>

					</tr>

				</table>

			</div>

			<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/sms.png"></td>

						<td valign="top">

							<a href="./quest.php?name=donate_sms"> Donate with SMS </a>

							<div class="acc_b_de">Donate to us via SMS and to earn Donation Points!!</div>

						</td>

					</tr>

				</table>
				
</div>

				<div class="acc-b-m">

				<table cellpadding="0" cellspacing="0">

					<tr>

						<td valign="top"><img border="0" src="./styles/default/images/movecharact.png"></td>

						<td valign="top">

							<a href="./quest.php?name=teleporter"> Character Teleporter  </a>

							<div class="acc_b_de">Teleport your characters to main cities.</div>

						</td>

					</tr>

				</table>

			

			</div>

		</div>

	</div>

</center></div>

</div>				</td>

</tr>

		</tbody></table>

	</div>
'; 
?>
                           
<?php
$box_wide->setVar("content_title", "Account Panel");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				