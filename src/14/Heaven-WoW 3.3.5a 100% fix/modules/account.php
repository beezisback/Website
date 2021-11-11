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
							$cont2='<div class="account_info_holder">
							<div class="acc-info-box">Hello,  <strong>'. $a_user[$db_translation['login']].'</strong>!<br /><br />
							Your account was last used on: <strong><font color="#CCC">'. $a_user[$db_translation['lastlogin']].'</font></strong><br />
							Your account was last used by IP: <strong><font color="#CCC">'. $a_user[$db_translation['lastip']].'</font></strong><br />
							Your current IP is: <strong><font color="#CCC">'. get_remote_address().'</font></strong><br />';
							if ($a_user[$db_translation['flags']]==$db_translation['expansion_tbc'])
								$cont2.= 'Your expansion is: <strong> The Burning Crusaide</strong>';
							elseif ($a_user[$db_translation['flags']]==$db_translation['expansion_wotlk'])
								$cont2.= 'Your expansion is: <strong> Wrath of the Lich King </strong>';
							elseif ($a_user[$db_translation['flags']]==$db_translation['expansion_cata'])
								$cont2.= 'Your expansion is: <strong> Cataclysm </strong>';
							else
								$cont2.= 'You do not have an expantion set.';
								$cont2.='<br />
							Your account is '; if ($a_user[$db_translation['banned']]=='0' or $a_user[$db_translation['banned']]=='') { 
							$cont2.= "<span class='colorgood'><strong>not banned.</strong></color>";} else {$cont2.= "<font class='colorbad'><strong>banned.</strong></font>";};
							$cont2.='</div> <br/><br /><br />
                                 
								<div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/icon_lock.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=passchange"> Change Password </a> <br/>
                                <div class="acc_b_de">Change your password here!</div>
                                </td>
                                </tr></table></div>
								

';
							  if (file_exists('./modules/expansion.php')) {
							  $cont2.='
							  
							    <div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/wowstatus.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=expansion"> Enable/Disable Expansions </a> <br/>
                                <div class="acc_b_de">This tool can change what expansion packs are enabled on your account.</div>
                                </td>
                                </tr></table></div>
								
';
							 
							  }
							  if (file_exists('./modules/teleporter.php')) {
							  $cont2.='
							 
                                <div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/movecharact.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=teleporter"> Character Teleporter </a> <br/>
                                <div class="acc_b_de">Teleport your characters to main cities.</div>
                                </td>
                                </tr></table></div>
								
';
							  }
							  if (file_exists('./modules/char.php')) {
							  $cont2.='
							  
							    <div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/chars.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=char"> Character Unstucker </a> <br/>
                                <div class="acc_b_de">Unstuck and check for character bans here.</div>
                                </td>
                                </tr></table></div>
								
';
							 
							  }
							  if (file_exists('./modules/transfer.php')) {
							  $cont2.='
							  
							    <div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/movecharact.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=transfer"> Character Transfer </a> <br/>
                                <div class="acc_b_de">Migrate your character to another account.</div>
                                </td>
                                </tr></table></div>
';
                              
							  }
							  $cont2.='';
							 	//INCLUDE PLUGINS FROM m_admincp DIR
							  	//********************************************
								$folder = "modules/m_account/";
								$handle = opendir($folder);
								# Making an array containing the files in the current directory:
								while ($file = readdir($handle))
								{
									$files[] = $file;
								}
								closedir($handle);
								
								#echo the files
								foreach ($files as $file) 
								{
									
									if (strstr($file, ".php"))
									{
									
										$file2=substr($file, 0,-4); //without .php
										$file3=str_replace('_',' ',$file2); //replace "_" with " "
										//description start
										$homepage = file_get_contents('modules/m_account/'.$file2.'.txt');
										$descr=explode("|",$homepage);
										if ($descr[0]=='') $descr[0]='modules.png';
										//description end
										$cont2.= '
								<div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/'.$descr[0].'"></td>
                                <td valign="top">
                                <a href="./quest_ac.php?name='.$file2.'"> '.$file3.' </a> <br/>
                                <div class="acc_b_de">'.$descr[1].'</div>
                                </td>
                                </tr></table></div>
								
								';
									} 
								}
								
							if (file_exists('./modules/donate_sms.php'))
							{
							  	$cont2.='
							    <div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/sms.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=donate_sms"> Donate via SMS! (Paygol) </a> <br/>
                                <div class="acc_b_de">Donate to us via SMS and earn Donation Points!</div>
                                </td>
                                </tr></table></div>';
							}
							if (file_exists('./modules/donate_with_onebip.php'))
							{
							  	$cont2.='
							    <div class="acc-b-m"><table cellpadding="0" cellspacing="0"><tr>
                                <td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/sms.png"></td>
                                <td valign="top">
                                <a href="./quest.php?name=donate_with_onebip"> Donate via SMS! (Onebip) </a> <br/>
                                <div class="acc_b_de">Donate to us via SMS and earn Donation Points!</div>
                                </td>
                                </tr></table></div>';
							}
							
							if (file_exists('./modules/exp_changer.php'))
							{
							  	$cont2.='
							    <div class="acc-b-m">
									<table cellpadding="0" cellspacing="0">
										<tr>
                                			<td valign="top"><img width="60" height="50" border="0" src="./styles/'.$style.'/images/wowstatus.png"></td>
                                			<td valign="top">
                                				<a href="./quest.php?name=exp_changer"> Expansion Changer </a> <br/>
                                				<div class="acc_b_de">Change your account gmae Expansion!</div>
                                			</td>
                                		</tr>
									</table>
								</div>';
							}
							  
							//********************************************
							$cont2.='</div>'; 
?>
                           
<?php
$box_wide->setVar("content_title", "Account Panel");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();							
?>				