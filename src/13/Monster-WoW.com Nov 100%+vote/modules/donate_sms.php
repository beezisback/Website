<?php if (!defined('AXE'))  exit; require("config_paypal.php"); if ($a_user['is_guest'])  {  print "You will be granted access to donate form only if you login, thank you."; $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit; }  /*common include*/ $box_simple_wide = new Template("styles/".$style."/box_simple_wide.php"); $box_wide = new Template("styles/".$style."/box_wide.php"); $box_wide->setVar("imagepath", 'styles/'.$style.'/images/'); $box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/'); 
/*end common include*/ 
if (!$a_user['is_guest'])  { 

$day= date('d');
$timethen=date('Y-m-d', strtotime('-'.$day.' day +1 day'));
$timewhen=date('Y-m-d', strtotime('+1 month -'.$day.' day '));

$savingsgoal = "100";


$timethen=$timethen=strtotime($timethen);;
$amount="0";
	$query1=mysql_query("SELECT * FROM paypal_data ORDER BY whendon DESC") or die(mysql_error());
	while ($q=mysql_fetch_array($query1) ){
	if ($q['whendon']>=$timethen)
	{$amount= $amount + $q['amount'];}
	}
$savingspct  = round(($amount / $savingsgoal)*100);
if ($amount>=$savingsgoal) {$savingspct="100";}
$cont2.='<center><div class="voteshop1">
 <div class="account-navigation box-shadow-inset clearfix">
<div id="left">
<p id="title">Donate with SMS!</p>
</div>
<div id="right">
<a href="./quest.php?name=account">Back to Account</a>
</div>
</div>
	  
	  
	  <center><font color="#6f5933">'. $a_user['dp'].'</font> Donate Points
				</div><b>DONATION GOAL</b></center>
	      <div class="prog-border" ><center>'.$amount.'$ / '.$savingsgoal.'$</center>
   <div class="progress" style="width:'.$savingspct.'%;" align="center">
    
   </div>
 </div><br />
	  
	  
	  
	  
	  
	  
				
  

<!-- PayGol JavaScript -->
<script src="http://www.paygol.com/micropayment/js/paygol.js" type="text/javascript"></script>

<!-- PayGol Form -->
<form name="pg_frm">
 <input type="hidden" name="pg_custom" value="'. $a_user[$db_translation['login']].'"><p>
 <input type="hidden" name="pg_serviceid" value="4938">
 <input type="hidden" name="pg_currency" value="EUR">
 <input type="hidden" name="pg_name" value="Donate for Donation Points">

 <!-- With Option buttons -->
 <input type="radio" name="pg_price" value="1"checked>1 Donation Point €1<p>
 <input type="radio" name="pg_price" value="2">3 Donation Points €2.5<p>
 <input type="radio" name="pg_price" value="2">8 Donation Points €5<p>
 <input type="radio" name="pg_price" value="3">18 Donation Points €10<p>
 <input type="radio" name="pg_price" value="4">50 Donation Points €20<p>

 <input type="hidden" name="pg_return_url" value="./quest.php?name=sucess">
 <input type="hidden" name="pg_cancel_url" value="./quest.php?name=fail">

 
  <center><div id="log-b2"> <input type="image" name="pg_button" class="paygol" src="http://www.paygol.com/micropayment/img/buttons/150/donate_en_3.png" border="0" alt="Make payments with PayGol: the easiest way!" title="Make payments with PayGol: the easiest way!" onClick="pg_reDirect(this.form)"></div></center> </form>
 </div>
                              
 </div></center></div>
 '; 
	  
	  
$box_wide->setVar("content_title", "ACCOUNT PANEL");  
$box_wide->setVar("content", $cont2);      
print $box_wide->toString();   } else {  print "You are not logged in.";
$tpl_footer = new Template("styles/".$style."/footer.php");  
$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit; }  
?>