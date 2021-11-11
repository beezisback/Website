<?php
if (!defined('AXE')) exit;

require("config_paypal.php"); 

if ($a_user['is_guest'])
{
	print "You will be granted access to donate form only if you login, thank you.";
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

	$savingsgoal = "200";

	$timethen = $timethen=strtotime($timethen);;
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
	
	$cont2.='<center>
      <div class="sub-box1" align="left">
	  <center><b>DONATION GOAL</b></center>
	      <div class="prog-border" ><center>'.$amount.'€ / '.$savingsgoal.'€</center>
   <div class="progress" style="width:'.$savingspct.'%;" align="center">
    
   </div>
 </div><br />
	  
<!-- PayGol JavaScript -->
<script src="http://www.paygol.com/micropayment/js/paygol.js" type="text/javascript"></script>

<!-- PayGol Form -->
<form name="pg_frm">
 <input type="hidden" name="pg_custom" value="'. $a_user[$db_translation['login']].'"><p>
 <input type="hidden" name="pg_serviceid" value="10561">
 <input type="hidden" name="pg_currency" value="EUR">
 <input type="hidden" name="pg_name" value="Donate for Donation Points">
 <center>
 <!-- With Option buttons -->
 <p style="height: 18px; width: 250px; padding-top: 3px; padding-bottom: 5px; line-height: 20px; margin: 0;" onmouseover="this.style.background = \'#333\';" onmouseout="this.style.background = \'none\';" align="left">
 	<label style="vertical-align: top;">
		<input type="radio" name="pg_price" value="1" checked="checked" style="margin-right: 60px;">7 Donation Point €10
	</label>
 </p>
 <p style="height: 18px; width: 250px; padding-top: 3px; padding-bottom: 5px; line-height: 20px; margin: 0;" onmouseover="this.style.background = \'#333\';" onmouseout="this.style.background = \'none\';" align="left">
 	<label style="vertical-align: top;">
		<input type="radio" name="pg_price" value="2" style="margin-right: 60px;">11 Donation Points €16
	</label>
 </p>

 </center>
 <input type="hidden" name="pg_return_url" value="http://www.heavenwow.com/quest.php?name=sucess">
 <input type="hidden" name="pg_cancel_url" value="http://www.heavenwow.com/quest.php?name=fail">
 <input type="hidden" name="pg_notify_url" value="http://www.heavenwow.com/paygol.php">
 <br>
  <center><div id="log-b2"> <input type="image" name="pg_button" class="paygol" src="http://www.paygol.com/micropayment/img/buttons/150/donate_en_3.png" border="0" alt="Make payments with PayGol: the easiest way!" title="Make payments with PayGol: the easiest way!" onClick="pg_reDirect(this.form)"></div></center> </form>
<br><center><strong>All our sales are final and no refunds will be given.
 </div>
 <div class="paygol_transactions sub-box1">
	<iframe src="http://www.paygol.com/plugins/view_transactions?key=72303916-3059-102f-92c5-bd2068a8156d&language=en" width="400" height="250" frameborder="0" scrolling="no"></iframe>
</div>                        
 </div></center></div> '; 
	  
	  
	$box_wide->setVar("content_title", "Donate with SMS!");  
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