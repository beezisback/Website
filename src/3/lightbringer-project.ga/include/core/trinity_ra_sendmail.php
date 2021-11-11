<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' type='text/javascript'></script>
<style>
#fanback {
display:none;
width:100%;
height:100%;
position:fixed;
top:0;
left:0;
z-index:99999;
}
#fan-exit {
width:100%;
height:100%;
}

.text {
    width: 100%;
    font-family: Beaufort;
    font-size: 24px;
    color: #f56464;
    text-align: center;
}

.buttons {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
    margin-top: 20px;
}


.buttons > .popup_button {
    width: 240px;
    height: 50px;
    display: block;
    overflow: hidden;
    border-radius: 4px;
    background: url(styles/default/images/button_orange_center.png) top center;
    background-size: auto 100%;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    border: none;
    cursor: pointer;
    transition: all .3s ease-in-out;
    margin-left: 10px;
    margin-right: 10px;
}

a {
    text-decoration: none;
    color: #fff;
}



.buttons > .popup_button > span {
    position: relative;
    z-index: 2;
    color: #250e01;
    font-family: Beaufort Bold;
    font-size: 22px;
    text-transform: uppercase;
    text-shadow: 0px 1px 1px rgba(255,193,113,0.5);
}

#JasperRoberts {
background: rgba(31, 17, 13, 0.93);
border: 1px solid rgba(56,52,49,0.3);
width:600px;
height:220px;
position:absolute;
top:58%;
left:53%;
margin:-220px 0 0 -375px;
border-radius: 4px;
margin: -220px 0 0 -375px;
}
#TheBlogWidgets {
float:right;
cursor:pointer;
background:url(styles/default/images/fanclose.png) repeat;
height:55px;
padding:20px;
position:relative;
padding-right:40px;
}

.close {
    position: absolute;
    top: 14px;
    right: 20px;
    font-size: 18px;
    color: #42302b;
    transition: all .3s ease-in-out;
    cursor: pointer;
}


.remove-borda {
height:2px;
width:376px;
margin:0 auto;
margin-top:16px;
position:relative;
margin-left:11px;
}
#linkit,#linkit a.visited,#linkit a,#linkit a:hover {
color:#80808B;
font-size:10px;
margin: 0 auto 5px auto;
float:center;
}

</style>
<?php
/***********************************************************
*	Sendmail function for TrinityCore
*	by AXE
*   this file is required for all cores
************************************************************/

