<?php 
/************************************************************************************** 
* Shop mod by AXE, this one is secure and is not hackable trough POST data modifying. * 
* Created: 8 April 2009, this mod uses 'shop' table.   
*
* Last mod by ChoMPi, AXE lied...     
* **************************************************************************************/ 

//let's shorten the code abit
function printFooter($exit = true)
{
	global $style;
	
	$tpl_footer = new Template("styles/".$style."/footer.php");  
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  
	print $tpl_footer->toString();  
	
	if ($exit)
	{
		exit;
	}
}

if (!defined('AXE'))  exit;
 
isLoggedInOrReturn();

/*common include*/
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php"); 
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
/*end common include*/ 
 
patch_include("sendmail",false);
  
if (isset($_POST['realm']))
{
 	$_SESSION['realm'] = (int)$_POST['id'];
}

//Some mod for fast access
if (isset($_GET['fastAccess']))
{
	foreach ($realm as $id => $data)
	{
		$_SESSION['realm'] = $id;
		break;
	}
}

if (!isset($_SESSION['realm'])) 
{
	$cont2.="<center><div class='new_vote_searchdiv' align='center'>Choose a realm:<table cellspan='0' rowspan='0'>";
						 
	foreach ($realm as $id => $data)
	{
		$cont2.="<td><form method='POST' action='./quest_ac.php?name=Vote_Shop'><input type='hidden' value='".$id."' name='id'><div id='log-b2'><input type='submit' value='".$data['name']."' name='realm' /></div></form></td>";
	}
		
	$cont2.="</table></div>";
	$box_wide->setVar("content_title", "Vote shop");	
	$box_wide->setVar("content", $cont2);					
	print $box_wide->toString();
	printFooter();
}
 
/*now reduce points*/ 
/*delete shop item, for admins*/ 
if (isset($_GET['delid']) && $a_user[$db_translation['gm']]==$db_translation['az']) 
{  
 	$points = (int)$_GET['points'];
	$delid = (int)$_GET['delid']; 
	
 	if (isset($_GET['confirm']))
 	{
		$del = $WEB_PDO->prepare("DELETE FROM `shop` WHERE `id` = :id LIMIT 1");
		$del->bindParam(':id', $delid, PDO::PARAM_INT);
		$del->execute();
		unset($del);
		
 		box("Delete Item","Item deleted!<br><br><a href='./quest_ac.php?name=Vote_Shop'>Go to Shop</a>");  
 		printFooter();
	} 
 	else  
 	{
		box("Delete Item","<center>Are you sure you want delete this item?<br><br><a href='quest_ac.php?name=Vote_Shop&delid=".$delid."&confirm=YES'>YES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='./quest_ac.php?name=Vote_Shop'>NO</a></center>");
 		printFooter();
	}
} 

