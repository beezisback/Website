<div id="menu">
<ul>
<li><a href="./">News | </li> <li><a href="register.wow">Register Account</a> | </li>  <li><a href="accounts.wow">Account Manager</a> | </li> <li class="active">Connection guide | </li> <li><a href="statistics.wow">Statistics</a> | </li> <li><a href="#">About us</a> |</li> <li><a href="/forum" target='_blank'>Forum</a></li>
</ul>
</div>

<?php
if (!defined('AXE'))
	exit;
//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include


//
?>

<?php

$whosonline .='

<div class="post_body scaleimages"><span>By accessing this site, you agree to be bound by these <span><a href="#" target="_blank"><span>Terms of Use</span></a></span>.<br />If you do not agree to be bound by all of these <span><a href="#" target="_blank"><span>Terms of Use</span></a></span>, please leave this site immediately.<br /></span></div>
<div class="post_body scaleimages"><span>&nbsp;</span></div>
<div id="pid_4" class="post_body scaleimages" style="text-align: left;"><span>1. First of all, you must <span><a href="register.wow" target="_blank"><span>create an account</span></a></span>. The account is used to log into both the game and our website.</span><br /> <br /><span> 2. <span><a href="magnet:?xt=urn:btih:f9499fb1525f0dd23a19c4548805243632d420d1&dn=Excalibur+WoW+Burning+Crusade+2.4.3+-+With+Basic+AddOns&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80&tr=udp%3A%2F%2Ftracker.istole.it%3A6969&tr=udp%3A%2F%2Ftracker.ccc.de%3A80&tr=udp%3A%2F%2Fopen.demonii.com%3A1337" target="_blank"><span>Install World of Warcraft (Patch 2.4.3). DOWNLOAD</span></a>&nbsp; (Windows Client) -&gt; Ready-To-Play!</span></span><br /> <br /><span> 3. If you already have the client, Open up the "World of Warcraft" directory. The default directory is "C:\Program Files\World of Warcraft".<br /> </span><br /><span> 4. Open up the file called "realmlist.wtf" with a text editor such as Notepad. To do this, you must right click on the file and choose properties, then select notepad as the default software for files with the ".wtf" ending. You may also just start the text editor and drag the file into the edit window.<br /> </span><br /> <span>5. Erase all text and change it to:</span><span><br /> </span><br /><span style="color: #ff6600;"><strong>set realmlist&nbsp;<span>84.252.24.24</span></strong><br /><span style="color: #ff6600;"><strong>set realmlist&nbsp;<span>logon.lastwow.ml</span></strong><br /> </span><br /> <span>Save the realmlist.wtf file and you may now start playing!</span></div>
<div class="post_body scaleimages" style="text-align: left;">&nbsp;</div>
<div class="post_body scaleimages" style="text-align: left;"><span style="font-weight: bold;"><span style="font-size: small;"><span><strong><span style="color: #ff0000;">Important: Please delete your CACHE files for a proper gameplay.</span><br /><span style="color: #ff0000;">(C:\Program Files\World of Warcraft\Cache)</span></strong></span></span><br /> </span><br /> <span style="color: #ff9933;"><span style="font-weight: bold;">Please support us with a vote (check the shop at our website to spend your vote points). If you need any help, do not hesitate to create a support ticket.</span></span></div>
<p><strong>&nbsp;</strong></p>

<!--
<div id="download-client">
<span><a href="magnet:?xt=urn:btih:f9499fb1525f0dd23a19c4548805243632d420d1&dn=Excalibur+WoW+Burning+Crusade+2.4.3+-+With+Basic+AddOns&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80&tr=udp%3A%2F%2Ftracker.istole.it%3A6969&tr=udp%3A%2F%2Ftracker.ccc.de%3A80&tr=udp%3A%2F%2Fopen.demonii.com%3A1337">Download Windows Client</a></span><br /><span>Open this file with <a href="http://www.utorrent.com/">uTorrent</a></span> <img style="float:right; margin-right:20px;" data-pyroimage="true" src="http://www.excalibur.la/addons/shared_addons/themes/base/img/icon_win.png" alt="Windows" height="32" width="32"/></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="download-client"><span><a href="http://dl-serv.exnw.com/browse.php?file=ExcaliburWoW_Client_Mac_enUS.zip">Download Mac Client</a></span><br /><span>Direct Download</span> <img style="float:right; margin-right:20px;" data-pyroimage="true" src="http://www.excalibur.la/addons/shared_addons/themes/base/img/icon_mac.png" alt="Mac" height="32" width="32"/>
</div>
-->
';
?> 
<?php
$box_wide->setVar("content_title", "Connection guide");	
$box_wide->setVar("content", $whosonline);
print $box_wide->toString();							
?>	
<?php
include "top.php";
?>