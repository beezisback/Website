<?php
include_once 'rank.php';
							
					if (!defined('init_pages'))
						{	
						header('HTTP/1.0 404 not found');
						exit;
						}

					//CORE->UnderConstruction('User Profiler');	
					
					$uid = isset($_GET['uid']) ? (int)$_GET['uid'] : false;
					$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
				
					
							
					if($uid) {
					
					$res = $DB->prepare("SELECT * FROM `account_data` WHERE `id` = :id LIMIT 1;");
					$res->bindParam(':id', $uid, PDO::PARAM_INT);
					$res->execute();
					
					
					if ($res->rowCount() == 0) {
					
					//Set the title
						$TPL->SetTitle('Error');
						//Print the header
						$TPL->LoadHeader();
					
					
					
					} else {
				
						while ($uid = $res->fetch()) {
						
						//Set the title
						$TPL->SetTitle(''.$uid['displayName'].'\'s Profile');
						//Print the header
						$TPL->LoadHeader();
						
						$rank = $uid['rank'];
						
			echo '<div class="content_holder">
					<div class="sub-page-title">
						<div id="title">
							<h1>'.$uid['displayName'].'\'s profile<p></p><span></span></h1></div>
						</div>
 
  	<div class="container_2 account" align="center">
     	<div class="cont-image">
					
					<div class="container_3 account_light_cont account_info_cont" align="left">
					<div class="account_info" align="left">
					
					<style type="text/css">

							.allcaps {
							font-variant: small-caps;
							text-transform: uppercase;
								}

					</style>
					
					
					<ul class="account_avatar">
						<li id="avatar"><span style="background:url(', ($CURUSER->getAvatar()->type() == AVATAR_TYPE_GALLERY ? './resources/avatars/'.$CURUSER->getAvatar()->string() : $CURUSER->getAvatar()->string()), ') no-repeat; background-size: 100%;"></span><p></p></li>
						<li id="rank"><center><p><img src="'.$config['BaseURL'].'./template/style/images/ranks/', user_rank($rank) , '"></img></p></center></li>
					</ul>
			
					<ul class="account_info_main">
						<li id="displayname"><span>Display name:</span><a href="'.$config['BaseURL'].'/index.php?page=profile&uid='.$uid['id'].'"><p class="allcaps"><b>', $uid['displayName'], '</b></p></a></li><br />
						
						<li><span>Last login:</span><p>', $uid['last_login'], '</p></li>
						<li id="gcoins"><span>Gold Coins:</span><div></div><p>', $CURUSER->get('gold'), '</p></li>
						<li id="scoins"><span>Silver Coins:</span><div></div><p>', $CURUSER->get('silver'), '</p></li>
					</ul>
					
					<ul class="account_info_second">
						<li><span>Referred members:</span><p><a href="', $config['BaseURL'], '/index.php?page=recruit-a-friend">', $raf->GetReferralsCount($CURUSER->get('id')),'</a></p></li>
						<br/>
						<li><span>Last login:</span><p>', $uid['last_login'], '</p></li>
						<li><span>Last IP Address:</span><p>', $CURUSER->get('last_ip'), '</p></li>
						<br/>
						<li><span>Registration date:</span><p>', $CURUSER->get('joindate'), '</p></li>
						<br/>
					</ul>
					
				
	
';
					}
				}
					
		}
	
	unset($res);
?>
   	</div>
        
    </div>
    
</div>

<?php
	$TPL->LoadFooter();
?>