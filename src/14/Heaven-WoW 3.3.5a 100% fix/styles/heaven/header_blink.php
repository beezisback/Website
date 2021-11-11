<?php exit; ?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="./favicon.ico">
<title>{title}</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="res/javascript.js"></script>
<script type="text/javascript" src="res/power/power.js"></script>
<script type="text/javascript" src="js/tinyfader.js"></script>
<link href="res/power/power.css" rel="stylesheet" type="text/css">
{stylesheet}
<!--not used variable: [sitetitle] -->
<!--[if IE]>
<link href="res/style_ie.css" rel="stylesheet" type="text/css" />
<link href="res/power/power_ie.css" rel="stylesheet" type="text/css">
<![endif]-->
<script type="text/javascript" src="js/shoutbox.js"></script>
<script type="text/javascript" src="js/toparena.js"></script>
<script type="text/javascript" src="js/onebip.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<style type="text/css" title="currentStyle">
	@import "js/dataTables/table.css";
</style>
<script type="text/javascript" charset="utf-8">
$(document).ready(function()
{

	$('#Onebip-DataTable').dataTable(
	{
		"aaSorting": [[3,'desc'], [5,'desc']],
	});

      $('#Tickets-DataTable').dataTable(
	{
			aaSorting: [[0,'asc']],
			aoColumnDefs: [{ bSortable: false, aTargets: [3]}],
	});

});

</script>

<script>
var RealmsTimers = new Array();

function overdrinfo_show(obj)
{
	var $this = $(obj);
	var realmid = $this.find('.realm-st-head .r_status span').attr('id');
	
	if ($this.attr('js-animation') == '0'  || typeof $this.attr('js-animation') == 'undefined')
 	{
   		// SlideToggle
  		$this.attr('js-animation', '1');
		$this.find('.realm-st-info').slideDown('fast', function()
  		{
   			$this.attr('js-animation', '0');
  		});
 	}
	if (typeof RealmsTimers[realmid] != 'undefined')
	{
		console.log('Clearing timeouts on realm: ' + realmid);
		clearTimeout(RealmsTimers[realmid]);
	}
}
function overdrinfo_hide(obj)
{
	var $this = $(obj);
	var realmid = $this.find('.realm-st-head .r_status span').attr('id');

	if (typeof RealmsTimers[realmid] != 'undefined')
	{
		console.log('Clearing timeouts on realm: ' + realmid);
		clearTimeout(RealmsTimers[realmid]);
	}
	
	RealmsTimers[realmid] = setTimeout(function(){ overdrinfo_hide2(obj); }, 2000);
}
function overdrinfo_hide2(obj)
{
	var $this = $(obj);
	
 	if ($this.attr('js-animation') == '0')
 	{  
 		// SlideToggle
  		$this.attr('js-animation', '1');
   		$this.find('.realm-st-info').slideUp('fast', function()
  		{
  	 		$this.attr('js-animation', '0');
  		});
 	}
}
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

<center>
<div id="container">

<div id="blink" style="margin:125px auto -230px -9px;">
<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" WIDTH="953" HEIGHT="100" CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=5,0,0,0">
	<PARAM NAME="MOVIE" VALUE="1.swf">
	<PARAM NAME="PLAY" VALUE="true">
	<PARAM NAME="LOOP" VALUE="true">
	<PARAM NAME="QUALITY" VALUE="high">
	<PARAM NAME="SCALE" value="noborder">
	<EMBED SRC="./styles/default/new_images/1.swf" WIDTH="953" HEIGHT="100" PLAY="true" LOOP="true" QUALITY="high" scale="noborder"PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED>
</OBJECT></div>

<div id="header">
      <div class="menu" align="left">
       <ul>
          <li>
          <a href="./">Home</a>
          </li>
		  <!-- if(link_guest) -->
          <li>
		  <a href="{linkpath}">{title}</a>
          </li>
		  <!-- else(link_guest) -->	
		  <!-- endif(link_guest) -->
				  
		  <!-- if(link_loggedin) -->
          <li>
		  <a href="{linkpath2}" >{title2}</a>
          </li>
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
         </ul>
         
         <div class="memb_login_logout">
          {loginAndLogout}
         </div>
         
       </div>
       
</div>
<div class="body_holder">

<div class="social_icons">
 <ul>
  <li><a id="fb" href="http://www.facebook.com/pages/Heaven-Wow/220072824722615"></a></li>
  <li><a id="tw" href="https://twitter.com/#!/Heavenwow335a"></a></li>
  <li><a id="yt" href="http://www.youtube.com/watch?feature=endscreen&NR=1&v=hdsmBBpJDlI"></a></li>
 </ul>
</div>

<div id="content">
  <table class="content" cellpadding="0" cellspacing="0">
	<tbody>

<meta name="websafedir" content="Claimed">