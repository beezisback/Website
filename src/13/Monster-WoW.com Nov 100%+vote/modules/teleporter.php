<script type="text/javascript" language="javascript" src="script/molten.js"></script>
<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="script/jquery.cycle.lite.js"></script>
<div class="page"><script type="text/javascript" language="javascript" src="script/dropdown/js/jquery.dd.js"></script>
<link rel="stylesheet" type="text/css" href="script/dropdown/dropdown.css" />
<script type="text/javascript">
var loading = true;
var web = "https://www.molten-wow.com/";
var versionType = "2";
var realm = "6";
var realms = [
	[0, 'a', 'NELTHARION', 3],
	[1, 'b', 'DEATHWING', 2],
	[2, 'g', 'SARGERAS', 3],
	[3, 'd', 'FROSTWOLF', 3],
	[4, 'e', 'WARSONG', 3],
	[5, 'z', 'LORDAERON', 2],
	[6, 'et', 'RAGNAROS', 2]
];
var par = 0;
var pars = [
    [0, 'p', 'DONATE'],
    [1, 'v', 'VOTE'],
    [2, 't', 'TOOLS']
];
var child = [0, 0];
var slide = 0;
var children = {
    'p': {
        0: [
            [0, 'd', 'DONATE'],
			[1, 'le', 'LEVEL UP'],
            /*[2, 'i', 'ITEMS'],*/
            [2, 'rt', 'TRANSFER'],
			[3, 'fc', 'FACTION CHANGE']
        ],
        1: [
			/*[0, 'is', 'ARMOR SETS'],*/
			[0, 'rc', 'RACE CHANGE'],
			[1, 're', 'RECUSTOMIZATION']
        ]
    },
    'v': {
        0: [
            [0, 'v', 'VOTE'],
            /*[1, 'i', 'ITEMS'],*/
			[1, 'rt', 'TRANSFER'],
			[2, 'fc', 'FACTION CHANGE'],
            [3, 'nc', 'NAME CHANGE']
        ]
    },
    't': {
        0: [
			[0, 'lo', 'LOTTERY'],
            [1, 'te', 'UNSTUCK'],
			[2, 'cr', 'RESTORATION'],
            [3, 'st', 'SETTINGS'],
			[4, 'hi', 'HISTORY']
        ]
    }
};
var init = true;
var panchor = null;
var miscv = 0;

