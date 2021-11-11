<?php
if (!defined('AXE')) exit;

$box_simple_short = new Template("styles/".$style."/box_simple_short.php");
$box_simple_short->setVar("imagepath", 'styles/'.$style.'/images/');

//select right db
$res = $ACC_PDO->prepare("SELECT ".$db_translation['login']." FROM `".$db_translation['accounts']."` ORDER BY ".$db_translation['acct']." DESC LIMIT 3");
$res->execute() or error('Something is wrong with the database. <br><br></strong>MySQL reported:<strong> '.$res->errorInfo(), __FILE__, __LINE__); 

if ($res->rowCount() == 0)
{
	$cont= 'none';
}
else
{	
	$cont= "<center><i>Latest players:</i> &middot; ";
	while ($the2 = $res->fetch(PDO::FETCH_ASSOC))
	{
		$cont.= $the2[$db_translation['login']]." &middot; ";	  
	}
	unset($res);
}

$res = $ACC_PDO->prepare("SELECT COUNT(".$db_translation['acct'].") AS brojj FROM `".$db_translation['accounts']."`");
$res->execute() or error('Something is wrong with the database. <br><br></strong>MySQL reported:<strong> '.$res->errorInfo(), __FILE__, __LINE__);

$theb2 = $res->fetch(PDO::FETCH_ASSOC);

unset($res);

$cont.= "<br><i>Total accounts:</i> ".$theb2['brojj'];

$REALM_DB = newRealmPDO(1);

if ($REALM_DB)
{
	$res = $REALM_DB->prepare("SELECT COUNT(".$db_translation['characters_guid'].") AS bro FROM `".$db_translation['characters']."`");
	$res->execute() or error('Something is wrong with the database. <br><br></strong>MySQL reported:<strong> '.$res->errorInfo(), __FILE__, __LINE__);
	
	$thec2 = $res->fetch(PDO::FETCH_ASSOC);

	$cont.="&nbsp;&nbsp;<i>Total characters:</i> ".$thec2['bro'].'</center>';
	unset($res);
}
unset($REALM_DB);

$box_simple_short->setVar("content", $cont);
//print $box_simple_short->toString();
$inc_latestplayers = $box_simple_short->toString();