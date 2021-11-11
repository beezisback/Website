
<?php include "header.php" ?>

<div class="container">
<div class="row">
<div class="user-panel logged">
<div class="cp-item wow shake">
<span class="cp-icon ico-acc"></span>
<p>Welcome back</p>
<p><span><?php echo ucfirst(strtolower($_SESSION['cw_user']));?></span></p>
<?php 
			if (isset($_SESSION['cw_gmlevel']) && $_SESSION['cw_gmlevel']>=$GLOBALS['adminPanel_minlvl'] && $GLOBALS['adminPanel_enable']==true) 
				echo ' <a href="admin/">(Admin Panel)</a>';
				
			if (isset($_SESSION['cw_gmlevel']) && $_SESSION['cw_gmlevel']>=$GLOBALS['staffPanel_minlvl'] && $GLOBALS['staffPanel_enable']==true) 
				echo ' <a href="staff/">(Staff Panel)</a>';
			?>
</div>
<div class="cp-item wow shake">
<span class="cp-icon ico-coins"></span>
<p>Account balance</p>
<p>
<span class="coin-gold"></span> <span class="count-gold"><?php echo account::loadVP($_SESSION['cw_user']); ?></span>
</p>
</div>
<div class="cp-item wow shake">
<span class="cp-icon ico-cp"></span>
<p>Enter to</p>
<p><a href="?p=ucp"><span>Control Panel</span></a></p>
</div>
<div class="cp-item wow shake last">
<?php if(isset($_SESSION['cw_user'])) { ?>
<a href='?p=logout&last_page=<?php echo $_SERVER["REQUEST_URI"]; ?>'><span class="ico-exit"></span></a>
<?php } ?>
</div>
</div>
</div>
</div>
    
<?php include "right.php" ?>

<section class="main-section with-sidebar">
<div class="newsbox clearfix">
<article class="howtoplay">
<section id="welcome">
<h2>Welcome to Nefelin-WoW!</h2>
<div class="page_body border_box"><p><img src="https://i.imgur.com/KzkvAZJ.png.png" width="100" height="100" /></p>
<div><strong>WRATH OF THE LICH KING 3.3.5a CONNECTION GUIDE</strong></div>
<div>&nbsp;</div>
<p>&nbsp;First of all, you need to create a new account. You can do this <a href="./">here</a>.</p>
<p>If you already have an account you can skip the step above.</p>
<p>&nbsp;</p>
<p><br /> <br /> <strong>SITUATION 1:</strong><strong>&nbsp;You do not have World of Warcraft, version Wrath of the Lich King 3.3.5a - download FULL.</strong> <strong>(RECOMMENDED)</strong></p>
<p>&nbsp;</p>
<p>1. Download World of Warcraft - Wrath of the Lich King 3.3.5a.</p>
	<li>First, you need Download World Of Warcraft (3.3.5a). [<a href="https://mega.nz/#F!HVpEnYia!0BW5e-IwLcGU7AGzzvxywA">Download Game (Mega)</a>] [<a href="https://github.com/wowgaming/client-data/releases/download/v0/clean-game-client.torrent">Download Torrent</a>]</li>
	<li>Open the game folder.</li>
	<li>Go to wow3.3.5a/Data/enUS or wow3.3.5a/Data/enGB folder.</li>
	<li>Open realmlist.wtf with Text Editor like Notepad &amp; replace all data to <span style="color:#ff0000"><strong>set realmlist login.nefelin-wow.com</strong></span></li>
	<li>Delete Cache folder if exists in the game directory.</li>
<p>&nbsp;</p><p> Play &amp; enjoy our WotLK realm!</p>
<p><br /> <br /> <br /> 
</div>
</section>
</article>
</div>
</section>
</div>
</div>
</main>

<footer id="footer">
<div class="container">
<div class="row clearfix">
<div class="column">
<div id="footer-copy" class="wow fadeInUp">
&copy; 2018 - 2019 <br />
<a href="./">Nefelin-WoW Project, Vanilla Legacy Server</a> 
<a class="legals" href="">Contact us - About us</a> 
<a class="legals" href="">Refund policy / private policy</a> 
</div></div></div></div>
</div>
</div>
</div>
</footer>
<script type="text/javascript" src="/themes/nefelin/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/themes/nefelin/js/custom.js"></script>