function ds(id) {
    return document.getElementById(id);
}
function rm(c) {
    if (c.className != undefined) {
        c.className = c.className.replace(/\bactive\b /, '')
    }
}
function IsNumeric(input) {
    var RE = /^-{0,1}\d*\.{0,1}\d+$/;
    return (RE.test(input))
}
function loadStart(state) {
    if (state) {
        loading = true;
    }
    if (!state) {
        loading = false;
    }
}
function loadFailure() {
    
}
function parseScript(_source) {
    var source = _source;
    var scripts = new Array();
    while (source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
        var s = source.indexOf("<script");
        var s_e = source.indexOf(">", s);
        var e = source.indexOf("</script", s);
        var e_e = source.indexOf(">", e);
        scripts.push(source.substring(s_e + 1, e));
        source = source.substring(0, s) + source.substring(e_e + 1)
    }
    for (var i = 0; i < scripts.length; i++) {
        try {
            var oScript = document.createElement('script');
            oScript.text = scripts[i];
            document.getElementById("pageWrap").appendChild(oScript)
        } catch (ex) {
            alert(ex)
        }
    }
    return source
}
function loadPage() {
    if (loading && init || !loading) {
        if (child[1] != -1) {
            panchor = realms[realm][0] + ':' + pars[par][0] + ':' + slide + ':' + children[pars[par][1]][slide][child[1]][1] + ':' + miscv;
            var q = '/' + panchor + '/';
            loadStart(true);
            $("#noteTop").html("");
			document.onkeypress = handleEnter;
            var pg = $.get("/account/pg" + q, function (data) {}).success(function (data) {
                var c = data.split(">>");
                if (c[0] == "SUCCESS") {
                    $("#pageWrap").html("<br />" + parseScript(c[1]) + "<br />");
                } else {
                    $("#pageWrap").html("<br /><br />");
                    if (c[1] == undefined) {
                        window.location.href = web
                    } else {
                       alert(c[1]);
                    }
                }
            }).error(function () {
                loadStart(false)
            }).complete(function () {
                loadStart(false);
                reSetup()
            })
        } else {
            $("#pageWrap").html("<br /><br />")
        }
        init = false
    } else {
        loadFailure()
    }
}
function updateCurrency() {
    $.get("/account/cur/", function (data) {}).success(function (data) {
        if (data.length <= 7) {
            var d = data.split(":");
            $("#accCoins").html(d[0]);
            $("#accPoints").html(d[1])
        }
    }).error(function () {}).complete(function () {})
}
function reSetup() {
    if (child[1] != -1) {
        var t = children[pars[par][1]][slide][child[1]][1];
        if (t == 'i' || 'is' || 'd' || 'fc') {
            $("#pageWrap select").msDropDown()
        }
    }
}
function versionSet(id){
	if(id == versionType){
		return;
	}
	$("#v2").removeClass("active");
	$("#vW2").removeClass("active");
	$("#v3").removeClass("active");
	$("#vW3").removeClass("active");
	$("#v"+id).addClass("active");
	$("#vW"+id).addClass("active");
	var arLen = realms.length;
	for (var i = 0, len = arLen; i < len; ++i) {
		if(realms[i][3] == id){
			$("#rW"+realms[i][0]).show();
		}else{
			$("#rW"+realms[i][0]).hide();
		}
	}
	versionType = id;
}
			
	
function rSelect(id) {
    var ol = realm;
    if (id != realm || realm == 0 || loading) {
		$("#r"+realm).removeClass("active");
		$("#rW"+realm).removeClass("active");
		$("#r"+id).addClass("active");
		$("#rW"+id).addClass("active");
        realm = id;
        if (!init) {
            if (id != ol) {
                loadPage()
            }
        }
    }
}
function pSelect(id) {
    var ol = par;
    if (id != par|| loading) {
		$("#p"+par).removeClass("active");
		$("#pW"+par).removeClass("active");
		$("#p"+id).addClass("active");
		$("#pW"+id).addClass("active");
        par = id;
        if (!init) {
            if (id != ol) {
                slide = 0;
                child = [0, 0];
                genChildList("cBtns");
				checkArrows();
                loadPage()
            }
        }
    }
}
function cSelect(id, change) {
    var ol = child[1];
    if (child[1] > -1) {
		$("#cW"+child[1]).removeClass("active");
		$("#cW"+id).addClass("active");
    }
    child = [slide, id];
    if (!init) {
        if (id != ol) {
            loadPage()
        }
    }
}
function genRealmList(c) {
    var d = "";
	var g = "";
    $("#"+c).html("");
    var arLen = realms.length;
	var sorting = [5,1,6,3,0,2,4];
    for (var i = 0, len = arLen; i < len; ++i) {
		if(i==0){
			g = "style='margin-left:-1px;'";
		}
		if(i==3){
			g = "margin-left:-1px;";
		}

		if(realms[sorting[i]][3] == versionType){
        	d += "<div class=\"rTabWrap\" "+g+" id=\"rW" + realms[sorting[i]][0] + "\"><div class=\"rTab\" id=\"r" + realms[sorting[i]][0] + "\"><p>"+realms[sorting[i]][2]+"</p></div></div>";
		}else{
			d += "<div class=\"rTabWrap\" style=\"display:none;"+g+"\" id=\"rW" + realms[sorting[i]][0] + "\"><div class=\"rTab\" id=\"r" + realms[sorting[i]][0] + "\"><p>"+realms[sorting[i]][2]+"</p></div></div>";
		}
		g = "";
    }
	$("#"+c).html(d);
    rSelect(realm)
}
function genParList(c) {
	var d = "";
    $("#"+c).html("");
    var arLen = pars.length;
    for (var i = 0, len = arLen; i < len; ++i) {
        d += "<div class=\"pTabWrap\" id=\"pW" + pars[i][0] + "\"><div class=\"pTab\" id=\"p" + pars[i][0] + "\"><p>"+pars[i][2]+"</p></div></div>"
    }
	$("#"+c).html(d);
    pSelect(par)
}
function genChildList(c) {
    var gp = pars[par][1];
    if (children[gp][slide] != undefined) {
        var arLen = children[gp][slide].length;
        var d = "<ul>";
        $("#"+c).html("");
        var cs = 100000;
        for (var i = 0, len = arLen; i < len; ++i) {
            cs = cs - 1;
			if(i == 0){

			}else{
				d += "<li class=\"square\">&nbsp;&nbsp;</li>";
			}
            d += "<li id=\"c" + children[gp][slide][i][0] + "\" class=\"dc\"><a href=\"javascript:void(0);\" id=\"cW" + children[gp][slide][i][0] + "\" class=\"\">"+children[gp][slide][i][2]+"</a></li>"
        }
        d += "</ul>";
        $("#"+c).html(d);
        cSelect(child[1], true)
    }
}
function checkArrows() {
	var gp = pars[par][1];
    var ns = Number(slide) - Number(1);
	var na = Number(slide) + Number(1);
	var la = ds("lArr");
	var ra = ds("rArr");

	if(children[gp][ns] != undefined) {
		$("#lArr").addClass("active");
    }else{
		$("#lArr").removeClass("active");
	}
	
	if(children[gp][na] != undefined) {
		$("#rArr").addClass("active");
    }else{
		$("#rArr").removeClass("active");
	}
}

