<?php exit; ?> 
<!--<div id="slider_holder">
<div class="slider_frame"></div>
<div id="slider">
	<ul>				

	</ul>
</div>
</div>-->

<div class="top_holder">


  <!-- SLIDER -->
  <div class="slider" align="center">
		<div id="slideshow">
		 <ul id="slides">
			<li><img src="slider/1.png" width="618" height="173" alt="Sea turtle" /></li>
			<li><img src="slider/2.png" width="618" height="173" alt="Sea turtle" /></li>
			<li><img src="slider/3.png" width="618" height="173" alt="Sea turtle" /></li>
			<li><img src="slider/4.png" width="618" height="173" alt="Sea turtle" /></li>
			<li><img src="slider/5.png" width="618" height="173" alt="Sea turtle" /></li>
			<li><img src="slider/6.png" width="618" height="173" alt="Sea turtle" /></li>
			<li><img src="slider/7.png" width="618" height="173" alt="Sea turtle" /></li>
            <li><img src="slider/8.png" width="618" height="173" alt="Sea turtle" /></li>
		 </ul>
		</div>
    <div id="slider_top_bar"></div>
    
    <div id="sph"><div class="slider_pagi_holder" align="left">
    <div id="sli_pag_left"></div><ul id="pagination" class="pagination">
		<li onclick="slideshow.pos(0)"></li>
		<li onclick="slideshow.pos(1)"></li>
		<li onclick="slideshow.pos(2)"></li>
		<li onclick="slideshow.pos(3)"></li>
		<li onclick="slideshow.pos(4)"></li>
		<li onclick="slideshow.pos(5)"></li>
		<li onclick="slideshow.pos(6)"></li>
        <li onclick="slideshow.pos(7)"></li>
	</ul><div id="sli_pag_right"></div>
    </div></div>
    
    
  </div>
  <script type="text/javascript">
      var slideshow=new TINY.fader.fade('slideshow',{
	    id:'slides',
	    auto:6,
	    resume:true,
	    navid:'pagination',
	    activeclass:'current',
	    visible:true,
	    position:0
      });
  </script>
  <!-- SLIDER.End -->
  
  <!-- BANNERS -->
   <ul class="banners">
     <li><a id="register" href="quest.php?name=register"></a></li>
     <li><a id="vote" href="quest.php?name=votesites"></a></li>
     <li><a id="donate" href="quest_ac.php?name=Donate_with_PayPal_now!"></a></li>
   </ul>
  <!-- BANNERS.END -->

</div>


<td id="main_side">
{account_warnning}
  <!--<ul class="index_player_nav">
   <li id="dw"><a href="#"></a></li>
   <li id="ts"><a href="#"></a></li>
   <li id="re"><a href="#"></a></li>
  </ul>-->
{vote_links}
<div class="post">
 <ul class="help_nav">
   <li><a id="dp" href="#"></a></li>
   <li><a id="dc" href="http://torrents.thepiratebay.org/5897534/World_of_Warcraft_-_3.3.5a_(12340)_-_enUS_(No_Install).5897534.TPB.torrent"></a></li>
   <li><a id="db" href="#"></a></li>
 </ul>
</div>
{news_content}
</td>
<td class="sidebar">
{sidebar_content}
</td>