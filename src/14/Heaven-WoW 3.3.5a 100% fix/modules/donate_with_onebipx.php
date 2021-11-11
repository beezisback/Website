<?php if (!defined('AXE')) exit; 

require("config_onebip.php"); 

if ($a_user['is_guest'])
{  
	$box_wide = new Template("styles/".$style."/box_wide.php");
	$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
	$cont2= "You will be granted access to donate form only if you login, thank you.";
	$box_wide->setVar("content_title", "Alert!");	
    $box_wide->setVar("content", $cont2);					
    print $box_wide->toString();
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

if (!$a_user['is_guest'])
{ 
	$day = date('d');
	$timethen = date('Y-m-d', strtotime('-'.$day.' day +1 day'));
	$timewhen = date('Y-m-d', strtotime('+1 month -'.$day.' day '));

	$savingsgoal = "250";
	$timethen = strtotime($timethen);
	$amount = "0";
	
	$res = $WEB_PDO->prepare("SELECT * FROM `paypal_data` ORDER BY whendon DESC");
	$res->execute();
	
	while ($q = $res->fetch(PDO::FETCH_ASSOC))
	{
		if ($q['whendon']>=$timethen)
		{
			$amount= $amount + $q['amount'];
		}
	}
	unset($res);
		
	$savingspct  = round(($amount / $savingsgoal)*100);
		
	if ($amount>=$savingsgoal)
	{
		$savingspct="100";
	}
	
	//get first product info
	foreach ($onebip_config['products'] as $key => $data)
	{
		$firstItemNumber = $key;
		$firstPrice = $data['price'];
		$firstDescr = $data['descr'];
		break;
	}
	
	$cont2.='<center>
      <div class="sub-box1" align="left">
	  <center><b>DONATION GOAL</b></center>
	      <div class="prog-border" ><center>'.$amount.'€ / '.$savingsgoal.'€</center>
   <div class="progress" style="width:'.$savingspct.'%;" align="center">
    
   </div>
 </div><br />
	  <center>	  
	  	<form action="https://www.onebip.com/otms/" method="post" target="onebip">';
			
			//output a select form
			$cont2.='<select name="product" onchange="onebipSwitch(this)">';
			
			foreach ($onebip_config['products'] as $key => $data)
			{
				$cont2.='<option value="'.$key.'" price="'.$data['price'].'" descr="'.$data['descr'].'" '.($key == $firstItemNumber ? 'selected="selected"' : '').'>'.$data['points'].' points for '.($data['price']/100).$onebip_config['currencySymbol'].'</option>';
			}
			
			$cont2.='</select><br><br>';
			
			$cont2.='
			<input type="hidden" name="command" value="standard_pay" /> 
			<input type="hidden" name="username" value="'.$onebip_config['account'].'" /> 
			<input type="hidden" id="onebip-input-descr" name="description" value="'.$firstDescr.'" />			
			<input type="hidden" id="onebip-input-item" name="item_code" value="'.$firstItemNumber.'" /> 
			<input type="hidden" id="onebip-input-price" name="price" value="'.$firstPrice.'" /> 
			<input type="hidden" name="currency" value="'.$onebip_config['currency'].'" /> 
			<input type="hidden" name="country" value="'.$onebip_config['country'].'" /> 
			<input type="hidden" name="lang" value="en" />'.
			
			(($onebip_config['notifyURL']) ? '<input type="hidden" name="notify_ur" value="'.$onebip_config['notifyURL'].'" />' : '').
			
			(($onebip_config['thankyouURL']) ? '<input type="hidden" name="return_url" value="'.$onebip_config['thankyouURL'].'" />' : '').
			
			(($onebip_config['cancelURL']) ? '<input type="hidden" name="cancel_url" value="'.$onebip_config['cancelURL'].'" />' : '').
			
			'<input type="hidden" name="custom[account]" value="'.$a_user[$db_translation['login']].'" /> 
			<input type="hidden" name="logo_url" value="http://lunohost.com/image/logo.png" />'.
			($onebip_config['debug'] ? '<input type="hidden" name="debug" value="true" />' : '').
			'<input type="image" name="submit" src="'.$onebip_config['btn'].'" alt="Pay with Onebip" border="0" /> 
		</form>
	 </center>'; 
	  
	  
	$box_wide->setVar("content_title", "Donate via SMS (Onebip)!");  
	$box_wide->setVar("content", $cont2);      
	print $box_wide->toString();
}
else
{
	print "You are not logged in.";
	$tpl_footer = new Template("styles/".$style."/footer.php");  
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}  
?>