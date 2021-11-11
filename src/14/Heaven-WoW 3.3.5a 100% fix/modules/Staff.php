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

<div class="post2">
<div class="post_header2"><div>Heaven WoW Staff<p></p></div></div>
<div class="post_body2" align="left"><center><table cellpadding="2" cellspacing="2"> <tr> <td valign="top">
							</div> <div class="sub-box1" align="left">
		<strong><font color="#FF0000">Owner</font></strong> <br/>
     Closed<br/>

		</div>
<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#008000">Co-Owner</font></strong> <br/>
     Yexs<br/>

		</div>
<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#800080">Admin</font></strong> <br/>
    Blooster<br/>

		</div>
<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#FF006E">Head GM</font></strong> <br/>
     TINKERZ<br/>

		</div>
<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#00FF21">Developers</font></strong> <br/>
     <br/>

		</div>

<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#00FF21">Supervisor</font></strong> <br/>
     ASTERIX<br/>RAQUELLA<br/><br/>

		</div>
<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#00FFFF">Game Masters</font></strong> <br/>  PLATINUM<br/>
     <br/>

		</div>
<br/>
</div> <div class="sub-box1" align="left">
		<strong><font color="#FFD800">Trial Game Master</font></strong> <br/>
     MIKEY<br/> DEMINOX<br/>

		</div>
<br/>
</center>
								

</td></tr></table></center></div>
</div>				
</td>

</tr>
</tbody></table>
</div>
</div>
	
				