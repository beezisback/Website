<?php exit; ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./favicon.ico">
<title>{title}</title>

<script type="text/javascript" src="res/javascript.js"></script>

<script type="text/javascript" src="res/power/power.js"></script>

<script type="text/javascript">

  (function() {

    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;

    po.src = 'https://apis.google.com/js/plusone.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);

  })();

</script>

<link type="text/css" href="css/site-forum.css" rel="stylesheet">
<link href="css/style_2_en.css" rel="stylesheet" type="text/css" media="screen, projection">


<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="shoutbox.js"></script>
<link href="res/power/power.css" rel="stylesheet" type="text/css">

<link href="styles/default/css/style.css" rel="stylesheet" type="text/css">

<link href="styles/default/css/char.css" rel="stylesheet" type="text/css">

<link href="css/gameguide.css" rel="stylesheet" type="text/css">

<link href="styles/default/css/slider.css" rel="stylesheet" type="text/css">
<!--not used variable: [sitetitle] -->
<!--[if IE]>
<link href="res/style_ie.css" rel="stylesheet" type="text/css" />
<link href="res/power/power_ie.css" rel="stylesheet" type="text/css">
<![endif]-->
<script type="text/javascript" src="js/swfobject/swfobject.js"></script>
<script type="text/javascript" src="js/rhinoslider-1.05.min.js"></script>

<script type="text/javascript">
		$(document).ready(function() {
		$('#slideshow').rhinoslider({
			effect: 'fade',
			showTime: 5000,
			controlsMousewheel: false,
			controlsKeyboard: false,
			controlsPrevNext: false,
			controlsPlayPause: false,
			autoPlay: true,
			pauseOnHover: false,
			showBullets: 'never',
			changeBullets: 'before'
		});
		});
		</script>

<script type="text/javascript">



function getInternetExplorerVersion()
// Returns the version of Internet Explorer or a -1
// (indicating the use of another browser).
{
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function createCookie(name,value,min) {
	if (min) {
		var date = new Date();
		date.setTime(date.getTime()+(min*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}


window.onload = function vote_popup() {

	// w00t w00t HAX!
	var ver = getInternetExplorerVersion();
	if(navigator.appName == 'Microsoft Internet Explorer' && ver < 7.0)
	{
	return;
	}

	voted = readCookie('voted');

	if (voted == null) {
		document.getElementById('vote_popup').style.display = "block";
	}

}

function hide_vote_popup() {
	createCookie('voted','yes','10');
	document.getElementById('vote_popup').style.display = "none";
	document.getElementById('vote_popup').innerHTML = "";
};
</script>
</head><body>



<div align="center">

	<div id="container">



		<div id="header">

			<div class="menu">

		  	 	<ul class="clearfix">

		    		<li><a id="home" href="./"><p></p><span></span></a></li>

		       		<li><a id="forums" href=""><p></p><span></span></a></li>		 

			    	<li><a id="connection" href="quest.php?name=connection"><p></p><span></span></a></li>

                	<li><a id="logo" href="./"></a></li>

		  <!-- if(link_guest) -->
		  <li><a id="register" href="quest.php?name=register"><p></p><span></span></a></li>
		   <li><a id="gameplay" href="#"><p></p><span></span></a></li>
		  <li><a id="login" href="quest.php?name=login"><p></p><span></span></a></li>

		  <!-- else(link_guest) -->	
		  <!-- endif(link_guest) -->
		  
		  
		 
				  
		  <!-- if(link_loggedin) -->
	          <li><a id="account" href="quest.php?name=account"><p></p><span></span></a></li>
			   <li><a id="gameplay" href="#"><p></p><span></span></a></li>
			  <li><a id="logout" href="{linkpath2}"><p></p><span></span></a></li>
		  <!-- else(link_loggedin) -->
		  <!-- endif(link_loggedin) -->
		  
		  
					  
		  <!-- if(link_custom) -->
		  
          <li>
		  <a href="{linkpath}" >{title}</a>
          </li>
		  
		  <!-- else(link_custom) -->
		  <!-- endif(link_custom) -->
			
		  <!-- if(link_custom2) -->
          <li>
		  
		  <a href="{linkpath}" >{title}</a>
          </li>
		  <!-- else(link_custom2) -->
		  <!-- endif(link_custom2) -->
         <ul>
		 
       </div>
     </td>
  </tr>
</div>

<div id="content">
  <table class="content" cellpadding="0" cellspacing="0">
	<tbody><tr>
       <!--<td valign="top">
       <div class="slider">
       <div id="cu3er-container">
       <a href="http://www.adobe.com/go/getflashplayer">
        <img style="border:none;" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="." />
       </a>
       </div></div>
	   </td></tr>-->
    <tr>	