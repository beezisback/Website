<?php exit; ?> 
<div class="side-r">
<!-- if(sidebar_guest) -->
<div class="sidebar_box" style="display:none;">
<div class="sidebar_box_head"><p>MEMBERSHIP</p><span></span></div>
  <div class="sidebar_box_cont membership">
  <form action="quest.php?name=login" method="post" name="login_form">
  <input type="text" id="username" maxlength="20" name="username" class="loginbox_username" />
  <input type="password" id="password" maxlength="20" name="password" class="loginbox_password"  />
  <input type="hidden" name="action" value="Login" />
  <table cellpadding="2" cellspacing="2"><tr>
  <td valign="top" style=" text-align:right">
  <div id="log-b"><input type="submit" value="Login" /></div>
  </td>
  <td valign="top" id="links">
  <a href="quest.php?name=gimmepass">Forgot password?</a>
  <a href="quest.php?name=register">Create new Account</a>
  </td>
  </tr></table>
 </form>
 </div>
</div>
<!-- else(sidebar_guest) -->	
<!-- endif(sidebar_guest) -->

<!-- if(sidebar_loggedin) -->
<div class="sidebar_box">
<div class="sidebar_box_head"><p>MEMBERSHIP</p><span></span></div>
  <div class="sidebar_box_cont membership">
  Username: <strong><font color="#696969"> {username} </font></strong><br /><br />
  Donation Points: {gm}<br />
  Vote Points: {vp}<br />
  Banned: {banned}<br />
  <div class="acc-p-b"><a href="quest.php?name=account">&raquo; Account Panel</a></div>		
  </div>
  <a class="donate_via_sms" href="quest.php?name=donate_sms"></a>
</div>
<!-- else(sidebar_loggedin) -->	
<!-- endif(sidebar_loggedin) -->

<!--<strong>[<a href="./quest.php?name=status" title="">Online Players</a>]</strong>-->  
	
<!-- if(realms) -->
<div class="realm-st" onmouseover="overdrinfo_show(this)" onmouseout="overdrinfo_hide(this)">
  <div class="realm-st-head">
   <div class="r_status">{online1}</div>
   <div class="r_name_desc">
     <span>{s1name}</span>
     <p>{realm_description}</p>
   </div>
  </div>
  <div class="realm-st-info">
     <p><font color="#b69755">{totcharacters}</font> Online Players, <font color="#b69755">{gmCount}</font> Online GMs</p>
     <div class="seperator-r"></div>
     <font color="#555352">{AllianceCount}</font> Alliance and <font color="#555352">{HordeCount}</font> Horde Characters<br/>
     Realm is up from <font color="#555352">{uptime}</font>
  </div>
</div>
<!-- else(realms) -->	
<!-- endif(realms) -->

<div class="sidebar_box">
  <div class="sidebar_box_cont">
  <center> SET REALMLIST <font color="#C99924">HEAVENWOW.COM</font> </center>
</div>
</div>

<div class="sidebar_box">
  <div class="sidebar_box_cont">
  <center> DOWNLOAD:<a href="http://heavenwow.com/wotlk/downloads/patches/data.rar">
  <font color="#C99924">ALL RACE ALL CLASS PATCH</font></a></center>
</div>
</div>

<!-- Arena Stats -->
	<!-- if(TopArena) -->
		{HTML}
	<!-- else(TopArena) -->	
	<!-- endif(TopArena) -->
<!-- Arena Stats.End -->

<div class="shout_box">
  {shoutbox}
   <div class="shout_box_content">	
   <ul>
   </ul>
   </div>
</div>

<div class="sidebar_box">
  <div class="sidebar_box_head"><p>RANDOM INFO</p><span></span></div>
  <div class="sidebar_box_cont info">
   	<div align="center">
   	<strong>Enjoy at HEAVEN WOW !!</strong><br><br>
	Earn 3 Vote Points at 1st 5 Days Every Month for ExtremeTop !!
	</div>
   </div>
</div>


<div class="sidebar_box">
  <div class="sidebar_box_head"><p>VENTRILO SERVER</p><span></span></div>
  <div class="sidebar_box_cont info">
   	<div>
	<center>
	<strong>How to use:</strong><br><br>
	</center>
	<div style="padding-left: 30px; padding-right: 30px;">
	<strong>1.</strong> Install Ventrilo Client from http://www.ventrilo.com/download.php<br>
	<strong>2.</strong> Open Ventrilo<br>
	<strong>3.</strong> Create your User Name<br>
	<strong>4.</strong> Our info: IP: 69.65.43.91 and Port Number: 4174<br>
	<strong>5.</strong> Click Connect.<br>
	</div>
	</div>
   </div>
</div>                        

<div class="sidebar_box">
  <div class="sidebar_box_head"><p>SERVER TIME</p><span></span></div>
  <div class="sidebar_box_cont info">
   	<div>
	<center>
		<div class="freesecure">
		<iframe src="http://free.timeanddate.com/clock/i3v719gb/n238/szw110/szh110/hocddd/hbw0/hfc000/cf100/hgr0/fav0/fiv0/mqcfff/mql15/mqw8/mqd100/mhcfff/mhl15/mhw4/mhd100/mmv0/hhcff9/hmcff9" frameborder="0" width="112" height="112"></iframe>	</div>
	</center>
	</div>
  </div>
</div>

<!--<div class="sidebar_box">
  <div class="sidebar_box_head"><p>FACEBOOK</p><span></span></div>
  <div class="sidebar_box_cont info">
<div>
<center><iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fblackheaven123&amp;width=292&amp;height=558&amp;colorscheme=dark&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:558px;" allowTransparency="true"></iframe></center>
</div>              
</div>-->
	
<!-- Donation GOAL -->
<!--   <div class="donation_goal">    -->
<!--   <div class="d_goal_title">DONATION GOAL</div>    -->
<!--   <div class="d_goal_content">    -->
          <!--Put SCALE here-->
<!--   </div>    -->
<!--   </div>    -->
<!--Donation GOAL-END-->

