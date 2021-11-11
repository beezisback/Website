<?php
if (!defined('AXE'))
	exit;
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

//if session set, then we shoudlnt be here
if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]<>$db_translation['gm_normalplayer'] && $a_user[$db_translation['gm']]<>'') 
{
	$realmid = (int)$_GET['realm']; //only numbers

	if ($realmid == NULL or $realmid == '')
	{
		$realmid = 1;
	}
	
	$realmLinks = '<div style="margin-top: -20px;">Realms: ';
	
	foreach($realm as $id => $data)
	{
		$realmLinks.=  '&nbsp;&nbsp;&nbsp;<a href="./quest.php?name=admincp4&realm='.$id.'">'.$data['name'].'</a>&nbsp;&nbsp;&nbsp;';
		if ($realmid==$id)
		{
			$rname = $data['name'];
		}
	}
	
	$realmLinks.= '</div><br><br>';
	
	$REALM_DB = newRealmPDO($realmid);

	
	$cont2_title='  Ticket Manager for GM\'s (Server: '. $rname.')';

	if (isset($_POST['delete']))
	{
		$delete = (int)$_POST['delete'];
		$del = $REALM_DB->prepare("DELETE FROM `".$db_translation['gm_tickets']."` WHERE `".$db_translation['gm_tickets_guid']."` = :delete LIMIT 1");
		$del->bindParam(':delete', $delete, PDO::PARAM_INT);
		$del->execute() or die("Ticket deletion failed!<br>Ticket id: $delete<br>" . print_r($del->errorInfo()));
		unset($del);
		
		$cont2= "<meta http-equiv='refresh' content='1;url=./quest.php?name=admincp4&realm=".$realmid."'>";
		$cont2.= "Ticket deleted successfully! Please wait...";
	}
	else 
	{
		$res = $REALM_DB->query("SELECT * FROM `".$db_translation['gm_tickets']."` ORDER BY `".$db_translation['gm_tickets_guid']."` DESC");
		
		if ($res->rowCount() == 0)
		{
			$cont2.= "<center>No tickets for ".$rname." realm...</center>";
		}
		else 
		{
			 $cont2.='<div><table border="0" width="100%" align="center" cellpadding="2" cellspacing="0" id="Tickets-DataTable" class="dataTable-display">
			 			<thead>
						<tr>
							<th style="width: 50px;"><b>ID</b></th>
							<th style="width: 480px;"><b>Message</b></th>
							<th><b>By character</b></th>
							<th><b>Delete?</b></th>
						</tr>
						</thead>
						<tbody>';									
			
			while ($tickets = $res->fetch(PDO::FETCH_ASSOC))
			{
				$cont2.= '<tr>';
				$cont2.= '<td>'.$tickets[$db_translation['gm_tickets_guid']].'</td>';
				$cont2.= '<td><div style="margin-right: 10px;">'.$tickets[$db_translation['gm_tickets_message']].'</div></td>';
				
				
							
				$res2 = $REALM_DB->prepare("SELECT `".$db_translation['characters_name']."` FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_guid']."` = :guid LIMIT 1");
				$res2->bindParam(':guid', $tickets[$db_translation['gm_tickets_guid']], PDO::PARAM_INT);
				$res2->execute() or die(print_r($res2->errorInfo()));
				
				$a1 = $res2->fetch(PDO::FETCH_NUM);
				unset($res2);
									
				$cont2.= '<td>'.$a1[0]." (id ".$tickets[$db_translation['gm_tickets_guid']].') </td>';
				$cont2.= '<form action="./quest.php?name=admincp4&realm='.$realmid.'" method="post" name="deleteForm_'.$tickets[$db_translation['gm_tickets_guid']].'">';
				$cont2.= '<input type="hidden" name="delete" value="'.$tickets[$db_translation['gm_tickets_guid']].'">';
				$cont2.= '<td><a onclick="document.deleteForm_'.$tickets[$db_translation['gm_tickets_guid']].'.submit();">Delete</a></td>';
				$cont2.= '</form>';
				$cont2.= '</tr>';
			}
			unset($res);	
			$cont2.='</tbody></table></div><br />';
		} 
	}
	unset($REALM_DB);
	
	//
	$box_wide->setVar("content_title", $cont2_title);	
	$box_wide->setVar("content", $realmLinks . $cont2);					
	print $box_wide->toString();
	//
}
else
{
	print "You are not logged in or you don't have access to this page.";
}

?>