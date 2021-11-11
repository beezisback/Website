<?php
// Uptime
mysql_select_db("$uptime");
$reponse = mysql_query("SELECT uptime, starttime FROM `uptime` ORDER BY `uptime`.`starttime` DESC") or die(mysql_error());
$donnees = mysql_fetch_array($reponse);
$temps = $donnees['uptime'];
$day = floor($temps / 86400);
if($day > 0)
$days = $day.'';
else
$days = '0';
$hours = floor(($temps - ($day * 86400)) / 3600);
if($hours < 10)
$hours = ''.$hours;
$min = floor(($temps - (($hours * 3600) + ($day * 86400))) / 60);
if ($min < 10)
$min = "".$min;

$sec = $temps - ($day * 86400) - ($hours * 3600) - ($min * 60);
if ($sec < 10)
$sec = "".$sec;
// Uptime

// online players
mysql_select_db("$player_online");
$sql = "SELECT SUM(online) FROM characters";
$sqlquery = mysql_query($sql) or die(mysql_error());
$memb = mysql_result($sqlquery,0,0); 
$asql = "SELECT SUM(online) FROM characters WHERE race IN(1,3,4,7,11)";
$asqlquery = mysql_query($asql) or die(mysql_error());
$amemb = mysql_result($asqlquery,0,0);  

$hsql = "SELECT SUM(online) FROM characters WHERE race IN(2,5,6,8,10)";
$hsqlquery = mysql_query($hsql) or die(mysql_error());
$hmemb = mysql_result($hsqlquery,0,0); 
//mysql_close($conn);
// online players
?>


 <div class="col-lg-4 pt-lg-0 pt-3">
                <div class="row">
                    <div class="col-md-12">
					<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{

print '
<div class="post">
<a class="btn btn-lg btn-primary btn-block" href="register.wow">Join us Now!</a>
 </div>
';

}
?>

<?php
if (!defined('AXE'))
	exit;

if (!$a_user['is_guest'])
{
	
print '

<div class="post">
<a class="btn btn-lg btn-primary btn-block" href="accounts.wow">My account</a>
</div>
';	
}
?>
<style>
table#serverFeatures {
    width: 150px;
}

#server-stats h5 {
    font-family: Barkentina,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 24px;
    line-height: 1px;
}

#server-stats {
    width: 300px;

}

.on {
    width: 6px;
    height: 6px;
    background: #00df00;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,223,0, 0.8);

</style>
                    </div>
                </div>
             
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post">
                                <p class="q-news-title"> Server Statistic <?php

    //Basic configuration
    $sip = "185.148.145.72";    //server IP
    $sport = "8085";         //server PORT

    if(realm_status($sip, $sport) === false)
    {
       echo '<img data-pyroimage="true" src="styles/default/images/off.png" width="40" height="40" title="Offline">';
    }
    else if(realm_status($sip, $sport) === true)
    {
      echo '<img data-pyroimage="true" src="styles/default/images/on.png" width="40" height="40" title="Online">';
    }
    else
    {
        //echo '<img title="UNAVALIBLE" alt="UNAVALIBLE" src="unavalible.gif">';
        echo 'Server UNAVALIBLE';
    }

    //Function to check if the provided IP and PORT is reachable
    function realm_status($host, $port)
    {
        error_reporting(0);
        $etat = fsockopen($host,$port,$errno,$errstr,3);
                    
        if(!$etat)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
?>			
</p>
<div id="server-stats">
<p><strong>Version 1.12, Drums of War.</strong></p>
<p><strong>Rates:</strong> x1</p>

<p><strong>The Burning Crusade  <span style="color:#B60003;">Not Opening </span></strong></p>
<p><strong>Version 2.4.3</strong></p>
<p><strong>Rates:</strong> x1</p>
<p><strong>Realmlist:</strong> logon.lightbringer-project.ga</p>

<!--
<p><a href="#"><strong>Players Online:</strong> <span style="color:#00df00;"><b><?php echo $memb; ?></b></span></a></p>
<p><img data-pyroimage="true" src="styles/default/images/logo_alliance.png" title="Aliance Players" alt="Aliance Players"><span style="color:#306EFF"><b><?php echo $amemb; ?></b></span> <b>Players</b>&nbsp;&nbsp;&nbsp;<img data-pyroimage="true" src="styles/default/images/logo_horde.png" title="Horde Players" alt="Horde Players"><span style="color:#B60003"><b><?php echo $hmemb; ?></b></span> <b>Players</b></p>
-->
<p><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Uptime:</strong> <a style="font-family: Barkentina,'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 16px;color: rgb(225, 211, 162);"><b><?php echo "$days"; ?> d, <?php echo "$hours"; ?> h, <?php echo "$min"; ?> m, <?php echo "$sec"; ?> s</b></p>

<table id="serverFeatures"><tbody>
<tr><td><strong title="On">Vmaps</strong></td> 
<td><div class="on"></div></td></tr>
<tr><td><strong title="On">Mmaps</strong></td>  
<td><div class="on"></div></td></tr> 
<tr><td><strong title="On">Anticheat</strong></td> <td><div class="on"></div></td></tr> 
</tbody></table></div>

                                         
                            </div>
                        </div>
                    </div>
                                    <div class="row">
                        <div class="col-md-12">
                            <div class="post pt-1">
                                <p class="q-news-title">Latest changelogs</p>
                                        <a href="#">Coming Soon</a><br />
                                    <hr />
                                  
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="post">
                            <a href="#">
                                <div class="announcement-box" style="background-image: url(styles/default/images/logos.png);">
                                    <div class="box-title">Lightbringer Begins</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>