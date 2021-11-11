<?php
if (!defined('AXE')) exit; 

require("config_paypal.php"); 

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

/*func to get loginname*/ 
function loginbyid($id)
{
	global $ACC_PDO, $db_translation;  
		
	$res = $ACC_PDO->prepare("SELECT ".$db_translation['login']." FROM `".$db_translation['accounts']."` WHERE `".$db_translation['acct']."` = :acc LIMIT 1");
	$res->bindParam(':acc', $id, PDO::PARAM_INT);
	$res->execute();
	
	if ($res->rowCount() == 0)
	{
		return 'ID: '.$id;
	}  
	else  
	{   
		$query_a = $res->fetch(PDO::FETCH_ASSOC); 
		unset($res);
		 
		return $query_a[$db_translation['login']];  
	} 
}  

$res = $WEB_PDO->query("SELECT sum(amount) AS sumamount FROM `paypal_data`");
$a2 = $res->fetch(PDO::FETCH_ASSOC); 
unset($res);

$cont2= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<strong>Total of all money donated:</strong> <span class="colorgood"><big>'.$a2['sumamount'].' '.$paypalcurrecy_symbol.'</big></span> <br>
				</td>
				<td>
					<a href="./quest_ad.php?name=Donation_Reports&limit=all">[Display all donations]</a><br><a href="./quest_ad.php?name=Donation_Reports&limit=1000">[Display last 1000 donations]</a><br><a href="./quest_ad.php?name=Donation_Reports&limit=100">[Display last 100 donations]</a>
				</td>
			</tr> 
		</table>  
		<br> 
		<table width="100%" border="0" cellspacing="0" cellpadding="3">   
			<tr>     
				<td width="30px"><center>No.</center></td>     
				<td>&nbsp;Info</td>  
				<td><center>Points</center></td>  
				<td><center>Money</center></td>   
			</tr>';

/*limit*/   
if ($_GET['limit']=='') 
	$limit=' LIMIT 100';   
elseif ($_GET['limit']<>'' && $_GET['limit']<>'all') 
	$limit=' LIMIT '.$_GET['limit'];   
elseif ($_GET['limit']=='all') 
	$limit='';     

$res = $WEB_PDO->query("SELECT * FROM `paypal_data` ORDER BY whendon DESC".$limit);	
if ($res->rowCount() == 0)  
{     
	$cont2.= '<tr><td colspan="4">There are no records!</td></tr>';
}  
else
{
	$i = 1;  
	while ($query = $res->fetch(PDO::FETCH_ASSOC))
	{
		$who_array= explode('[|]',$query['who']); 
		$brdcomment= str_replace('Successful transaction!','Successful transaction!<br />', $query['comment']);      
		$cont2.= '<tr>
				<td width="30px" rowspan="2"><center>'.$i.')<br></center></td>   
				<td><i>Account username:</i> <strong>'.loginbyid($query['login']).'</strong><br><i>PayPal e-mail address:</i> <strong>'.$who_array[1].'</strong></td>   
				<td><center>'.$who_array[0].' DP</center></td>   
				<td class="colorgood"><center>'.$query['amount'].' '.$paypalcurrecy_symbol.'</center></td>       
			</tr>    
			<tr>      
				<td colspan="4">
					<br><i><strong>Website Report ID:</strong></i> <small>'.$query['id'].'</small><br /><br /><i><strong>Transaction ID:</strong></i> '.$query['txnid'].'<br><br><i><strong>Date:</strong></i> '.date('l jS \of F Y h:i:s A',$query['whendon']).'<br /><br /><i><strong>Console Report:</strong></i> '.$brdcomment.'</br>
				</td>       
			</tr>    
			<tr>
				<td colspan="4"><hr></td>
			</tr>'; 
		$i++;    
	}
}
unset($res);

$cont2.='</table>'; 
$box_wide->setVar("content_title", "Donation Reports (Newest first)");  
$box_wide->setVar("content", $cont2);      
print $box_wide->toString(); 