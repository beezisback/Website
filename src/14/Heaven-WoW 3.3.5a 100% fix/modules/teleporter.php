<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{
	print "You are not logged in."; $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include



if(isset($_POST['submit']))
{
	$guid1 = explode ('-', $_POST['char']);
	$guid	 = (int)$guid1[0];
	$realmid = (int)$guid1[1];
	
	$REALM_DB = newRealmPDO($realmid);
 
	$acct = NULL;							//acct id from db
	$race = NULL;							//characters race id
    $level = NULL;                        //Character Level

	$location = (int)$_POST['location'];
	
	$res = $REALM_DB->prepare("SELECT ".$db_translation['characters_race'].", ".$db_translation['characters_level'].", ".$db_translation['characters_gold']." FROM `".$db_translation['characters']."` WHERE  `".$db_translation['characters_guid']."` = :guid AND `".$db_translation['characters_acct']."` = :account");
	$res->bindParam(':guid', $guid, PDO::PARAM_INT);
	$res->bindParam(':account', $a_user[$db_translation['acct']], PDO::PARAM_INT);
	$res->execute();
	
	$numrows = $res->rowCount();
	$row = $res->fetch(PDO::FETCH_NUM);
	
	unset($res);

	if ($numrows == 0)
	{
		box('Failure',"<center>That character does not exist on your account.</center>");
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
	}
	
	$race = $row[0];
    $level = $row[1];

	if($row[2] < $module_teleporter_gold)
	{
		box('Failure',"<center>Your character does not have enough gold to be teleported. (".$row[2].")</center>");
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
	}
	$gold = $row[2];
	

	$map = "";
	$x = "";
	$y = "";
	$z = "";
	$place = "";

	switch($location)
	{
		//stormwind
		case 1:
			$map = "0";
			$x = "-8913.23";
			$y = "554.633";
			$z = "93.7944";
			$place = "Stormwind City";
			break;
		//ironforge
		case 2:
			$map = "0";
			$x = "-4981.25";
			$y = "-881.542";
			$z = "501.66";
			$place = "Ironforge";
			break;
		//darnassus
		case 3:
			$map = "1";
			$x = "9951.52";
			$y = "2280.32";
			$z = "1341.39";
			$place = "Darnassus";
			break;
		//exodar
		case 4:
			$map = "530";
			$x = "-3987.29";
			$y = "-11846.6";
			$z = "-2.01903";
			$place = "The Exodar";
			break;
		//orgrimmar
		case 5:
			$map = "1";
			$x = "1676.21";
			$y = "-4315.29";
			$z = "61.5293";
			$place = "Orgrimmar";
			break;
		//thunderbluff
		case 6:
			$map = "1";
			$x = "-1196.22";
			$y = "29.0941";
			$z = "176.949";
			$place = "Thunder Bluff";
			break;
		//undercity
		case 7:
			$map = "0";
			$x = "1586.48";
			$y = "239.562";
			$z = "-52.149";
			$place = "The Undercity";
			break;
		//silvermoon
		case 8:
			$map = "530";
			$x = "9473.03";
			$y = "-7279.67";
			$z = "14.2285";
			$place = "Silvermoon City";
			break;
		//shattrath
		case 9:
			$map = "530";
			$x = "-1863.03";
			$y = "4998.05";
			$z = "-21.1847";
			$place = "Shattrath";
			break;
		//for unknowness -> shattrath
		default:
			box('Failure',"<center>That is an invalid location.</center>");
			break;
	}

	//disallows factions to use enemy portals
	switch($race)
	{
		//alliance
		case 1:
		case 3:
		case 4:
		case 7:
		case 11:
			if((($location >=5) && ($location <=8)) && ($location != 9))
			{
				box('Failure',"<center>Alliance players may not be teleported to horde areas.<br><br></center>");
				$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
			}
			break;
		//horde
		case 2:
		case 5:
		case 6:
		case 8:
		case 10:
			if ((($location >=1) && ($location <=4)) && ($location != 9))
			{
				box('Failure',"<center>Horde players may not be teleported to alliance areas.<br><br></center>");
				$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
			}
			break;
		default:
			die("<center>The selected race is not valid.<br><br></center>");
			break;
	}

    if($level < 58 && $location == 9)
    {
    	box('Failure',"<center>This location requires you to be at least level 58.</center>");
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
    }

	$newGold = $gold - (module_teleporter_gold);

	$tele_p = teleport($guid,$x,$y,$z,$map,$newGold);//returns
	if ($tele_p)
	{
		$cont2 = $tele_p;
	}
	else
	{
		$cont2.= "<center>You are entering a Goblin Transporter Machine...<br><br></center>";
		$cont2.= "<center>Your character has been teleported to ".$place.".<br></center>";
	}
	

	$cont2.= "</td></tr>";
	
	unset($REALM_DB);
}
else
{
	$cont2= "<center><div class='sub-box1' align='left'> 
	         <form name='myform' method='post' action='./quest.php?name=teleporter'>";
    $cont2.= "$lan[TELEPORTER]<br/>";
	//***START DROPDOWN****(c)axe
	$user = $a_user[$db_translation['login']];
	
	$res = $ACC_PDO->prepare("SELECT * FROM `".$db_translation['accounts']."` WHERE `".$db_translation['login']."` = :username LIMIT 1");
	$res->bindParam(':username', $user, PDO::PARAM_INT);
	$res->execute();
	
	$SQLwow3 = $res->fetch(PDO::FETCH_NUM);
	
	unset($res);
	
	$cont2.= "<center><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$cont2.= "Teleport <select name='char'>";
	
	foreach ($realm as $id => $data)
	{
		$REALM_DB = newRealmPDO($id);
	
		$res = $REALM_DB->prepare("SELECT * FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_acct']."` = :accid");
		$res->bindParam(':accid', $a_user[$db_translation['acct']], PDO::PARAM_INT);
		$res->execute();
		
		while ($char2 = $res->fetch(PDO::FETCH_ASSOC))
		{
			$cont2.= "<option value='".$char2[$db_translation['characters_guid']]."-".$id."'>".$data['name']." - ".$char2[$db_translation['characters_name']]."</option>";
		}
		unset($res);
		unset($REALM_DB);
	}	
	
	
		  $cont2.= "</select>";
		  $cont2.= "</td><td>";
	
    //******END DROPDOWN********
	$cont2.= "<center>&nbsp;to ";
	$cont2.= "<select name=location>";
	$cont2.= "<option value='1'>Stormwind</option>";
	$cont2.= "<option value='2'>Ironforge</option>";
	$cont2.= "<option value='3'>Darnassus</option>";
	$cont2.= "<option value='4'>Exodar</option>";
	$cont2.= "<option value='---------'>------------------</option>";
	$cont2.= "<option value='5'>Orgrimmar</option>";
	$cont2.= "<option value='6'>Thunder Bluff</option>";
	$cont2.= "<option value='7'>Undercity</option>";
	$cont2.= "<option value='8'>Silvermoon</option>";
	$cont2.= "<option value='---------'>------------------</option>";
	$cont2.= "<option value='9'>Shattrath</option>";
	$cont2.= "</select></td></tr></table></center><br>";
	if ($module_teleporter_gold<>'0')
	$cont2.= "<center>Teleporting a character is completely free of charge.</center>";

	$cont2.= "<br><div class='line2'></div>
	          <center><div id='log-b2'><input type=submit name=submit value=Teleport></div><br></center>";
	
	$cont2.= "</form>";
	$cont2.= "<div class='line2'></div>
	          <center>You have to be logged out for the teleportation to succeed.</center> </div>";
}
$box_wide->setVar("content_title", "Character Teleporter");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	