<?php
if (!defined('AXE'))
	exit;
//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

//if session set, then we shoudlnt be here
if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]<>$db_translation['gm_normalplayer'] && $a_user[$db_translation['gm']]<>'') 
{
	if ($a_user[$db_translation['gm']]==$db_translation['az']) 
	{		
		if (isset($_GET['id'])) 
		{
			$id = (int)$_GET['id'];
			$del = $WEB_PDO->prepare("DELETE FROM `shoutbox` WHERE `id` = :id LIMIT 1");
			$del->bindParam(':id', $id, PDO::PARAM_INT);
			$del->execute();
			unset($del);
		}
		if (isset($_GET['all'])) 
		{
			$WEB_PDO->query("DELETE FROM `shoutbox`");
		}

		$cont2.='<center>
 			<div>
				<a href="./quest_ad.php?name=Shoutbox_Manager&all">Prune all shouts</a>
			</div><br /><br />';
			
		$getshout2 = $WEB_PDO->query("SELECT date, user, message, id FROM shoutbox ORDER BY date DESC limit 20") or error('Something is wrong with the database. <br><br></strong>MySQL reported:<strong> '.print_r($getshout2->errorInfo()).'.<br><br></strong>', __FILE__, __LINE__); 
		
		while ($row = $getshout2->fetch(PDO::FETCH_ASSOC))
		{
			$cont2.=  '	
						<div class="sidebar_box" style="width: 500px !important; background: #03060b;">
							<div class="sidebar_box_cont" style="width: 490px !important;" align="left">
								Posted by <strong>'.$row['user'].'</strong>
								<div class="sb_m_date">'.$row['date'].' <a href="./quest_ad.php?name=Shoutbox_Manager&id='.$row['id'].'">[X]</a></div>
							</div>
							<div class="sidebar_box_cont" style="width: 490px !important;" align="left">
								<p style="color: #78787a !important; padding-top: 5px;">'.$row['message'].'</p>
							</div>
						</div>';
		}
		unset($getshout2);
		
		$cont2.="</center>";
			
		$cont2_title="Shoutbox Control Panel";		
		//
		$box_wide->setVar("content_title", $cont2_title);	
		$box_wide->setVar("content", $cont2);					
		print $box_wide->toString();
		//
	}
	else
	{
		$box_wide = new Template("styles/".$style."/box_wide.php");
		$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
		$cont2= "You are not logged in or you do not have access to this page.";
		$box_wide->setVar("content_title", "Alert!");	
   	 	$box_wide->setVar("content", $cont2);					
    	print $box_wide->toString();
	}	
}
else
{
	$box_wide = new Template("styles/".$style."/box_wide.php");
	$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
	$cont2= "You are not logged in or you do not have access to this page.";
	$box_wide->setVar("content_title", "Alert!");	
    $box_wide->setVar("content", $cont2);					
    print $box_wide->toString();
}
?>