<?php exit; ?>

<!-- if(sidebar_guest) -->



<div class="sidebar-container">

	<a class="banner box-shadow" id="register" href="quest.php?name=register"></a>

</div>


 </ul>

</div>

<div class="side-r">



	<div class="sidebar-container membersip_a box-shadow-inset box">

		<div class="mems-b-head">

        	<p id="login-text"></p>

        </div>

	  	<div class="mem-b-cont">

	  		<form action="quest.php?name=login" method="post" name="login_form">

            	<div class="username-container clearfix">

                	<label>

	  					<input autocomplete="off" type="text" id="username" maxlength="32" name="username" class="loginbox_username" />

                    	<div id="label"></div>

                   	</label>

                </div>

                <div class="password-container clearfix">

               		<label>

	  					<input type="password" id="password" name="password" class="loginbox_password"  />

                    	<div id="label"></div>

                   	</label>

                </div>

	  		

                <input type="hidden" name="action" value="Login" />

                <div class="clearfix">

                	<input style="display:block;float:left;" type="submit" value="Login" />

                    <div class="quick-links" align="right">

                    	<p><a href="quest.php?name=gimmepass">Retrieve Password</a></p>

                        <p><a href="quest.php?name=register">Create new Account</a></p>

                    </div>

                </div>

	 		</form>

	 	</div>

	 	<div class="mems-b-down"></div>

	</div>

<!-- else(sidebar_guest) -->	
<!-- endif(sidebar_guest) -->

<!-- if(sidebar_loggedin) -->




<div class="sidebar-container membersip_b box-shadow-inset box">

	<div class="mems-b-head">

    	<p id="membership-text"></p>

    </div>

  	<div class="mem-b-cont text-shadow">

    	<div style="padding: 5px 15px 15px 5px">

		  	Username: <strong><font color="#5b5851">{username}</font></strong><br /><br />

		  	Donation Points: <font color="#6f5933">{gm}</font><br />

		 	Vote Points: <font color="#6f5933">{vp}</font><br />
			
            Banned: {banned}</font><a href="./quest.php?name=passchange">&raquo; Change pass now!</a>
            <div class="acc-p-b"><a href="quest.php?name=account">&raquo; Account Panel</a></div>
</div>
</div>
<div class="mems-b-down"></div>
</div>
<!-- else(sidebar_loggedin) -->	
<!-- endif(sidebar_loggedin) -->

<div class="realmlist sidebar-container box-shadow-inset box">

	<center>set realmlist <font color="#43500d">logon.heavenwow.info</font></center>

</div>



<div class="realms-status">

<!--<strong>[<a href="./quest.php?name=status" title="">Online Players</a>]</strong>-->
 <div class="a-realm sidebar-container box-shadow">

    	<div id="head" class="clearfix text-shadow">

        	<p id="name">{s1name} {online1}</p>

        <p id="info">12x Rates</p>

        </div>

    	<div id="body" class="clearfix text-shadow">  
<div class="r_status"><span id='server'></span></div>
         	<p id="online"><font color="#d28010">1643</font> Players Online</p>

        	<p id="uptime"><font color="#5b5851">12h 40m</font> Uptime</p>

    	</div>

    </div>


<!-- if(server2and3) -->
<div class="realm-st">
  <div class="r-st-up"> {s2name} {online2} </div>
  <div class="r-st-d">  
    <div class="idk"> Online: <font color="#ffe62c">{totcharacters2}</font> </div> 
    Uptime: <font color="#ffe62c">{uptime2}</font> 
  </div>
</div>     
<!-- else(server2and3) -->	
<!-- endif(server2and3) -->


 </div></center>
 <div >

<div class="sidebar-container">

	<a class="banner box-shadow" id="teamspeak" href="#" target="_blank"></a>

</div>

<div class="sidebar-container">

	<a class="banner box-shadow" id="donate" href="quest_ac.php?name=Donate_with_PayPal" target="_blank"></a>

</div>

<div class="sidebar-container">

	<a class="banner box-shadow" id="donate-sms" href="quest.php?name=donate_sms" target="_blank"></a>

</div>

<div>



<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/bg_BG/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box" data-href="http://www.facebook.com/Csprobg.info" data-width="286" data-colorscheme="dark" data-show-faces="false" data-border-color="green" data-stream="true" data-header="true"></div>


<g:plusone size="medium" annotation="inline" width="280"></g:plusone>

<script type="text/javascript" src="http://widgets.amung.us/small.js"></script><script type="text/javascript">WAU_small('s8tuq0a5nxrn')</script>


<!-- Donation GOAL -->
<!--   <div class="donation_goal">    -->
<!--   <div class="d_goal_title">DONATION GOAL</div>    -->
<!--   <div class="d_goal_content">    -->
          <!--Put SCALE here-->
<!--   </div>    -->
<!--   </div>    -->
<!--Donation GOAL-END-->

<!--<div class="shout_box">-->
 <!-- {shoutbox}-->
  <!-- <div class="content">	-->
  <!-- <ul>-->
  <!-- </ul>-->
  <!-- </div>-->
<!--</div>-->



</div>