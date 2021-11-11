<?
$server = "localhost";
$dbuser = "ragezone";
$dbpass = "treibal21234566";
$dbname = "ragezone_auth";
$dbtable = "bgtop";
$db_conn = mysql_connect($server, $dbuser, $dbpass);
@mysql_select_db($dbname, $db_conn) or die(mysql_error());
$ip = $_SERVER["REMOTE_ADDR"];
$link = "http://bgtop.net/vote/1284874183";
$time = time();
$vtime = "86400";
$dtime = "345600";
function show() {
echo '<div id="popup2" style="background-image: url(images/glow.png); top: 154.5px; left: 161.5px; "><div style="background-image:url(images/popup_bg.jpg);width:608px;height:259px;margin-left:38px;margin-top:38px;"><div class="post bg2"><div class="postbody_full"><div class="contentpop" style="margin-left:0px;margin-right:0px;margin-top:-25px;"><h3 style="color:#3c2f00;font-size:18px"><b>Voting</b></h3><div style="color:#3c2f00;"> Please click vote in each row. <br> <strong>Some sites count for more vote points than others!</strong> For the first 3 days of every month, we will have <strong>MULTIPLED</strong> rewards, each vote counts 2x as much!</div></div></div></div><div class="forumbg forumbg-table" style="width: 550px; margin: 0px auto;"><div class="inner"><span class="corners-top"><span></span></span><table class="table1" cellspacing="1" id="players2v2"><thead><tr style="font-weight: normal;text-transform: uppercase;color: white;line-height: 1.3em;font-size: 1em;height:auto"><th>Site</th><th>Banner</th><th>Voted</th><th>Vote Points</th><th>QR Code</th><th>Vote</th></tr></thead><tbody><tr class="bg1"><td align="center">XtremeTop100</td><td align="center"><img src="images/xtremetop100.jpg" alt="cataclysm wow private server"></td><td align="center"> <span style="color: #cc0000">No</span></td><td align="center"> Login for Credit</td><td align="center" style="vertical-align:middle"> <img src="http://api.qrserver.com/v1/create-qr-code/?data=http%3A%2F%2Fwww.xtremetop100.com%2Fin.php%3Fsite%3D1132284254&size=75x75" alt="QR Code"></td><td align="center"><form action="vote2.php" method="POST" target="_blank"> <input type="hidden" name="sid" value="1"> <input type="submit" name="submit" value="Vote!"></form></td></tr></tbody></table> <span class="corners-bottom"><span></span></span></div></div><center><input type="button" name="close" value="Close" onclick="jQuery(&#39;#popup2&#39;).hide();jQuery(&#39;#blanket&#39;).hide();"></center></div></div>
';
}
?>
<?php
$queryString = strtolower($_SERVER['QUERY_STRING']);

if (strstr($queryString,"<") OR strstr($queryString,">") OR strstr($queryString,"(") OR strstr($queryString,")") OR
strstr($queryString,"..") OR
strstr($queryString,"%") OR
strstr($queryString,"*") OR
strstr($queryString,"+") OR
strstr($queryString,"!") OR
strstr($queryString,"@")) {
$loc = $_SERVER['PHP_SELF'];
$ip = $_SERVER['REMOTE_ADDR'];
$date = date ("d-m-Y @ h:i:s");
$lfh = "log.txt";
$log = fopen ( $lfh,"a+" );
fputs ($log, "Attack Date: $date | Attacker IP: $ip | QueryString: $loc?=$queryString\n");
fclose($log);
echo "Атаката е записана";
exit;
} ?>
		

