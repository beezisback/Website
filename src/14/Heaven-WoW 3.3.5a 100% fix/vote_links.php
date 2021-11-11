<?php
if (!defined('AXE'))
	exit;
if (!$a_user['is_guest'])
{

$timenow = date("U");

$s=0;//number of already voted sites
$zzs=0;
function check($site) 
{
	global $WEB_PDO, $a_user, $timenow, $s, $sitepath, $db_translation;
	
	$res = $WEB_PDO->prepare("SELECT timevoted FROM `vote_data` WHERE `userid` = :user AND `siteid` = :site");
	$res->bindParam(':user', $a_user[$db_translation['acct']], PDO::PARAM_INT);
	$res->bindParam(':site', $site, PDO::PARAM_INT);
	$res->execute();
	
	$getvote3 = $res->fetch(PDO::FETCH_NUM);
	
	if (!$getvote3[0])
	{
		$getvote3[0] = "0";
	}
	if ($getvote3[0] >= $timenow)
	{
		$s++;
	}
	unset($res);
}

$s1=0;
$s2=0;
$s3=0;
$s4=0;

//AXE IS AN IDIOT LOL
foreach ($voteurls as $idex => $url)
{
	check($idex);
}

//voted sites <= 1
//is there any site left?
$siteleft=count($voteurls)-$s;
if ($siteleft<>'0') {
 $t = new Template("styles/".$style."/box_simple_short.php");
		  
$content='<center>
<table width="100%" border="0" cellpadding="0">
  <tr><td>';
  
  // read this baby
$content.='<div id="log-b2"><input type="button" value="Vote now" onclick="location.href =\'./quest.php?name=votesites\'" /></div>';
	
	$content.='</td><td width="400px" style=" text-align:right">
	You have not voted within the last 12 hours.<br/>Vote in order to gain vote points<br/> (You gain 1 point per vote.) </td>
  </tr>
</table>
</center>';
$t->setVar("content", $content);
$t->setVar("imagepath", 'styles/'.$style.'/images/');
$vote_links= $t->toString();

}

	?>

	
<?php
}//end if logged in
?>