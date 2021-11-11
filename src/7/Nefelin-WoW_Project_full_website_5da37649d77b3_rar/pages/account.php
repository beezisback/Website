<?php 
account::isNotLoggedIn();
?>

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
<div class="newsbox clearfix">

<article class="news2 wow bounceInUp first" style="background-image: url(https://www.icy-veins.com/forums/news/31193-patch-725-official-patch-notes.jpg)">
<span class="ico-horn"></span>
<div class="date">October 27 - 00:00</div>
<div class="">
<h3 class="title">
<a href="?p=news1">New changelog </a></h3>
<div class="content">
<b>1. fix(Core/spell_item): Fix a few items with spell effects </b>
<br>
<b>CHANGES PROPOSED:
Remove a wrong emote played while using the "Oracle Talisman of Ablution" (every time you kill an enemy which grants the spell effect the emote about the "Titanium Seal of Dalaran" was played).
Use broadcast text for the emotes of the "Titanium Seal of Dalaran" (text was hard-coded before).
Use broadcast text for the emotes of "Fish Feast", "Great Feast", "Small Feast" and "Gigantic Feast".</b>
</div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="?p=news1" class="btn">Read more</a>
</div>
</article>


<article class="news2 wow bounceInUp first" style="background-image: url(/images/arena1v1.jpg)">
<span class="ico-horn"></span>
<div class="date">October 12, 2019, 18:12 PM</div>
<div class="">
<h3 class="title">
<a href="#">
New modules </a>
</h3>
<div class="content">
<b>Hello, We want to inform you that the new Modules are already active on the server. </b>
<br>
<b>1. Its the Weekend ! Your XP rate has been set to: 2.</b>
<br>
<b>2. Arena 1v1 module.</b>
</div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="#" class="btn">Read more</a>
</div>
</article>

<article class="news2 wow bounceInUp " style="background-image: url(/images/news.jpg)">
<span class="ico-horn"></span>
<div class="date">October 04, 2019, 13:58 PM</div>
<div class="news-content">
<h3 class="title">
<a href="#">
Admin </a>
</h3>
<div class="content">
Hello everyone, as of today 04/10/2019 we have added a new Major Oak vendor that gives "Heirlooms" for free. The vendor is located in Horde, Orgrimmar, and Alliance, Stormwind. Thanks for taking the time, enjoyable fun sincerely Admin </div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="#" class="btn">Read more</a>
</div>
</article>
<article class="news2 wow bounceInUp " style="background-image: url(/images/news.jpg)">
<span class="ico-horn"></span>
<div class="date">October 04, 2019, 15:58 PM</div>
<div class="news-content">
<h3 class="title">
<a href="#">
Vote Shop </a>
</h3>
<div class="content">
Our store is ready for work All items are on promotion. </div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="#" class="btn">Read more</a>
</div>
</article>
</div>
<div class="readmore">
<a href="#">All news</a></div>
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
<a href="./">Nefelin-WoW Project, WoTlk Legacy Server</a> 
<a class="legals" href="">Contact us - About us</a> 
<a class="legals" href="">Refund policy / private policy</a> 
</div></div></div></div>
</div>
</div>
</div>
</footer>
<script type="text/javascript" src="/themes/nefelin/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/themes/nefelin/js/custom.js"></script>