var currentp = null;

function deURL(c) {
    if (c.length > 8) {

        var e = c.split('#');
        var s = e[1].split(':');
        if (IsNumeric(s[0])) {
            if (realms[s[0]] != undefined) {
                var pass1 = true;
                if (IsNumeric(s[1])) {
                    if (pars[s[1]] != undefined) {
                        var pass2 = true;
                        if (IsNumeric(s[2]) && IsNumeric(s[3])) {
                            if (children[pars[s[1]][1]][s[2]] != undefined) {
                                var pass3 = true;
                                if (children[pars[s[1]][1]][s[2]][s[3]] != undefined) {
                                    var pass4 = true
                                }
                            }
                        }
                    }
                }
            }
        }
        if (pass1 && pass2 && pass3 && pass4) {
			$("#r"+realm).removeClass("active");
			$("#rW"+realm).removeClass("active");
			realm = s[0];
			$("#r"+realm).addClass("active");
			$("#rW"+realm).addClass("active");
			$("#p"+par).removeClass("active");
			$("#pW"+par).removeClass("active");
			par = s[1];
			$("#p"+par).addClass("active");
			$("#pW"+par).addClass("active");
            slide = s[2];
            child = [s[2], s[3]];
            miscv = s[5];
            genChildList("cBtns");
			checkArrows();
			versionSet(realms[realm][3]);
            window.location = "/account/#self";
            return true
        }
    }
    return false
}

function handleEnter(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13)) {
        return false;
    }
}
function handleEnterItems(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13)) {
        return validateSearchItem();
    }
}
function checkAnchor() {
    if (!loading) {
        if (currentp != document.location.hash) {
            currentp = document.location.hash;
            if (currentp) {
                if (deURL(currentp)) {
                    loadPage();
                    miscv = 0;
                }
            }
        }
    }
}
$(document).ready(function () {
	versionSet(realms[realm][3]);
    genRealmList("rBtns");
    genParList("pBtns");
    genChildList("cBtns");
	checkArrows();
    loadPage();
    setInterval("checkAnchor()", 200);
	
	$("div.vTab").hover(function () {
    }).click(function () {
		if (!loading) {
            var id = this.id[1];
            versionSet(id);
            if (id == 2) {
                window.location = '/account/#1:' + par + ':' + slide + ':' + child[1] + ':0';
            } else {
                window.location = '/account/#0:' + par + ':' + slide + ':' + child[1] + ':0';
            }
        } else {
            loadFailure();
        }
    });
	
    $("div.rTab").hover(function () {

    }).click(function () {
        if (!loading) {
            var id = this.id[1];
            rSelect(id);
        } else {
            loadFailure();
        }
    });
    $("div.pTab").hover(function () {

    }).click(function () {
        if (!loading) {
            var id = this.id[1];
            pSelect(id);
        } else {
            loadFailure();
        }
    });
    $("div#cBtns li.dc").live('hover', function () {
        if (child[1] != -1) {

        }
    }).live('mouseleave', function () {
        if (child[1] != -1) {
			$("#cW"+child[1]).addClass("active");
        }
    }).live('click', function () {
        if (!loading) {
            var id = this.id[1];
            cSelect(id);
        } else {
            loadFailure();
        }
    });
    $("div.rArr").live('click', function () {
        if (!loading) {
            var gp = pars[par][1];
            var ns = Number(slide) + Number(1);
            if (slide < 3 && children[gp][ns] != undefined) {
                slide = ns;
                child = [slide, -1];
                genChildList("cBtns");
				checkArrows();
            }
        } else {
            loadFailure();
        }
    });
    $("div.lArr").live('click', function () {
        if (!loading) {
            var gp = pars[par][1];
            var ns = Number(slide) - Number(1);
            if (slide > 0 && children[gp][ns] != undefined) {
                slide = ns;
                child = [slide, -1];
                genChildList("cBtns");
				checkArrows();
            }
        } else {
            loadFailure();
        }
    });
});
</script>



<?php
if (!defined('AXE'))
	exit;