/***********************************************************
* 		 GLOBAL FUNCTIONS (required for all cores)
************************************************************/
function sendmail($playername,$playerguid, $subject, $text, $item, $shopid=0,  $money=0, $realmid='1') //returns, IMPORTANT: do not remove <!-- success --> if success
{
	global $server,$ra_user,$ra_pass,$db,$a_user,$se_c,$realm;
	$playername = clean_string($playername);
    $subject = preg_replace( "/[^A-Za-z0-9]/", "", clean_string($subject)); //no whitespaces
	$item = preg_replace( "/[^0-9]/", "", $item); //item id
	$realmid = preg_replace( "/[^0-9]/", "", $realmid); //item id
	if ($item<>'') $item = " ".$item;
    $text = clean_string($text);
	$money= preg_replace( "/[^0-9]/", "", $money);
	
	$telnet = fsockopen($server, $realm[$realmid]['port_ra'], $error, $error_str, 3);
	if($telnet)
	{
        //fgets($telnet,1024); // Motd
		fputs($telnet, $ra_user."\n");
		
		sleep(3);
		
		//fgets($telnet,1024); // PASS
	    fputs($telnet, $ra_user."\n");
		fputs($telnet, $ra_pass."\n");
		
		
		sleep(3);
		
		$remote_login = fgets($telnet,1024);
		//if(strstr($remote_login, "Thanks for using the best Emulator <3."))
		//{
			if ($item<>'' && $item<>'0')//send item
			{
				//sendmail to RA console
				fputs($telnet, ".send items ".$playername." \"".$subject."\" \"".$text."\"".$item."\n");
				$easf=time();
				$mailtext="				
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Item is successfully sent!</div>
<div class='buttons'>
        <a class='popup_button' href='accounts.wow'><span>Account Panel</span></a>
		<meta http-equiv='refresh' content='3;url=account.wow?i=getitem'/>
    </div>
</div>
</div>";
				
			}
			elseif ($money>'0' && $money<>'')//send money
			{
				fputs($telnet, ".send money ".$playername." \"".$subject."\" \"".$text."\" ".$money."\n");
				$moneytext="A mail with gold was sent!";
			}
			else //send letter
			{
				fputs($telnet, ".send mail ".$playername." \"".$subject."\" \"".$text."\"\n");
				$moneytext="A mail without any items or gold was sent!";
			}
			$test1111 = fgets($telnet,1024);
			//$moneytext .= '<br>Console reported: "<i>'.$test1111.'</i>"';
			//check database if actuall item is there
			//WebsiteVoteShopREFXXXXXXX ->this is unique
			$check=$db->query("SELECT * FROM mail WHERE receiver = '".$playerguid."' AND subject ='".$subject."' LIMIT 1")or die(mysql_error());
			if(mysql_num_rows($check)=='0')
				$status="";
				
			return  "<!-- success --><span class=\"colorgood\">".$mailtext.$moneytext."<br></span><br>".$status;
		//}
		//else
			//return  "<span class=\"colorbad\">Remote Login Problem: ".$remote_login."</span><br>Used login: ".$ra_user;
		
		
		fclose($telnet);
	}
	else
		return  "<span class=\"colorbad\">The Trinity server is currently offline. This procedure can only succeed if the Trinity server is online.</span>";
}

/*************************************************************
* 		NON GLOBAL FUNCTIONS (not required for other cores)
**************************************************************/
function clean_string($string) //returns
{
    return str_replace(array("\n", "\""), "", $string);
}

function test_ra_connection() //used in htdocs/telnet-test.php, echoes
{
	global $server,$ra_user,$ra_pass,$realm;
	$telnet = fsockopen($server, $realm['1']['port_ra'], $error, $error_str, 3);
	
	
	if($telnet)
	{
		
		//fgets($telnet,1024); // Motd
		fputs($telnet, $ra_user."\n");
		
		sleep(3);
		
		//fgets($telnet,1024); // PASS
	
		fputs($telnet, $ra_pass."\n");

		sleep(3);
		
		$remote_login = fgets($telnet,1024);
		echo  "The console reported: <i>".$remote_login."</i><br>";
			
		fclose($telnet);
	}
	else
		echo  "<font color=\"red\">A Telnet connection issue occured: <i>".$error_str."</i></font><br>";
}
function sendmail_confirm($receiver,$subject,$realmid)//returns
{	
	global $db,$realm;
	
	$i=1;
	while ($i<=count($realm))
	{
		if ($realmid==$i)
		{
			$db->select_db($realm[$i]['db']);
		}
	
		$i++;
	}
	
	$check=$db->query("SELECT id FROM mail WHERE receiver = '".$receiver."' AND subject ='".$subject."' LIMIT 1")or die(mysql_error());
	if(mysql_num_rows($check)=='0')
	{
		return "Checking for mail in DB... <font color='red'>Error: Your mail was not found!</font>";//you can change this text
	}
	else
				return "
			
<div id='fanback'>
<div id='fan-exit'>
</div>
<div id='JasperRoberts'>
<div class='remove-borda'>
</div>
<br>
<div class='text'>Item is successfully sent!</div>
<div class='buttons'>
        <a class='popup_button' href='accounts.wow'><span>Account Panel</span></a>

    </div>
</div>
</div>";//do not change text or 'recheck' script will not work
}

?>
