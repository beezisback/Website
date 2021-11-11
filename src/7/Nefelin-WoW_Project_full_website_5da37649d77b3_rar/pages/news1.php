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
<h3>New changelog</h3>
<div class="content content_1">
<p>
<font size="5">October 27 - 00:00</font>
</p>
<p>
&nbsp;
</p>
<p>
1. fix(Core/spell_item): Fix a few items with spell effects
<br>
CHANGES PROPOSED:
Remove a wrong emote played while using the "Oracle Talisman of Ablution" (every time you kill an enemy which grants the spell effect the emote about the "Titanium Seal of Dalaran" was played).
Use broadcast text for the emotes of the "Titanium Seal of Dalaran" (text was hard-coded before).
Use broadcast text for the emotes of "Fish Feast", "Great Feast", "Small Feast" and "Gigantic Feast".
</p>
<p>
&nbsp;
</p>
<p>
2. fix(DB/gossip_menu_option): Gossip Dalaran NPCs
</br>
CHANGES PROPOSED:
Remove one of the two duplicate gossip options "The Horde Quarter" when asking NPCs about class trainers.

ISSUES ADDRESSED:
none

TESTS PERFORMED:
tested successfully in-game

HOW TO TEST THE CHANGES:
.tele dalaran
just speak with the NPCs, asking for directions to the class trainers; there should now be no duplicate entry anymore concerning the Horde quarter
</p>
<p>
&nbsp;
</p>
<p>
3. fix(DB/SAI): Battle beneath the Dark Portal, part 2 
<br>
CHANGES PROPOSED:
This is related to PR #1719. The initial wave of demons did not attack if the player just triggered the spawn, but then moves out of reach. This is fixed by setting the initial Wrath Masters active.

ISSUES ADDRESSED:
none

TESTS PERFORMED:
tested successfully in-game

HOW TO TEST THE CHANGES:
.go -248.322 934.786 84.3793 530
just fly as GM over the intial wave of demons and continue to the Path of Glory until out of reach; wait a bit and return: The battle should have been started even without a player around.
</p>
<p>
&nbsp;
</p>
<p>
Import pending SQL update file... …
<br><br>
fix(DB/waypoint_scripts): Chilltusk (#2357)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/gossip_menu_option): Quest "The Exorcism of Colonel Jules" (#2355 …
<br><br>
fix(DB/SAI): Garm's Bane (#2354)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/creature_loot_template): Fix Baron Rivendale loot, close #2349 (… …
<br><br>
Import pending SQL update file... …
<br><br>
feat(DB/points_of_interest): Improved points_of_interest table, close #… …
<br><br>
fix(Core/Commands): debug send opcode (#2344)
<br><br>
fix(DB/Core): Quest "The Great Hunter's Challenge"; add new condition… …
<br><br>
fix(DB/Quest): Fix quest Hotter than Hell requirement of Fel Reaver c… …
<br><br>
Import pending SQL update file... …
<br><br>
feat(DB/game_tele): Added Emerald Dream teleports (#2333)
<br><br>
fix(DB/SAI): Fulgorge (#2326)
<br><br>
feat(Core/Tools): mmaps working with mapID >= 1000 (#2321)
<br><br>
Import pending SQL update file... …
<br><br>
feat(Core/SpellMgr): Worldserver option for ICC buff (#2320)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/SAI): Quest event "The Reckoning" (#2318)
<br><br>
feat(CI): add docker to travis build (#2347)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/SAI): Fel Reaver (#2309)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/SAI): Sen'Jin Fetish (#2297)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/SAI): Battle beneath the Dark Portal, part 2 (#2291)
<br><br>
Import pending SQL update file... …
<br><br>
fix(DB/gossip_menu_option): Gossip Dalaran NPCs (#2290)
<br><br>
feat(docker): allow script-less build (#2337)
</p>
<p>
<img src="https://www.icy-veins.com/forums/news/31193-patch-725-official-patch-notes.jpg" width="750">
</p>
</div>
<div class="content content_2">
<p>
New changelog"
</p>
</div>
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