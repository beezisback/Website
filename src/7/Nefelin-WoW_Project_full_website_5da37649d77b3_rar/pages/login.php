<?php if (!isset($_SESSION['cw_user'])) { 
 	  if (isset($_POST['login'])) 
	  	account::logIn($_POST['login_username'],$_POST['login_password'],$_SERVER['REQUEST_URI'],$_POST['login_remember']);
?>

<link href="css/jquery.fancybox.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">
<style>
.game-versions {
    font-size: 40px;
    font-family: frizquadratac,sans-serif;
    color: #fff;
    text-decoration: none;
}

.game-versions .game-versions-text {
    position: relative;
    top: 10px;
	}
</style>
<body>
<div class="wrapper">

<header id="header">
<section class="section home" id="home">
<div class="container">
<div class="navbar-toggle">
<span class="burger"></span>
</div>
<div class="slogan">
set realmlist login.nefelin-wow.com
</div>

<nav class="navbar clearfix" role="navigation">
<ul class="nav navbar-nav clearfix">
<li class="active">
<a href="#home"><span class="text">Home</span><span class="ico"><img src="/images/nav-side.png" alt=""></span></a>
</li>
<li>
<a href="#about"><span class="text">About us</span><span class="ico"><img src="/images/nav-side-03.png" alt=""></span></a>
</li>
<li>
<a href="#classes"><span class="text">Why Progressive?</span><span class="ico"><img src="/images/nav-side-04.png" alt=""></span></a>
</li>
<li>
<a href="#why"><span class="text">Why WOTLK?</span><span class="ico"><img src="/images/nav-side-05.png" alt=""></span></a>
</li>
<li>
<a href="#raids"><span class="text">Raids</span><span class="ico"><img src="/images/nav-side-06.png" alt=""></span></a>
</li>
<li>
<a href="#betakey"><span class="text">Registration</span><span class="ico"><img src="/images/nav-side-07.png" alt=""></span></a>
</li>
</ul>
<div class="socials">
<a href="https://www.facebook.com/Nefelin-WoW-112216703519246/" class="wow bounceInLeft"><img src="/images/ico-fb.png" alt=""></a>
<a href="#" class="wow bounceInLeft"><img src="/images/ico-vk.png" alt=""></a>
<a href="https://discordapp.com/invite/WTbBWq" class="wow bounceInRight"><img src="/images/ico-yt.png" alt=""></a>
</div>
<div class="languages wow lightSpeedIn">
<a href="/main/index.html" class="en active"></a>
<a href="/ru/main/index.html" class="ru"></a>
</div>
</nav>
<div class="brand">
<a class="logo" href=""><img src="/images/nefelin_logo_wotlk.png" class="wow swing" alt="logo" role="banner" style="visibility: visible; animation-name: swing;"></a>
</div>
<div class="video">
<a href="https://www.youtube.com/watch?v=7os7KCM_dfA" class="various fancybox-media play wow flip"><img src="/images/play.png" alt=""></a>
</div>
<div class="buttons clearfix">
<div class="rcol text-left wow bounceInLeft"><a href="#" class="btn scrollToForm" data-target="betakey-content">Play Now</a></div>
<div class="rcol text-right wow bounceInRight"><a href="https://discordapp.com/invite/WTbBWq" class="btn">Discord</a></div>
</div>
</div>
</section>
</header>

<main id="content-wrapper">
<section class="section about" id="about">
<div class="container">
<h3 class="section-title wow pulse">About our project</h3>
<article class="section-text wow flipInX">
<p>Like you, the staff here at <strong>Nefelin-WoW Project</strong> have explored and conquered the vastness of World of Warcraft. And also like you, our love of the game grew and grew. So much, in fact, we desired to revive those emotions and moments experienced during the first WoW expansion... <strong>Wrath of the Lich King</strong>.</p>
<p>However, we could not find a suitable place to relive all those unforgettable moments... so we decided to do it ourselves! And now, after 5 years of active development, we are finally ready to introduce our project... to YOU.</p>
</article>
<div class="row items">
<div class="col wow wobble">
<div class="block">
<div class="img">
<img src="/images/pref/pref-02.png" alt="">
<img src="/images/pref/pref-hov-02.png" class="hov" alt="">
</div>
<h4 class="title">Pathfinding</h4>
<div class="text">Every unit (creature, npc, pet) calculates path to reach their target without falling under textures, going through pillars etc.</div>
</div>
</div>
<div class="col wow tada">
<div class="block">
<div class="img">
<img src="/images/pref/pref-11.png" alt="">
<img src="/images/pref/pref-hov-11.png" class="hov" alt="">
</div>
<h4 class="title">Copy characters from Nefelin</h4>
<div class="text">You can copy your characters from Nefelin to play on WTLK, your characters will still exist on vanilla, so you can select where to play.</div>
</div>
</div>




<div class="col wow tada">
<div class="block">
<div class="img">
<img src="/images/pref/pref-07.png" alt="">
<img src="/images/pref/pref-hov-07.png" class="hov" alt="">
</div>
<h4 class="title">Automatic backup system</h4>
<div class="text">Transports backups every day from main server to others. It backups the full server and all your characters every day. </div>
</div>
</div>
<div class="col wow wobble">
<div class="block">
<div class="img">
<img src="/images/pref/pref-08.png" alt="">
<img src="/images/pref/pref-hov-08.png" class="hov" alt="">
</div>
<h4 class="title">DDOS Protection</h4>
<div class="text">We have a large experience in servers’ protection, so you can be sure that server will be uptime 99.9%.</div>
</div>
</div>
<div class="col wow tada">
<div class="block">
<div class="img">
<img src="/images/pref/pref-09.png" alt="">
<img src="/images/pref/pref-hov-09.png" class="hov" alt="">
</div>
<h4 class="title">Good Latency</h4>
<div class="text">Our servers have 1Gbps internet connection, with it you will never have problems with connection or lags.</div>
</div>
</div>
<div class="col wow wobble">
<div class="block">
<div class="img">
<img src="/images/pref/pref-10.png" alt="">
<img src="/images/pref/pref-hov-10.png" class="hov" alt="">
</div>
<h4 class="title">Multilanguage support</h4>
<div class="text">Our team is very big and at the moment we provide support on English and Russian languages, feel free to contact us if you have any problems.</div>
</div>
</div>
</div>
</div>
</section>
<section class="section classes" id="classes">
<div class="container">
<div class="text-block">
<h3 class="section-title wow pulse">Why Progressive?</h3>
<article class="section-text wow flipInX">
<p>To begin, we answer the question: "What does «Progressive World?» mean?" This is a world in which all PvE content becomes available gradually. This means that you will not be able to visit the «Black Temple» or «Sunwell Plateau» immediately at server opening. We believe this method of release allows our community to more thoroughly enjoy «Wrath of the Lich King» and provides the best experience of of the expansion.</p>
</article>
</div>
<div class="row">
<div class="class-tabs">

<ul class="nav-tabs clearfix" role="tablist">
<li role="presentation" class="active wow bounceInLeft">
<a href="#class-warrior" aria-controls="class-warrior" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-01.png" alt="">
<img src="/images/class/class-hov-01.png" class="hov" alt="">
</div>
Warrior
</a>
</li>
<li role="presentation" class="wow bounceInDown">
<a href="#class-hunter" aria-controls="class-hunter" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-02.png" alt="">
<img src="/images/class/class-hov-02.png" class="hov" alt="">
</div>
Hunter
</a>
</li>
<li role="presentation" class="wow bounceInLeft">
<a href="#class-priest" aria-controls="class-priest" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-03.png" alt="">
<img src="/images/class/class-hov-03.png" class="hov" alt="">
</div>
Priest
</a>
</li>
<li role="presentation" class="wow bounceInUp">
<a href="#class-shaman" aria-controls="class-shaman" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-04.png" alt="">
<img src="/images/class/class-hov-04.png" class="hov" alt="">
</div>
Shaman
</a>
</li>
<li role="presentation" class="wow bounceIn">
<a href="#class-warlock" aria-controls="class-warlock" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-05.png" alt="">
<img src="/images/class/class-hov-05.png" class="hov" alt="">
</div>
Warlock
</a>
</li>
<li role="presentation" class="wow bounceInUp">
<a href="#class-druid" aria-controls="class-druid" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-06.png" alt="">
<img src="/images/class/class-hov-06.png" class="hov" alt="">
</div>
Druid
</a>
</li>
<li role="presentation" class="wow bounceInLeft">
<a href="#class-paladin" aria-controls="class-paladin" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-07.png" alt="">
<img src="/images/class/class-hov-07.png" class="hov" alt="">
</div>
Paladin
</a>
</li>
<li role="presentation" class="wow bounceInDown">
<a href="#class-rogue" aria-controls="class-rogue" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-08.png" alt="">
<img src="/images/class/class-hov-08.png" class="hov" alt="">
</div>
Rogue
</a>
</li>
<li role="presentation" class="wow bounceInRight">
<a href="#class-mage" aria-controls="class-mage" role="tab" data-toggle="tab">
<div class="img">
<img src="/images/class/class-09.png" alt="">
<img src="/images/class/class-hov-09.png" class="hov" alt="">
</div>
Mage
</a>
</li>

<li role="presentation" class="wow bounceInRight">
                                    <a href="#class-dk" aria-controls="class-dk" role="tab" data-toggle="tab">
                                    <div class="img">
                                        <img src="images/class/class-10.png" alt="">
                                        <img src="images/class/class-hov-10.png" class="hov" alt="">
                                    </div><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                    DK
                                    </font></font></a>
                                </li>


</ul>
</div>
</div>
 <div class="row tabs-row">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="class-warrior">
                                <div class="class-item">
                                    <img src="images/class/warrior-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warrior-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-hunter">
                                <div class="class-item">
                                    <img src="images/class/hunter-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                    <div class="class-item">
                                    <img src="images/class/hunter-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/hunter-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/hunter-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/hunter-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                    <div class="class-item">
                                    <img src="images/class/hunter-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/hunter-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/hunter-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-priest">
                                <div class="class-item">
                                    <img src="images/class/priest-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/priest-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-shaman">
                                <div class="class-item">
                                    <img src="images/class/shaman-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/shaman-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-warlock">
                                <div class="class-item">
                                    <img src="images/class/warlock-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/warlock-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-druid">
                                <div class="class-item">
                                    <img src="images/class/druid-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/druid-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-paladin">
                                <div class="class-item">
                                    <img src="images/class/paladin-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-03.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-04.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-07.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/paladin-08.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-rogue">
                                <div class="class-item">
                                    <img src="images/class/rogue-01-new.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-02-new.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-03-new.png" alt="">
                                    Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-04-new.png" alt="">
                                    Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-05-new.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-06-new.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-07-new.png" alt="">
                                    Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/rogue-08-new.png" alt="">
                                    Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-mage">
                                <div class="class-item">
                                    <img src="images/class/mage-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-03.png" alt="">
                                     Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-04.png" alt="">
                                     Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-07.png" alt="">
                                     Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/mage-08.png" alt="">
                                     Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="class-dk">
                                <div class="class-item">
                                    <img src="images/class/dk-01.png" alt="">
                                    Tier <span class="numbers">7</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-02.png" alt="">
                                    Tier <span class="numbers">7.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-03.png" alt="">
                                     Tier <span class="numbers">8</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-04.png" alt="">
                                     Tier <span class="numbers">8.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-05.png" alt="">
                                    Tier <span class="numbers">9</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-06.png" alt="">
                                    Tier <span class="numbers">9.5</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-07.png" alt="">
                                     Tier <span class="numbers">10</span>
                                </div>
                                <div class="class-item">
                                    <img src="images/class/dk-08.png" alt="">
                                     Tier <span class="numbers">10.5</span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
<section class="section why" id="why">
<div class="container">
<h3 class="section-title wow pulse">Why Wrath of the Lich King?</h3>
<article class="section-text wow flipInX">
<p>The legendary patch that won many hearts. According to many players, Wrath of the Lich King is the best expansion in the history of World of Warcraft.</p>
<p>Its balance between the classes, exciting dungeons & raids, unique and beautiful environments, and many interesting experiences lend to this view.</p>
</article>
<div class="why-items">
<div class="col wow bounceInRight">
<div class="img">
<img src="/images/why/why-01.png" alt="">
<img src="/images/why/why-hov-01.png" class="hov" alt="">
</div>
<div class="text">Take a part in 9 raids</div>
</div>
<div class="col wow bounceInRight">
<div class="img">
<img src="/images/why/why-02.png" alt="">
<img src="/images/why/why-hov-02.png" class="hov" alt="">
</div>
<div class="text">Battle to Level 80</div>
</div>
<div class="col wow bounceInLeft">
<div class="img">
<img src="/images/why/why-03.png" alt="">
<img src="/images/why/why-hov-03.png" class="hov" alt="">
</div>
<div class="text">Equipment implemented from the PvP sand system.</div>
</div>
<div class="col wow bounceInLeft">
<div class="img">
<img src="/images/why/why-04.png" alt="">
<img src="/images/why/why-hov-04.png" class="hov" alt="">
</div>
<div class="text">New flying mounts</div>
</div>
<div class="col wow bounceInUp">
<div class="img">
<img src="/images/why/why-05.png" alt="">
<img src="/images/why/why-hov-05.png" class="hov" alt="">
</div>
<div class="text">New Death Knight Class</div>
</div>
<div class="col wow bounceInDown">
<div class="img">
<img src="/images/why/why-06.png" alt="">
<img src="/images/why/why-hov-06.png" class="hov" alt="">
</div>
<div class="text">New battleground</div>
</div>
<div class="col wow bounceInUp">
<div class="img">
<img src="/images/why/why-07.png" alt="">
<img src="/images/why/why-hov-07.png" class="hov" alt="">
</div>
<div class="text">New continent Northrend</div>
</div>
</div>
</div>
</section>
<section class="section raids" id="raids">
<div class="container">
<h3 class="section-title">Take a part in Raids</h3>
 <div class="row">
                            <div class="raid-tabs">
                                <ul class="nav-tabs clearfix" role="tablist">
                                    <li role="presentation" class="active wow bounceInRight">
                                        <a href="#raid-vault-of-archavon" aria-controls="raid-vault-of-archavon" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-01.png" alt="">
                                                <img src="images/raid/raids-hov-01.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInDown">
                                        <a href="#raid-naxxramas" aria-controls="raid-naxxramas" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-02.png" alt="">
                                                <img src="images/raid/raids-hov-02.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInLeft">
                                        <a href="#raid-the-obsidian-sanctum" aria-controls="raid-the-obsidian-sanctum" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-03.png" alt="">
                                                <img src="images/raid/raids-hov-03.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInUp">
                                        <a href="#raid-eye-of-eternity" aria-controls="raid-eye-of-eternity" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-04.png" alt="">
                                                <img src="images/raid/raids-hov-04.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceIn">
                                        <a href="#raid-ulduar" aria-controls="raid-ulduar" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-05.png" alt="">
                                                <img src="images/raid/raids-hov-05.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInUp">
                                        <a href="#raid-trial-of-the-crusader" aria-controls="raid-trial-of-the-crusader" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-06.png" alt="">
                                                <img src="images/raid/raids-hov-06.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInLeft">
                                        <a href="#raid-onyxia-lair" aria-controls="raid-onyxia-lair" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-07.png" alt="">
                                                <img src="images/raid/raids-hov-07.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInDown">
                                        <a href="#raid-icecrown-citadel" aria-controls="raid-icecrown-citadel" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-08.png" alt="">
                                                <img src="images/raid/raids-hov-08.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li role="presentation" class="wow bounceInRight">
                                        <a href="#raid-the-ruby-sanctum" aria-controls="raid-the-ruby-sanctum" role="tab" data-toggle="tab">
                                            <div class="img">
                                                <img src="images/raid/raids-09.png" alt="">
                                                <img src="images/raid/raids-hov-09.png" class="hov" alt="">
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
<div class="row tabs-row">

<div class="tab-content">
<div role="tabpanel" class="tab-pane clearfix active" id="raid-vault-of-archavon">
                                <div class="place wow flip">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Archavon's Chamber</font></font></h3>
                                    <img src="images/raid/img-raid-vault-of-archavon.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vault of Archavon is a raid dungeon found in Wintergrasp Keep. </font><font style="vertical-align: inherit;">Players can only enter the dungeon while their faction controls Wintergrasp. </font><font style="vertical-align: inherit;">In particular, until the launch of Warlords of Draenor, all chiefs in this case granted honorary deaths. </font><font style="vertical-align: inherit;">10 minutes before the battle for Wintergrasp begins, any boss who is not currently in combat turns to stone and cannot fight again until after the battle ends.</font></font></div>
                                </div>
                                <div class="place-raids wow rotateIn">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Archavon_the_Stone_Watcher.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Archavon the Stone Watcher</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Emalon_the_Storm_Watcher.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Emalon the Storm Watcher</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Koralon_the_Flame_Watcher.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Koralon the Flame Watcher</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Toravon_the_Ice_Watcher.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Toravon the Ice Watcher</font></font></p>
                                    </div>
                                </div>
                            </div>
<div role="tabpanel" class="tab-pane clearfix " id="raid-naxxramas">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Naxxramas</font></font></h3>
                                    <img src="images/raid/img-raid-naxxramas.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Naxxramas is a level 80 introductory raid dungeon that floats over Dragonblight in Northrend. </font><font style="vertical-align: inherit;">It is a Plague necropolis, the headquarters of archivist Kel'Thuzad. </font><font style="vertical-align: inherit;">The original incarnation of the dungeon was considered the most difficult incursion of the Crusade prior to the Burning, which requires 40 well-equipped and skilled players to complete. </font><font style="vertical-align: inherit;">In the expansion of World of Warcraft: Wrath of the Lich King, Naxxramas moved to Northrend and re-launched as an entry level raid dungeon for level 80 players. Like all other Wrath attack dungeons, Naxxramas It has versions for 10 and 25 players.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Anub'Rekhan.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Anub'Rekhan</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Grand_Widow_Faerlina.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Great Widow Faerlina</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Maexxna.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Maexxna</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Noth_the_Plaguebringer.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Noth the Plaguer</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Heigan_the_Unclean.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Heigan the Impure</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Loatheb.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Loatheb</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Instructor_Razuvious.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Razuvious Instructor</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Gothik_the_Harvester.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gothik the Harvester</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_The_Four_Horsemen.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chest of the Four Horsemen</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Patchwerk.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Patch</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Gluth.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gluth</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Thaddius.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thaddius</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Sapphiron.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sapphiron</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Kel'Thuzad.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Kel'Thuzad</font></font></p>
                                    </div>
                                </div>
                            </div>
							
<div role="tabpanel" class="tab-pane clearfix " id="raid-the-obsidian-sanctum">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Obsidian Tabernacle</font></font></h3>
                                    <img src="images/raid/img-raid-the-obsidian-sanctum.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The obsidian sanctuary is the black dragon flying area of &#8203;&#8203;the Aspect Chamber. </font><font style="vertical-align: inherit;">The entrance is located in Dragonblight and is accessed through a crack in the ice below the Wyrmrest Temple. </font><font style="vertical-align: inherit;">He has an attack chief, Sartharion the Onyx Guardian, and his three dragon lieutenants, Shadron, Tenebron and Vesperon. </font><font style="vertical-align: inherit;">The assailants can choose to kill the three dragons or leave some combination of them alive. </font><font style="vertical-align: inherit;">Completing the encounter with one or more dragons increases the difficulty and quality of the loot that falls ..</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Sartharion.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Obsidian Tabernacle</font></font></p>
                                    </div>
                                </div>
                            </div>
<div role="tabpanel" class="tab-pane clearfix " id="raid-eye-of-eternity">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Eye of Eternity</font></font></h3>
                                    <img src="images/raid/img-raid-vault-eye-of-eternity.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Eye of Eternity (also known as EoE) is the last instance of the Nexus in which the final (and only) boss is the appearance of the Blue Dragon, Malygos. </font><font style="vertical-align: inherit;">The fight against Malygos is comparable to the fight against Onyxia in the sense that he is a lone raid boss lodged in his own case.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Malygos.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Malygos</font></font></p>
                                    </div>
                                </div>
                            </div>
<div role="tabpanel" class="tab-pane clearfix " id="raid-ulduar">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ulduar</font></font></h3>
                                    <img src="images/raid/img-raid-ulduar.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ulduar is a raid dungeon in the Ulduar titans complex located in the Storm Peaks. </font><font style="vertical-align: inherit;">It serves as the prison of the Ancient God Yogg-Saron, as well as the current residence of most of the titanic observers who have fallen under its influence. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ulduar was implemented in patch 3.1.0, intended to have a higher degree of difficulty than Naxxramas.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Flame_Leviathan.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Leviathan of llamas</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Ignis_the_Furnace_Master.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ignis, the Master of the Caldera</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Razorscale.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Razorscale</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_XT-002_Deconstructor.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">XA-002 screwdriver</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Emalon_the_Storm_Watcher.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Assembly of Iron</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Kologarn.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Kologarn</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Auriaya.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">	Auriaya</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Hodir.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hodir</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Thorim.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Razorscale</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_XT-002_Deconstructor.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thorim</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Freya.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Freya</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Mimiron.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mimiron</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_General_Vezax.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">General Vezax</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Yogg-Saron.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Yogg-Saron</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Algalon_the_Observer.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Algalon the Observer</font></font></p>
                                    </div>
                                </div>
                            </div>
<div role="tabpanel" class="tab-pane clearfix" id="raid-trial-of-the-crusader">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Crusader Test</font></font></h3>
                                    <img src="images/raid/img-raid-trial-of-the-crusader.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Great Crusader Test (this is a use name, not the real name of the raid zone) is the heroic version of the Crusader Test. </font><font style="vertical-align: inherit;">These are the most difficult raid encounters before Icecrown Citadel.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Beasts_of_Northrend.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aullahielo</font></font></p>
                                    </div>
                                    <div class="col">
                                         <img src="images/raid/Boss_icon_Lord_Jaraxxus.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lord Jaraxxus</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Faction_Champions_Horde.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Champions of the Horde</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Faction_Champions_Alliance.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Alliance Champions</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Twin_Val'kyr.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fjola Penívea</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Anubarak.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Anub'arak</font></font></p>
                                    </div>
                                </div>
                            </div>
							
<div role="tabpanel" class="tab-pane clearfix" id="raid-onyxia-lair">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Onyxia's Lair</font></font></h3>
                                    <img src="images/raid/img-raid-onyxia-lair.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Onyxia's Lair is a level 80 raid dungeon located in Wyrmbog, Dustwallow Marsh. </font><font style="vertical-align: inherit;">It is the home of Onyxia, the mother of black dragon breeding. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Onyxia's lair was originally a raid dungeon of 40 level 60 players, one of the two that were available at the launch of World of Warcraft (the other is Molten Core). </font><font style="vertical-align: inherit;">It was re-tuned as a level 80 dungeon in patch 3.2.2 in honor of the fifth anniversary of World of Warcraft. </font><font style="vertical-align: inherit;">Like all other raid dungeons in Wrath of the Lich King, it has 10 and 25 man modes.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Onyxia_Boss.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Onyxia</font></font></p>
                                    </div>
                                </div>
                            </div>
							<div role="tabpanel" class="tab-pane clearfix" id="raid-icecrown-citadel">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Icecrown Citadel</font></font></h3>
                                    <img src="images/raid/img-raid-icecrown-citadel.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Icecrown Citadel is the top of Icecrown Glacier, the tallest glacier in Azeroth, which is why it is considered 'the top of the world'. </font><font style="vertical-align: inherit;">It is here that Ner'zhul - transformed into Lich King - first appeared. </font><font style="vertical-align: inherit;">And it is here that the Scourge has built a gigantic fortress around the Ice Throne that resides hidden inside.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Lord_Marrowgar.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lord Marrow</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Lady_Deathwhisper.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lady Whispering</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Muradin_Bronzebeard.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Icecrown Gunship Battle (Alliance)</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_High_Overlord_Saurfang.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Icecrown Gunship Battle (Horde)</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Deathbringer_Saurfang.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Saurfang Libramorte</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Festergut.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Panzachancro</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Rotface.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Carapútrea</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Professor_Putricide.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Professor Putricidio</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Blood_Prince_Council.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Blood princes council</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Blood-Queen_Lana'thel.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Queen of Blood Lana'thel</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Valithria_Dreamwalker.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Valithria Dreamwalker</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Sindragosa.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sindragosa</font></font></p>
                                    </div>
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Escape_from_Arthas.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Lich King</font></font></p>
                                    </div>
                                </div>
                            </div>
							
							<div role="tabpanel" class="tab-pane clearfix" id="raid-the-ruby-sanctum">
                                <div class="place">
                                    <h3 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">The Ruby Tabernacle</font></font></h3>
                                    <img src="images/raid/img-raid-the-ruby-sanctum.png" alt="">
                                    <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ruby Sanctum is the sanctuary of the flight of the red dragon inside the Chamber of Aspects under the Wyrmrest Temple in Dragonblight. </font><font style="vertical-align: inherit;">It is a raid dungeon with normal and heroic modes for 10 and 25 players.</font></font></div>
                                </div>
                                <div class="place-raids">
                                    <div class="col">
                                        <img src="images/raid/Boss_icon_Halion.png" alt="">
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Halion</font></font></p>
                                    </div>
                                </div>
                            </div>
</div>
</div>
</div>
</section>
</main> 


<footer id="footer"> 
<section class="section betakey" id="betakey"> 
<div class="section-panel"> <div class="container">  
<div class="form-content registration-content"> 

<h4 class="section-title text-center">Log In to Your Account</h4> 
<div class="section-content wow lightSpeedIn animated" style="visibility: visible; animation-name: lightSpeedIn;"> 
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="login_form">
<div class="row">
<div class="form-group form-group-lg">
<label>Username:</label>
<div class="form-control">
<input type="text" name="login_username" id='customID1'>
</div>
</div>
<div class="form-group form-group-lg">
<label>Password:</label>
<div class="form-control">
<input type="password" name="login_password">
</div>
</div>
</div>
 <div class="row"> 

 <div class="form-group text-left">
 <input type="submit" name="login" value="Log in">
 <!--<button type="submit" class="btn btn-yellow">Log in</button> -->
 </div>
 </div>
 <div class="row text-center"> 
 <div class="form-link">
 
 <a href="" data-target="betakey-content" class="showFormContent">I want to Register a New Account</a>
 </div>
 </div>
 </form> 
 </div>
 </div>
 
 <?php 
account::isLoggedIn();
if ($_POST['register']) {
	account::register($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password_repeat'],$_POST['referer'],$_POST['captcha']);
} 
?>
 
 <div class="form-content betakey-content active"> 
 
 <h3 class="section-title text-center wow pulse" style="visibility: visible; animation-name: pulse;">Register an account</h3>
<article class="section-text text-center wow flipInY" style="visibility: visible; animation-name: flipInY;"> 
<p>The main task of the open beta testing is to identify as many bugs as possible, so that we can fix them before the release. In order to participate in the open beta testing, please register an account below. <br> We kindly request that you only sign up for the open beta testing if you intend to fully participate in bug testing.</p></article> 
 <h4 class="section-title text-center">I want to Register an account</h4> 
 <div class="section-content wow lightSpeedIn" style="visibility: visible; animation-name: lightSpeedIn;"> 
 <input type="hidden" value="<?php echo $_GET['id']; ?>" id="referer" />
<span id="username_check" style="display:none;"></span>

<div class="errors"></div>
<div class="row">
<div class="form-group">
<label>Your E-mail:</label>
<div class="form-control">
<input id="email" type="text" class="inputbox" alt="email" size="38" placeholder="E-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'E-mail'" value="<?php echo $_POST['email']; ?>">
</div>
</div>
<div class="form-group">
<label>Username:</label>
<div class="form-control">
<input id="username" type="text" class="inputbox" alt="username" size="38" maxlength="16" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Account'" value="<?php echo $_POST['username']; ?>" onkeyup="checkUsername()"/>
</div>
</div>
<div class="form-group">
<label>Password:</label>
<div class="form-control">
<input id="password" type="password" class="inputbox" alt="password" size="38" maxlength="16" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
</div>
</div>
<div class="form-group">
<label>Confirm Password:</label>
<div class="form-control">
<input id="password_repeat" type="password" class="inputbox" alt="Repeat the password" size="38" maxlength="16" placeholder="Repeat the Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Repeat Password'">
</div>
</div>
</div>
<div class="row">
<div class="form-group text-right captcha">
<div id="greCaptcha"></div> </div>
<div class="form-group text-right">

<input type="submit" class="btn btn-yellow" value="Sign Up" onclick="register(<?php if($GLOBALS['registration']['captcha']==TRUE)  echo 1;  else  echo 0; ?>)" id="register"/>


</div>
</div>
</div>

<div class="row"><div class="pull-left form-link" style="background-color: transparent; text-align: left; padding: 16px 9px 20px;"><a href="" data-target="registration-content" class="showFormContent">I already have an Account </a></div><div class="pull-right form-link " style="background-color: transparent; text-align: right; padding: 16px 9px 20px;"><a href="/?p=forgotpw">Password recovery </a></div></div>


 </form> 
 </div>
 </div>
 </div>
 </div>
 
 <div class="copyrights"> <div class="container"> <div class="go-forum text-center"><a href="" class="btn">Go to Forum</a></div><div class="row"> <div class="copy"> © 2019 Gaming portal <a href="">Nefelin-WoW.Com</a> </div><div class="u wow fadeInUp" style="visibility: hidden; animation-name: none;"> </div></div></div></div></section> </footer>


<script src="/css/js/jquery-2.1.0.min.js" type="text/javascript"></script>
<script src="/css/js/modernizr.custom.js" type="text/javascript"></script>
<script src="/css/js/jquery.easing.js" type="text/javascript"></script>
<script src="/css/js/jquery.fancybox.js" type="text/javascript"></script>
<script src="/css/js/jquery.fancybox-media.js" type="text/javascript"></script>
<script src="/css/js/wow.min.js" type="text/javascript"></script>

<script src="https://unsimpleworld.com/portfolio/html-preview/blackrock-landing-page-world-of-warcraft/js/custom.js" type="text/javascript"></script>



<?php } ?>


<?php if(isset($_SESSION['cw_user'])) { ?>
<meta http-equiv="refresh" content="0;url=?p=account">
<?php } ?>