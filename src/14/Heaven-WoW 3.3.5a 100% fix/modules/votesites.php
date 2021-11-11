<?php
if (!defined('AXE'))
	exit;
isLoggedInOrReturn();

//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include
//say hi to lazyness ^^

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
function check2($site, $url) 
{
  global $WEB_PDO, $a_user, $timenow, $s, $sitepath, $zzs, $style, $db_translation, $style;
  
	$res = $WEB_PDO->prepare("SELECT timevoted FROM `vote_data` WHERE `userid` = :user AND `siteid` = :site");
	$res->bindParam(':user', $a_user[$db_translation['acct']], PDO::PARAM_INT);
	$res->bindParam(':site', $site, PDO::PARAM_INT);
	$res->execute();
	
	$getvote3 = $res->fetch(PDO::FETCH_NUM);
	
  	if (!$getvote3[0])
	{
		$getvote3[0] = "0";
	}
  
  	$url2 = $url;
	if ($getvote3[0] >= $timenow)
	{
		return "<a href=\"javascript:alert('You have already voted for this site. You can only vote once per 12 hours.');\" ><img style='margin:2px' src='./styles/".$style."/images/".$site."_g.jpg' width='81px' alt='[Vote here]' title='IMG: styles/".$style."/images/".$site.".jpg'></a>";
	} 
	else 
	{
		if ($url=='')
		{
			$zzs = $zzs + 1;
		}
		else
		{
			return "<a href='./vote.php?vote=".$site."' target='_blank'><img style='margin:2px' src='./styles/".$style."/images/".$site.".jpg' width='81px' alt='[Vote here]' title='IMG: styles/".$style."/images/".$site.".jpg'></a>";
		}
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
$siteleft = count($voteurls) - $s;
		  
$cont2="<center>You gain one vote point per vote, and you can vote once per site every 12 hours.<br /> 
With these vote points you can gain some nice rewards from our vote shop! <br />
Also you'll contribute in making us number 1 on these various vote sites.<br /><br /><center>";

  	foreach ($voteurls as $idex => $url)
	{
    	$cont2.=check2($idex, $url);
		$cont2.="&nbsp;";
		if ($idex==5 || $idex==10 || $idex==15 || $idex==20 || $idex==25 || $idex==30){$cont2.="<br />";}
	}
	
	$cont2.='</center>';

$box_wide->setVar("content_title", "Vote Sites");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	