<?php
require "include/common.php"; 
if (!defined('AXE'))
	exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./favicon.ico">
<title><?php print "Vote Script - ".$title; ?></title>
<link href="./styles/default/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
body { background:url(images/tos-bg.jpg) no-repeat top #070707; padding:0px; margin:0px;}
#fixx1 {
	padding:10px;
	color:#666;
	background:#1d1d1d;
	border:solid 1px #000;
}
</style>
</head><body>
<?php


if (!$a_user['is_guest'])
{
	if(isset($_GET['vote']) && $_GET['vote']<>'')
 	{
		$siteid = (isset($voteurls[$_GET['vote']]) ? (int)$_GET['vote'] : false);
  		if(!$siteid)
 		{
 			$text="That vote-site was not found in the database.";
 		}
		else
		{
			$voteurl = $voteurls[$siteid];

			$res = $WEB_PDO->prepare("SELECT * FROM `vote_data` WHERE `userid` = :user AND `siteid` = :site");
			$res->bindParam(':user', $a_user[$db_translation['acct']], PDO::PARAM_INT);
			$res->bindParam(':site', $siteid, PDO::PARAM_INT);
			$res->execute();
	
			$getvote3 = $res->fetch(PDO::FETCH_ASSOC);

   			$weGotBonus = false;
   			if (isset($voteBonuses))
			{
				if (isset($voteBonuses[$siteid]))
				{
					//we have bonus values for this URL
					$bonusPoints = $voteBonuses[$siteid]['bonusPoints'];
					$bonusValidFor = $voteBonuses[$siteid]['days'];
					
					//find out if we should add bonus points
					$date = new DateTime();
					$thisMonthDay = $date->format('j');
					
					if ($thisMonthDay <= $bonusValidFor)
					{
						$points = 1 + $bonusPoints;
						$weGotBonus = true;
					}
					else
					{
						//normal points value
						$points = 1;
					}
				}
				else
				{
					//normal points value
					$points = 1;
				}
			}
			else
			{
				//normal points value
				$points = 1;
			}
			
			//calculate points for update
			$points = $a_user['vp'] + $points;

   			$timenow = date("U");
   			$timefuture = date("U")+43200;//12 hrs
   			$timeleft = $getvote3['timevoted'];
   			$timeleft2 = gmdate("F j, Y G:i:s", $timeleft); //ex: March 23, 2009 18:25:55 - gmdate so its UTF
   			$timeleft3 = $getvote3['timevoted'] - $timenow;
	
			if ($getvote3['userid'] == $a_user[$db_translation['acct']] && $siteid == $getvote3['siteid'] && $getvote3['timevoted'] >= $timenow)
			{
				$timeaz=gmdate("G:i:s", $timeleft3);
				$text='Time until you can vote for this site again: '.$timeaz.'<br><br><a href="'.$voteurl.'">Click here to vote anyway.</a>';// 
			}
			else
			{
				//*****************DOING USER UPDATE QUERIES****************
				$update = $WEB_PDO->prepare("UPDATE `accounts_more` SET `vp` = :points WHERE UPPER(acc_login) = :username LIMIT 1");
				$update->bindParam(':points', $points, PDO::PARAM_INT);
				$update->bindParam(':username', strtoupper($a_user[$db_translation['login']]), PDO::PARAM_STR);
				$update->execute() or error('Unable to update your vote points. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Advise:<strong> Please notify an Administrator and this issue will be fixed as soon as possible.', __FILE__, __LINE__);
				unset($update);
				
				//********************ADDING TIME QUERIES******************
				$insert = $WEB_PDO->prepare("INSERT INTO `vote_data` (userid, siteid, timevoted) values (:userlogin, :site, :timef)");
				$insert->bindParam(':userlogin', $a_user[$db_translation['acct']], PDO::PARAM_STR);
				$insert->bindParam(':site', $siteid, PDO::PARAM_INT);
				$insert->bindParam(':timef', $timefuture, PDO::PARAM_STR);
				$insert->execute() or error('Unable to update your vote data. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Advise:<strong> Please notify an Administrator and this issue will be fixed as soon as possible.', __FILE__, __LINE__);
				unset($insert);
				   
				//*******DELETING TIME QUERIES, ALL THAT ARE EXPIRED******* usefull so there is no useless queries and no space waste
				$del = $WEB_PDO->prepare("DELETE FROM `vote_data` WHERE `timevoted` < :timenow");
				$del->bindParam(':timenow', $timenow, PDO::PARAM_STR);
				$del->execute() or error('Unable to delete your vote data. <br><br></strong>MySQL reported:<strong> '.mysql_error().'.<br><br></strong>Advise:<strong> Please notify an Administrator and this issue will be fixed as soon as possible.', __FILE__, __LINE__);
				unset($del);
				
				//*********************************************************
				if ($weGotBonus)
				{
					$text = 'Congratulations, you have recieved <strong>'.$bonusPoints.' bonus points</strong>.<br>Redirecting you to the selected vote site.<meta http-equiv="refresh" content="0; '.$voteurl.'"/>';
				}
				else
				{
					$text = 'Redirecting you to the selected vote site.<meta http-equiv="refresh" content="0; '.$voteurl.'"/>';
				}
			}
			unset($res);
		}
	}
 	else 
 	{
   		$text = 'Please select a website where you want to vote for us.';
 	}
}//end if logged in
else
{
	//not logged in ?
}
?>
<div style=" height:175px;"></div>
<br />
<br />
<br />
<br />
<br />
<center>
	<div class="post" id="fixx2">
	<div class="post_body" id="fixx1"align="center">
	<?php
	print $text;
	?>
	</div>
	</div>
</center>
</body></html>