if (!isset($_SESSION['user'])) 
{
	print "You are not logged in."; $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include



if(isset($_POST['submit']))
{
	$guid1 = explode ('-',preg_replace( "/[^0-9-]/", "", $_POST['char'] ));
	$guid	 = $guid1[0];
	$realmid = $guid1[1];
	$i=1;
	while ($i<=count($realm))
	{
		if ($realmid==$i)
		{
			$db->select_db($realm[$i]['db']);
		}
	
		$i++;
	}
 
	$acct = "";							//acct id from db
	$race = "";							//characters race id
    $level = "";                        //Character Level


	$location = preg_replace( "/[^0-9]/", "", $_POST['location'] );

	$query = "SELECT ".$db_translation['characters_race'].", ".$db_translation['characters_level'].", ".$db_translation['characters_gold']." FROM ".$db_translation['characters']." WHERE  ".$db_translation['characters_guid']." = '".$guid."' AND ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."'";
	
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);

	if ($numrows == 0)
	{
		box('Failure',"<center>That character does not exist on your account.</center>");
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
	}

	$row = mysql_fetch_array($result);
	$race = $row[0];
    $level = $row[1];

	if($row[2] < $module_teleporter_gold)
	{
		box('Failure',"<center>Your character does not have enough gold to be teleported. (".$row[2].")</center>");
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
	}
	$gold = $row[2];
	

	$map = "";
	$x = "";
	$y = "";
	$z = "";
	$place = "";

	switch($location)
	{
		//stormwind
		case 1:
			$map = "0";
			$x = "-8913.23";
			$y = "554.633";
			$z = "93.7944";
			$place = "Stormwind City";
			break;
		//ironforge
		case 2:
			$map = "0";
			$x = "-4981.25";
			$y = "-881.542";
			$z = "501.66";
			$place = "Ironforge";
			break;
		//darnassus
		case 3:
			$map = "1";
			$x = "9951.52";
			$y = "2280.32";
			$z = "1341.39";
			$place = "Darnassus";
			break;
		//exodar
		case 4:
			$map = "530";
			$x = "-3987.29";
			$y = "-11846.6";
			$z = "-2.01903";
			$place = "The Exodar";
			break;
		//orgrimmar
		case 5:
			$map = "1";
			$x = "1676.21";
			$y = "-4315.29";
			$z = "61.5293";
			$place = "Orgrimmar";
			break;
		//thunderbluff
		case 6:
			$map = "1";
			$x = "-1196.22";
			$y = "29.0941";
			$z = "176.949";
			$place = "Thunder Bluff";
			break;
		//undercity
		case 7:
			$map = "0";
			$x = "1586.48";
			$y = "239.562";
			$z = "-52.149";
			$place = "The Undercity";
			break;
		//silvermoon
		case 8:
			$map = "530";
			$x = "9473.03";
			$y = "-7279.67";
			$z = "14.2285";
			$place = "Silvermoon City";
			break;
		//shattrath
		case 9:
			$map = "530";
			$x = "-1863.03";
			$y = "4998.05";
			$z = "-21.1847";
			$place = "Shattrath";
			break;
		//for unknowness -> shattrath
		default:
			box('Failure',"<center>That is an invalid location.</center>");
			break;
	}

	//disallows factions to use enemy portals
	switch($race)
	{
		//alliance
		case 1:
		case 3:
		case 4:
		case 7:
		case 11:
			if((($location >=5) && ($location <=8)) && ($location != 9))
			{
				box('Failure',"<center>Alliance players may not be teleported to horde areas.<br><br></center>");
				$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
			}
			break;
		//horde
		case 2:
		case 5:
		case 6:
		case 8:
		case 10:
			if ((($location >=1) && ($location <=4)) && ($location != 9))
			{
				box('Failure',"<center>Horde players may not be teleported to alliance areas.<br><br></center>");
				$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
			}
			break;
		default:
			die("<center>The selected race is not valid.<br><br></center>");
			break;
	}

    if($level < 58 && $location == 9)
    {
    	box('Failure',"<center>This location requires you to be at least level 58.</center>");
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
    }

	$newGold = $gold - (module_teleporter_gold);

	$tele_p=teleport($guid,$x,$y,$z,$map,$newGold);//returns
	if ($tele_p)
	{
		$cont2=$tele_p;
	}
	else
	{
		$cont2.= "<center>You are entering a Goblin Transporter Machine...<br><br></center>";
		$cont2.= "<center>Your character has been teleported to ".$place.".<br></center>";
	}
	

	$cont2.= "</td></tr>";
	
}
else
{
    
	$cont2= "<center><div class='voteshop1'>
 <div class='account-navigation box-shadow-inset clearfix'>
<div id='left'>
<p id='title'>CHARACTERS TELEPORT</p>
</div>
<div id='right'>
<a href='./quest.php?name=account'>Back to Account</a>
</div>
</div>

	         <form name='myform' method='post' action='./quest.php?name=teleporter'>";
    $cont2.= "$lan[TELEPORTER]<br/>";
	//***START DROPDOWN****(c)axe
	$user=$a_user[$db_translation['login']];
	$db->select_db($acc_db);
	$SQLwow ="SELECT * from ".$db_translation['accounts']." where ".$db_translation['login']."='".$db->escape($a_user[$db_translation['login']])."'";
	$SQLwow2=mysql_query($SQLwow) or die("Could not get user character information".mysql_error());
	$SQLwow3=mysql_fetch_array($SQLwow2);
	$cont2.= "<center><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$cont2.= "<div id='pageWrap'><select name='char' id='charname' style='width:200px;'>";
	$i=1;
	while ($i<=count($realm))
	{
		$db->select_db($realm[$i]['db']);
		$SQLawow ="SELECT * from ".$db_translation['characters']." where ".$db_translation['characters_acct']."='".$SQLwow3[$db_translation['acct']]."'";
		$char=mysql_query($SQLawow) or die("Could not get user character information");
		while ($char2=mysql_fetch_array($char))
		{
			
			$cont2.= "<option value=''> - SELECT CHARACTER -</option><option value=' ".$char2[$db_translation['characters_guid']]."-".$i."'>".$realm[$i]['']."  ".$char2[$db_translation['characters_name']]." (level ".$char2[$db_translation['characters_level']].")</option>";
		}
		$i++;					
	}	
	
	
		  $cont2.= "</select>";
		  $cont2.= "</td><td>";
	
  //******END DROPDOWN********
	$cont2.= "<div style='height: 0px; overflow: hidden; position: absolute;' id='amount_msddHolder'><div id='pageWrap'><select name='location' id='amount' style='width:201px;'><option value=''> - SELECT LOCATION - </option><option  id='1' value='1'>Stormwind</option><option value='2'>Ironforge</option><option value='3'>Darnassus</option><option id='4' value='4'>Exodar</option><option id='4' value='13'>Valiance Keep</option><option value='---------'>-----------------HORDE-------------------</option><option id='5' value='5'>Orgrimmar</option><option id='6' value='6'>Thunder Bluff</option><option id='7' value='7'>Undercity</option><option id='8' value='8'>Silvermoon</option><option value='0'>Warsong Hold</option><option value='0'>--Neutral--</option><option value='9'>Shattrath</option><option value='15'>Dalaran</option></select></div><div id='amount_msdd' class='dd' style='width: 199px;'><div id='amount_title' class='ddTitle'><span id='amount_arrow' class='arrow'></span></form>";
	$cont2.= "</select></td></tr></table></center><br>";
	if ($module_teleporter_gold<>'0')
	$cont2.= "<div align='center'> <div class='info-box'> Teleporting a character is completely free of charge.</a><span class='close'>x</span></div><script src='http://www.smshosting.bg/js/jquery.cycle.all.js'></script><script src='http://www.smshosting.bg/js/jquery.cycle.all.js'></script></a>";

	$cont2.= "<center><p><input type='submit'  name='submit' value='Teleport' onclick='return validateTele('u');' style='width:120px; height:30px;></p></div></center>";
	
	$cont2.= "</form>";
	$cont2.= "</div>
						</td>
 <tr><td colspan='4'> <div class='account-menu clearfix'>
				<div id='left' class='text-shadow'>
					<font color='#6f5933'>". $a_user['vp']."</font> Vote Points &nbsp;&nbsp; & &nbsp;&nbsp; <font color='#6f5933'>". $a_user['dp']."</font> Donate Points
				</div>
				<div id='right' class='text-shadow'>
					<a href='quest.php?name=votesites'>VOTE NOW</a>
					<a href='quest_ac.php?name=Donate_with_PayPal'>DONATE</a>
				</div>
			</div>  <br/>
<div class='store-complete-box' align='center'><div class='line2'><div align='center'> <div class='info-box'> You have to be logged out for the teleportation to succeed.</a><span class='close'>x</span></div><script src='http://www.smshosting.bg/js/jquery.cycle.all.js'></script><script src='http://www.smshosting.bg/js/jquery.cycle.all.js'></script></a>";
}
$box_wide->setVar("content_title", "Account Panel");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
?>