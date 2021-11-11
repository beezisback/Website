<?php
if (!defined('AXE')) exit; 



/*common include*/ 
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php"); 
$box_wide = new Template("styles/".$style."/box_wide.php"); 
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/'); 
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/'); 
/*end common include*/ 

if ($a_user['is_guest'])
{
	print "You are not logged in."; 
	$tpl_footer = new Template("styles/".$style."/footer.php");  
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  
	print $tpl_footer->toString();  
	exit; 
} 

if ($a_user[$db_translation['gm']]<>$db_translation['az'])
{
	print "You don't have access to this page."; 
	$tpl_footer = new Template("styles/".$style."/footer.php");  
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  
	print $tpl_footer->toString();  
	exit; 
} 

/*common include*/ 
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php"); 
$box_wide = new Template("styles/".$style."/box_wide.php"); 
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/'); 
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/'); 
/*end common include*/  

if (!isset($_GET['details']))
{
	$res = $WEB_PDO->query("SELECT sum(id) AS sumamount FROM `onebip_data`");
	$a2 = $res->fetch(PDO::FETCH_ASSOC); 
	unset($res);

	$cont2= '<strong>VOTE and DONATION LOGS</big></span><br><br>
			<div><table width="100%" border="0" cellspacing="0" cellpadding="3" id="Onebip-DataTable" class="dataTable-display">   
			<thead>
				<tr>
					<th>Account</th>
					<th>Character</th>
					<th>Purchase</th>
					<th>Cost</th>
					<th>Log Type</th>
					<th style="width: 150px;">Date and Time</th>
				</tr>
			</thead>';
			
	/*limit*/   
	if ($_GET['limit']=='') 
		$limit=' LIMIT 100';   
	elseif ($_GET['limit']<>'' && $_GET['limit']<>'all') 
		$limit=' LIMIT '.$_GET['limit'];   
	elseif ($_GET['limit']=='all') 
		$limit='';     

	$cont2 .= '<tbody>';

	$res = $WEB_PDO->query("SELECT * FROM `vote_log` ORDER BY id DESC".$limit);	
	if ($res->rowCount() > 0) 
	 
	{     
		while ($query = $res->fetch(PDO::FETCH_ASSOC))
		{
			//find out if the transaction was successfull
			$pos = strpos($query['comment'], 'Successful transaction!');
			if ($pos === false)
			{
				$status = 'Failed';
			}
			else
			{
				$status = 'Successful';
			}

			$cont2.= '
				<tr class="gradeX">
					<td>'.$query['account'].'</td>
					<td>'.$query['user'].'</td>
	                <td><a href=\'#\' onClick=\'window.open("./pop-itemlookup.php","item","width=450,height=400,screenX=50,left=250,screenY=50,top=200,scrollbars=yes,status=no,menubar=no");return false\'><strong>['.$query['itemid'].']</strong></a></td>
					<td class="center">'.($query['cost']).' VP '.$query['currency'].'</td>
					<td class="center"><a href="quest_ad.php?name=Onebip_Reports&details='.$query['id'].'">Vote</a></td>
					<td>'.$query['date'].'</td>
				</tr>'; 
		}
	}
	unset($res);
	
	
	
    
	$donate = $WEB_PDO->query("SELECT * FROM `donation_log` ORDER BY id DESC".$limit);	
	if ($donate->rowCount() > 0) 
	 
	{     
		while ($query = $donate->fetch(PDO::FETCH_ASSOC))
		{
			//find out if the transaction was successfull
			$pos = strpos($query['comment'], 'Successful transaction!');
			if ($pos === false)
			{
				$status = 'Failed';
			}
			else
			{
				$status = 'Successful';
			}

			$cont2.= '
				<tr class="gradeX">
					<td>'.$query['account'].'</td>
					<td>'.$query['user'].'</td>
	                <td><a href=\'#\' onClick=\'window.open("./pop-itemlookup.php","item","width=450,height=400,screenX=50,left=250,screenY=50,top=200,scrollbars=yes,status=no,menubar=no");return false\'><strong>['.$query['itemid'].']</strong></a></td>
					<td class="center">'.($query['cost']).' DP '.$query['currency'].'</td>
					<td class="center"><a href="quest_ad.php?name=Onebip_Reports&details='.$query['id'].'">Donation</a></td>
					<td>'.$query['date'].'</td>
				</tr>'; 
		}
	}
	unset($donate);
	
	

	$cont2.='</tbody></table></div>';

	$box_wide->setVar("content_title", "Vote&Donation Log");  
	$box_wide->setVar("content", $cont2);      
	print $box_wide->toString(); 
}
else
{
	//transaction details
	$id = (int)$_GET['details'];
	
	$cont2= '<strong><a href="quest_ad.php?name=Onebip_Reports">Go Back</a></strong><br><br><br>
	<center><div class="sub-box1" align="left">';
	
	$res = $WEB_PDO->prepare("SELECT * FROM `onebip_data` WHERE `id` = :id LIMIT 1");	
	$res->bindParam(':id', $id, PDO::PARAM_INT);
	$res->execute();
	
	if ($res->rowCount() > 0)  
	{     
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$cont2 .= '<table border="0" cellpadding="3" cellspacing="3">';
		
		$cont2 .= '<tr><td style="text-align: right !important; width: 140px;">Payment id:</td><td align="left"><font color="#c4a44d">' . $row['payment_id'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Onebip user id:</td><td><font color="#c4a44d">' . $row['onebip_user'] . '</font><br><br></td></tr>';
		
		$cont2 .= '<tr><td style="text-align: right !important;">Transaction time:</td><td><font color="#c4a44d">' . $row['time'] . '</font><br><br></td></tr>';
		
		$cont2 .= '<tr><td style="text-align: right !important;">Purchased by:</td><td><font color="#c4a44d">' . $row['login'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Purchased item:</td><td><font color="#c4a44d">' . ((isset($onebip_config['products'][$row['item_code']])) ? $onebip_config['products'][$row['item_code']]['descr'] : 'Invalid product id.') . '</font><br><br></td></tr>';
		
		$cont2 .= '<tr><td style="text-align: right !important;">Transaction country:</td><td><font color="#c4a44d">' . $row['country'] . '</font><br><br></td></tr>';
		
		$cont2 .= '<tr><td style="text-align: right !important;">Original price:</td><td><font color="#c4a44d">' . $row['original_price'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Original currency:</td><td><font color="#c4a44d">' . $row['original_currency'] . '</font><br><br></td></tr>';
		
		$cont2 .= '<tr><td style="text-align: right !important;">Transaction price:</td><td><font color="#c4a44d">' . $row['price'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Transaction currency:</td><td><font color="#c4a44d">' . $row['currency'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Amount paid:</td><td><font color="#c4a44d">' . $row['amount'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Tax:</td><td><font color="#c4a44d">' . $row['tax'] . '</font></td></tr>';
		$cont2 .= '<tr><td style="text-align: right !important;">Commission:</td><td><font color="#c4a44d">' . $row['commission'] . '</font><br><br><br></td></tr>';
		
		$cont2 .= '<tr><td>Website Report:</td><td></td></tr>';
		$cont2 .= '<tr><td colspan="2"><font color="#c4a44d">' . $row['comment'] . '</font></td></tr>';
		
		$cont2 .= '</table>';
	}
	else
	{
		$cont2 .= '<center>Missing transaction record or invalid transaction id.</center>';
	}
	
	$cont2 .= '</div></center>';
	
	$box_wide->setVar("content_title", "Vote&Donate Logs");  
	$box_wide->setVar("content", $cont2);      
	print $box_wide->toString(); 
}