/*send item to character*/
if (isset($_POST['action']))
{
	/*we get char id*/
	if ($_POST['character']=='none')
 	{
		box('Fail','You don\'t have any characters. Mail can\'t be sent.'); 
 		printFooter();
	}
	
 	$pieces = explode("-", $_POST['character']);
	$char = (int)$pieces[0]; /*char guid*/
	$realm_data123 = (int)$pieces[1]; /*realm*/  
	   
 	if ($_POST['itemsgrup']=='')  
 	{
		box('Fail','No item selected.');  
 		printFooter();
	} 
	 
 	$itemsgrup = (int)$_POST['itemsgrup']; /*this is shop ID*/ 
	
	$res = $WEB_PDO->prepare("SELECT * FROM `shop` WHERE `id` = :itemsgrp AND donateorvote='0' LIMIT 1");
	$res->bindParam(':itemsgrp', $itemsgrup, PDO::PARAM_INT);
	$res->execute();
	
	if ($res->rowCount() == 0)
	{
		box('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.webwow.totalh.com" target="_blank">Bish</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$a_user[$db_translation['login']].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? Stupid humans...');
		printFooter();
	}
	
	$checkshopid2 = $res->fetch(PDO::FETCH_ASSOC);
	unset($res);
	
	$cost = $checkshopid2['cost'];
	$itemid = $checkshopid2['itemid'];
	$item_stack = $checkshopid2['charges'];
	
	if ($checkshopid2['realm'] != $_SESSION['realm'] && $checkshopid2['realm'] != "0")
	{
		box('Fail','This item is not available on that realm.');
		printFooter();
	}
	
	/*reduce points*/
	if ($a_user['vp']>=$cost)
	{
		//do axe
	}
	else
	{
		box('Fail','You don\'t have enough points to buy that item.<br>You have '.$a_user['vp'].' points and item costs '.$cost.' points.');
		printFooter();
	}
	
	/*check if realm db is availavable and select db*/
	if (isset($realm[$realm_data123]))
	{
		$REALM_DB = newRealmPDO($realm_data123);
		
		/*now we check if this is truly char witch belongs to your account*/
		$res = $REALM_DB->prepare("SELECT ".$db_translation['characters_name'].",".$db_translation['characters_guid']." FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_guid']."` = :char AND `".$db_translation['characters_acct']."` = :acc LIMIT 1");
		$res->bindParam(':char', $char, PDO::PARAM_INT);
		$res->bindParam(':acc', $a_user[$db_translation['acct']], PDO::PARAM_INT);
		$res->execute();
				
		if ($res->rowCount() == 0)
		{
			box('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.web-wow.net" target="_blank">Bish</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$db_translation['login'].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? You CAN\'T SEND ITEMS TO CHARACTERS THAT AREN\'T ON YOUR ACCOUNT. Stupid humans...');
			printFooter();
		}
	
		$charname = $res->fetch(PDO::FETCH_NUM);
		unset($res);
		
		/*add mail here*/
		$time = date("m-d-Y, h:i");
		$refnum = date("jnGis");
		$subject = 'WebsiteVoteShopREF'.$refnum.'';
		/*do not remove $refnum*/
		$body = 'Enjoy your new reward! Item costed '.$cost.' points. [Time sent: '.$time.'] [Item ID:'.$itemid.']';

		if ($item_stack != '0' and $item_stack != '1' and $item_stack != '')
		{
			$item_stack1 = $item_stack;
		}
		else
		{
			$item_stack1 = false;
		}
		
		/*refrence-> sendmail($playername,$playerguid, $subject, $text, $item, $shopid, $money=0,$realmid=false) //returns*/
		$sendingmail = sendmail($charname[0], $charname[1], $subject, $body, $itemid, $itemsgrup, '0', $realm_data123, $item_stack1);
		
		/*SQL*/
		if (substr($sendingmail, 0, 16)=="<!-- success -->")
		{
			$newpoints = $a_user['vp'] - $cost;
			
			$update = $WEB_PDO->prepare("UPDATE `accounts_more` SET `vp` = '".$newpoints."' WHERE `acc_login` = :acc");
			$update->bindParam(':acc', $a_user[$db_translation['login']], PDO::PARAM_INT);
			$update->execute();
						
			$sendingmail.="<br>Points are taken.";
			unset($update);

	$ins = $WEB_PDO->prepare("INSERT INTO `vote_log` (user,cost, date,account,itemid) VALUES (:char,'$cost', '$time', :acc,'$itemid')");
			$ins->bindParam(':acc', $a_user[$db_translation['login']], PDO::PARAM_INT);
            $ins->bindParam(':char', $char, PDO::PARAM_INT);
			$ins->execute();
			unset($ins);
		}

		

	
		/*end SQL*/
		box('Report', $sendingmail);
		printFooter();
	}
	else
	{
		box('Fail','Realm '.$realm_data123.' does not exist!');
		printFooter();
	}
}  
  
$box_simple_wide->setVar("content", $cont1); 
print $box_simple_wide->toString();

/**/ /* Something is bought (post data submitted)*/ /**/  
if ($a_user[$db_translation['gm']]==$db_translation['az']) 
{ 
 	if ($_POST['additem']) 
 	{
		if ($_POST['sep']=='0') /*is item*/  
 		{
			if ($_POST['itemid']=='')   
 			{
				box ('Fail','Make sure you type in item id.');  
 				printFooter();
			}  
 			else if ($_POST['name']=='')  
 			{
				box ('Fail','Make sure you type in item name.');  
 				printFooter();
			} 
 			else if ($_POST['description']=='')   
 			{
				box('Failure','Make sure you typed in an item description.');  
 				printFooter();
			} 
 			else if ($_POST['points']=='')    
 			{
				box ('Fail','Make sure you type in item point cost.'); 
 				printFooter();
			} 
 			else if ($_POST['charges']=='')    
 			{
				box ('Fail','Make sure you type in charges.');  
 				printFooter();
			}
 			else if ($_POST['cat']=='')    
 			{
				box('Fail','Make sure you type in category number for sorting items.'); 
 				printFooter();
			}
 			else if ($_POST['sort']=='')    
 			{
				box('Fail','Make sure you type in sort items within same category.');  
 				printFooter();
			}
			else /*pass*/   
 			{
				$insert = $WEB_PDO->prepare("INSERT INTO `shop` (sep, name, itemid, color, cat, sort, cost, charges, donateorvote, description, custom, realm) VALUES ('0', :name, :iid, :color, :cat, :sort, :points, :charges,'0', :descr, :custom, :realm)");
				$insert->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
				$insert->bindParam(':iid', $_POST['itemid'], PDO::PARAM_INT);
				$insert->bindParam(':color', $_POST['color'], PDO::PARAM_STR);
				$insert->bindParam(':cat', $_POST['cat'], PDO::PARAM_STR);
				$insert->bindParam(':sort', $_POST['sort'], PDO::PARAM_STR);
				$insert->bindParam(':points', $_POST['points'], PDO::PARAM_INT);
				$insert->bindParam(':charges', $_POST['charges'], PDO::PARAM_INT);
				$insert->bindParam(':descr', $_POST['description'], PDO::PARAM_STR);
				$insert->bindParam(':custom', $_POST['custom'], PDO::PARAM_INT);
				$insert->bindParam(':realm', $_POST['realm1'], PDO::PARAM_INT);
				

				if ($insert->execute())
				{
					box('Success','Item is added!');
					printFooter();
				}
				else
				{
					box('Fail','Failed adding item!');
					printFooter();
				}
   
			}   
		}
		else /*is seperator*/   
		{    
			if ($_POST['name']=='')
			{
				box('Fail','Make sure you type in item name.');     
				printFooter();  
			}    
			else if ($_POST['cat']=='')
			{
				box ('Fail','Make sure you type in category number for sorting items.');     
				printFooter();  
			}
			else if ($_POST['sort']=='')
			{
				box ('Fail','Make sure you type in sort items within same category.');     
				printFooter(); 
			}
			else /*pass*/
			{
				$insert = $WEB_PDO->prepare("INSERT INTO shop (sep, name, cat, sort, donateorvote, itemid) VALUES ('1', :name, :cat, :sort, '0', '0')");
				$insert->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
				$insert->bindParam(':cat', $_POST['cat'], PDO::PARAM_STR);
				$insert->bindParam(':sort', $_POST['sort'], PDO::PARAM_STR);
				
				if ($insert->execute())
				{
					box('Success','Separator is added!');
					printFooter();
				}
				else
				{
					box('Fail','Failed adding separator!');
					printFooter();
				}
			}   
		}  
	}              
}

/**/ /* Display shop:*/ /**/ 
$cont2='<center><div class="voteshop1">';
 
$cont2.="<table cellspan='0' rowspan='0' style='margin-top: -20px; margin-bottom: 20px;'>";
						 
foreach ($realm as $id => $data)
{
	if ($id == $_SESSION['realm'])
	{
		$cont2.="<td><div id='log-b22'><input type='submit' value='".$data['name']."' name='realm' disabled='disabled'></td>";
	} 
	else
	{
		$cont2.="<td><form method='POST' action='./quest_ac.php?name=Vote_Shop'><input type='hidden' value='".$id."' name='id'><div id='log-b2'><input type='submit' value='".$data['name']."' name='realm' /></div></form></td>";
	}
}
	
$cont2.="</table>";
$cont2.='
<div align="left">
	<div class="small_box_1"> 
		You have '. $a_user['vp'].' Vote Points.
	</div>
</div>
<br/>
<form method="post" action="">
	<table border="0" width="700" align="center" cellpadding="0" cellspacing="0" class="ShopTable">    
		<tr>    
 			<td>Item Name</td>  
			<td>Charges</td>       
			<td>Description</td>     
 			<td>Cost</td>  
 			<td>Buy?</td>   
 		</tr>'; 

$res = $WEB_PDO->prepare("SELECT * FROM `shop` WHERE `donateorvote` = '0' AND `realm` = :realm OR `donateorvote` = '0' AND `realm` = '0' ORDER BY cat, sort ASC");       
$res->bindParam(':realm', $_SESSION['realm'], PDO::PARAM_INT);
$res->execute();

while ($items = $res->fetch(PDO::FETCH_ASSOC))      
{              
	/*its seperator*/    
 	if ($items['sep']=='1')       
 	{           
		$cont2.= "<tr><td colspan='5'>";    
 		if ($a_user[$db_translation['gm']]==$db_translation['az'])     
 		{
			$cont2.= '<a href="./quest.php?name=Vote_Shop&points=1&delid='.$items['id'].'">[x]</a> ';    
 		}
		$cont2.= "<strong><u>".$items['name']."</u></strong></td></tr>";       
 	}
	else /*its item*/
	{     
 		$cont2.= '<tr onmouseover="this.style.backgroundImage = \'url(./res/images/transp-green.png)\';" onmouseout="this.style.backgroundImage = \'none\'; ">';    
 		$cont2.= "<td>"; 
		          
		if ($a_user[$db_translation['gm']]==$db_translation['az'])       
 		{            
			$cont2.= '<a href="./quest_ac.php?name=Vote_Shop&delid='.$items['id'].'">[x]</a>  ';       
 		}
		
		if ($items['custom']=='1')        
 		{
			/*color codes here*/         
 			$cil = array (         
 				'0'=>'gray',    
 				'1'=>'white',  
 				'2'=>'#25FF16',  
 				'3'=>'#0070AC',   
 				'4'=>'#A335EE',  
 				'5'=>'#FF8000',   
 			); 
				     
 			$cont2.= '<span style="color:'.$cil[$items['color']].'" onmouseover="$WowheadPower.showTooltip(event, \'<font color='.$cil[$items['color']].'>'.$items['name'].'</font><br><small>This is a vote token.</small>\')" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();">['.$items['name'].']</span></td>';
		}
		else
		{
			$cont2.= "<a class='q".$items['color']."' href='http://www.wowhead.com/?item=".$items['itemid']."'>[".$items['name']."]</a></td>";
		}
		
		if ($items['charges']=='0' || $items['charges']=='1')
		{
			$charges='x1';
		}
		else
		{
			$charges='x'.$items['charges'];
		}
		
		$cont2.= "<td>".$charges."</td>"; 
		$real_descr = explode("[|]",$items['description']);
		$cont2.= "<td>".$real_descr[0]."</td>";
		$cont2.= "<td>".$items['cost']."</td>";
		$cont2.= '<td><input type="radio" name="itemsgrup" value="'.$items['id'].'" />';
        $cont2.='</td> </tr>';          
	}          
}
//check if we have no items
if ($res->rowCount() == 0)
{
	$cont2.= '<tr><td colspan="5"><center><h2>There are no items.</h2></center></td></tr>';
}
unset($res);
	
$cont2.='
	</table><br/>
	<div class="new_vote_searchdiv" align="center">
		Select Your Chracter: 
		<select name="character">'; 
                
/*#########################################CHAR START*/         
$i=0;        
$j = (int)$_SESSION['realm'];       

$REALM_DB = newRealmPDO($j);

if ($REALM_DB)
{
	$res = $REALM_DB->prepare("SELECT ".$db_translation['characters_guid'].", ".$db_translation['characters_acct'].", ".$db_translation['characters_name'].", ".$db_translation['characters_level']." FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_acct']."` = :acc");
	$res->bindParam(':acc', $a_user[$db_translation['acct']], PDO::PARAM_INT);
	$res->execute();
	
	while ($char = $res->fetch(PDO::FETCH_ASSOC))      
	{       
 		$cont2.= "<option value='".$char[$db_translation['characters_guid']]."-".$j."'>".$realm[$j]['name']." - ".$char[$db_translation['characters_name']]." level ".$char[$db_translation['characters_level']]." </option>";   
 		$i++;          
	}
	unset($res);
	
	$j++;
	if ($i=='0')
	{
		$cont2.=  "<option value='none'>You do not have any characters</option>";
	}  
}
else
{
	error('Unable to select realm database. Probabley you misspelled database name');
}
unset($REALM_DB);

$cont2.=  "</select> ";
      
/*#########################################CHAR END*/ 
$cont2.= '
		<div id="log-b3">
			<input name="action" type="submit" value="Purchase" />
		</div>
		<br />
		<br /> 
		Upon purchasing the website might take more than 10 seconds to load.<br> 
		Please make sure that you have carefully read all relevant documentation and tried out the website services. All our sales are final and no refunds will be given. As all of our Customized Items in game are nontangible, delivered instantly and received it is impossible for you to return a Customized Item to use for a refund.
	</div>
</form>
</div>
</center>';       
$box_wide->setVar("content_title", "Vote Shop");  
$box_wide->setVar("content", $cont2);      
print $box_wide->toString();
	
	if ($a_user[$db_translation['gm']]==$db_translation['az'])       
  	{       
  		$cont2= '
		<center>      
			<div class="sub-box1" align="left">                  
   				<form action="" method="post" id="manage">      
    				<table  border="0" align="center" cellpadding="3">
						<tr>       
	 						<td>Item?:<br /></td>       
	 						<td>
								<select name="sep">         
	 								<option value="0" selected="selected">Item</option>         
	 								<option value="1">Seperator *</option>                 
	 							</select>
							</td>    
	 					</tr>        
	 					<tr>          
	 						<td>Custom item? </td>         
	  						<td>
								<select name="custom">         
	  								<option value="0" selected="selected">No</option>         
	  								<option value="1">Yes</option>        
	  							</select>
							</td>
						</tr>       
	  					<tr>          
	  						<td>Available on: </td>          
	  						<td> 
								<select name="realm1"> ';
	  
	  							foreach($realm as $id => $data)
	  							{         
	  								$cont2.='<div id="fix66"><option value="'.$id.'" > '.$data['name'].'</option>'; 
	  								$cont2.='</div>';          
	  							}
		
	  							$cont2.='<option value="0" > All realms</option>
								</select>';
	  							$cont2.='
							</td>
						</tr>
						<tr>       
	  						<td>Item ID:</td>       
	  						<td>
								<input name="itemid" type="text" /> 
	  							<a href=\'#\' onClick=\'window.open("./pop-itemlookup.php","item","width=450,height=400,screenX=50,left=250,screenY=50,top=200,scrollbars=yes,status=no,menubar=no");return false\'><strong>[Search for item ID]</strong></a>
							</td>        
	  					</tr>
						<tr>       
	  						<td>Item name:</td>       
	  						<td>
								<input name="name" type="text" /> *
							</td> 
	  					</tr>     
	  					<tr>       
	  						<td>Item color:</td>       
	  						<td>
								<select name="color">         
	  								<option value="0">Poor (gray)</option>         
	  								<option value="1" selected="selected">Common (white)</option>         
	  								<option value="2">Uncommon (green)</option>         
	  								<option value="3">Rare (blue)</option>         
	  								<option value="4">Epic (purple)</option>         
	  								<option value="5">Legendary (orange)</option>        
	  							</select>
	  						</td>        
	  					</tr>         
	  					<tr>       
	  						<td>Description:</td>       
	  						<td>
								<input name="description" type="text" />
							</td>        
	  					</tr>        
	  					<tr>       
	  						<td>Cost Points:</td>       
	  						<td><input name="points" type="text" value="1" /></td>        
	  					</tr>        
	  					<tr>       
	  						<td>Item Stack:</td>       
	  						<td><input name="charges" type="text" value="1" /><br />Default is 1 for one item.</td>        
	  					</tr>        
	  					<tr>       
	  						<td>Cat Sort:</td>       
	  						<td><input name="cat" type="text" value="0" />        
	  						*  &laquo;<strong>X</strong>-x&raquo;</td>        
	  					</tr>        
	  					<tr>       
	 						<td>Sort within Cat:</td>       
	  						<td><input name="sort" type="text" value="0" />       
	  						*	 &laquo;x-<strong>X</strong>&raquo;
							</td>        
	  					</tr>
					</table>      
	  				<center>
						<br />
	  					If you select "Seperator" then only fields marked with an"*" are required.
						<br /><br />      
	  					<div id="log-b2"><input name="additem" type="submit" value="Add Item" /></div>      
	  				</center>            
	  			</form>
			</div>
		</center>';
 
		$box_wide->setVar("content_title", "Admin tool to add an item:");  
		$box_wide->setVar("content", $cont2);      
		print $box_wide->toString();           
	}
	/*end admin*/ 