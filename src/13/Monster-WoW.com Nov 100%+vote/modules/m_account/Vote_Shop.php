<script type="text/javascript" language="javascript" src="script/molten.js"></script>
<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="script/jquery.cycle.lite.js"></script>
<div class="page"><script type="text/javascript" language="javascript" src="script/dropdown/js/jquery.dd.js"></script>
<link rel="stylesheet" type="text/css" href="script/dropdown/dropdown.css" />
<script type="text/javascript">
var loading = true;
var web = "";
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

require 'config_voteshop.php';

//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include
patch_include("sendmail",false);
if (!isset($_SESSION['user'])) 
{
	print "You are not logged in."; $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
if (isset($_POST['realm']))
 {
 
 $_SESSION['realm']= $_POST['id'];
 
 }
if (!isset($_SESSION['realm'])) 
{
                         
						 $cont2.="<center><table cellspan='0' rowspan='0'>";
						 
						 		$i=0;$j=1;
							while ($j<=count($realm))
							{
						 
						 $cont2.="<td><form method='POST' action='./quest_ac.php?name=Vote_Shop'><input type='hidden' value='".$j."' name='id'><div class='account-realm-menu'><div id='item'><input type='submit' value='".$realm[$j]['name']."' name='realm' id='active-item'/></div></form></td>";
						 	
								$j++;					
							}	
						 $cont2.="</table></div>";
						$box_wide->setVar("content_title", "Vote Shop");	
                        $box_wide->setVar("content", $cont2);					
                        print $box_wide->toString();
						$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}


//now reduce points
$db->select_db($db_name) or die(mysql_error());

//send item to character
if (isset($_POST['action'])) 
{
	//we get char id
	if ($_POST['character']=='none')
	{
		box ('Fail','You don\'t have any characters. Mail can\'t be sent.'); 
		$tpl_footer = new Template("styles/".$style."/footer.php");
		$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
		print $tpl_footer->toString();
		exit;
	}
	$pieces = explode("-", $_POST['character']);
	$char = $pieces[0];  //char guid
	$realm_data123 = $pieces[1]; //realm
	
	
	
	if ($_POST['itemsgrup']=='')
	{
		box ('Fail','No item selected.');
		$tpl_footer = new Template("styles/".$style."/footer.php");
		$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
		print $tpl_footer->toString();
		exit;
	}
	
	$itemsgrup = $_POST['itemsgrup']; //this is shop ID
	//now we get all required data for this shop ID
	$checkshopid = $db->query("SELECT * FROM vote_items WHERE entry='".$itemsgrup."' LIMIT 1") or die(mysql_error());
		if (mysql_num_rows($checkshopid)=='0')
			{box ('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.webwow.totalh.com" target="_blank">AXE</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$a_user[$db_translation['login']].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? Stupid humans...'); $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;}
	
	$checkshopid2=mysql_fetch_assoc($checkshopid);
	
	$vote_costs2 = $db->query("SELECT * FROM vote_costs WHERE start_itemlevel <= ".$checkshopid2["ItemLevel"]." AND end_itemlevel >= ".$checkshopid2["ItemLevel"]." LIMIT 1") or die (mysql_error());
    $row2 = $db->fetch_assoc($vote_costs2);
	
	if (!$row2)
     $costpoints = '100';
    else
     $costpoints = $row2["points"];
	 
	$cost = $costpoints;
	
	$itemid = $checkshopid2['entry'];
	$item_stack = '1';

		//reduce points
		if ($a_user['vp']>=$cost)
		{
		}
		else
		{
			box ('Fail','You don\'t have enough points to buy that item.<br>You have '.$a_user['vp'].' points and item costs '.$cost.' points.');
			$tpl_footer = new Template("styles/".$style."/footer.php");
			$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
			print $tpl_footer->toString();
			exit;
		}

		//check if realm db is availavable and select db
		$i=1;
		while ($i<=count($realm))
		{
			if ($pieces[1]==$i)
			{
				if ($realm[$i]['db']=='')
				{box ('Fail','Realm '.$pieces[1].' does not exist!');$tpl_footer = new Template("styles/".$style."/footer.php");
				$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
				print $tpl_footer->toString();
				exit;}
				$db->select_db($realm[$i]['db']);
			}
			$i++;
		}
		
		
		//now we check if this is truly char witch belongs to your account
		$checkchar = $db->query("SELECT ".$db_translation['characters_name'].",".$db_translation['characters_guid']." FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_guid']."='".$char."' AND ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."' LIMIT 1") or die(mysql_error());
		if (mysql_num_rows($checkchar)=='0')
			{box ('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.webwow.totalh.com" target="_blank">AXE</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$db_translation['login'].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? You CAN\'T SEND ITEMS TO CHARACTERS THAT AREN\'T ON YOUR ACCOUNT. Stupid humans...'); $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;}
		
		$charname=$db->fetch_array($checkchar);
		//add mail here
		$time = date("m-d-Y, h:i");
		$refnum=date("jnGis");
		$subject = 'WebsiteVoteShopREF'.$refnum.'';//do not remove $refnum
		$body = 'Enjoy your new reward! Item costed '.$cost.' points. [Time sent: '.$time.'] [Item ID:'.$itemid.']';

		//refrence-> sendmail($playername,$playerguid, $subject, $text, $item, $shopid, $money=0,$realmid=false) //returns
		$sendingmail=sendmail($charname[0],$charname[1], $subject, $body, $itemid,'0','0',$pieces[1]);	
		//SQL
		if (substr($sendingmail, 0, 16)=="<!-- success -->")
		{
			$newpoints=$a_user['vp']-$cost;
			$db->select_db($db_name);
			$delpoints = $db->query("UPDATE accounts_more SET vp='".$newpoints."' WHERE acc_login='".$a_user[$db_translation['login']]."'") or die(mysql_error());
			$sendingmail.="<br>Points are taken.";
		}
		//end SQL
		
		box ('Report',$sendingmail);
		$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
	}

//
//select web database
//
$db->select_db($db_name);

//
//	Display shop:
//

$name = $_GET['q']; 

$cont2.='<center><div class="voteshop1">

<div class="account-navigation box-shadow-inset clearfix">
<div id="left">
<p id="title">VOTE SHOP</p>
</div>
<div id="right">
<a href="./quest.php?name=account">Back to Account</a>
</div>
</div>
';

					 $cont2.="<table cellspan='0' rowspan='0'>";
						 
						 		$i=0;$j=1;
							while ($j<=count($realm))
							{
						 if ($j==$_SESSION['realm']){$cont2.="<div class='account-realm-menu'><div id='item'><input type='submit' value='".$realm[$j]['name']."' name='realm' id='active-item' disabled='disabled'></td>";} else{
						 $cont2.="<div class='account-realm-menu'><div id='item'><td><form method='POST' action='./quest_ac.php?name=Vote_Shop'><input type='hidden' value='".$j."' name='id' ><input type='submit' value='".$realm[$j]['name']."' name='realm' id='active-item'/></div></form></td>";
						 	}
								$j++;					
							}	
						 $cont2.="</table>";
$cont2.='
<div class="store-filtering">
<div id="categories">
<table border="0" cellpadding="0" cellspacing="5">
<tr>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_warrior.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=warrior" title="Warrior Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_paladin.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=paladin" title="Paladin Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_hunter.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=hunter" title="Hunter Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_rogue.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=rogue" title="Rogue Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_priest.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=priest" title="Priest Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_deathknight.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=death" title="Death Knight Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_shaman.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=shaman" title="Shaman Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_mage.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=mage" title="Mage Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_warlock.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=warlock" title="Warlock Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/class_druid.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=druid" title="Druid Glyphs"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/inv_jewelry_talisman_12.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=heirloom" title="Heirloom Items"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/inv_jewelcrafting_crimsonspinel_02.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=gem" title="Gems for Socket"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/inv_enchant_formulasuperior_01.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=encha" title="Armor&Weapon Enchants"></a>
</div>
</td>
<td>
<div id="category">
<ins style="background-image: url(&quot;http://wow.zamimg.com/images/wow/icons/medium/trade_archaeology.jpg&quot;);"></ins>
<del></del>
<a href="./quest_ac.php?name=Vote_Shop&cl=arche" title="Archaeology"></a>
</div>
</td>
</tr>
</table>
<hr style="margin-top: 20px;"/>
</div>	
		<form action="" method="get">
<input type="hidden" name="name" value="'.$_GET['name'].'">
<input type="hidden" name="cl" value="">
<input type="text" name="q" value="Search" value="'.$name.'" onfocus="if (this.value == "Search") this.value = "";" onblur="if (this.value == "") this.value = "Search";">&nbsp;
<input type="submit" name="search" value="Search">
</form>
</div>
<form method="post" action="">
<table border="0" align="center" cellpadding="0" cellspacing="0" class="store-item-list">
<thead>
<tr id="head">
<td>Item Name</td>
<td>Stack</td>
<td>Cost</td>
<td>Buy?</td>
</tr>
<tr>
<td colspan="4"><hr style="margin: 4px 0 5px 0;"/></td>
</tr>
</thead>
<tbody>
<tr onclick="document.getElementById("radio_16252").checked = "checked";">
<td colspan="4">
<div class="store-item-list-row clearfix">
		<form method="post" action="">
		';
						
					if(isset($_GET['search'])){ 
              
							  	  
						 if(preg_match("/^[  a-zA-Z0-9#()]+$/", $_GET['q'])){
     
							  $query = $db->query("SELECT * FROM vote_items WHERE name LIKE '%" . $name .  "%' AND `show` = 'yes' AND realm = '".$_SESSION['realm']."' OR name LIKE '%" . $name .  "%' AND `show` = 'yes' AND realm = '0' ORDER BY name ASC LIMIT ".$voteshop_config['results_limit']) or die (mysql_error());
							  $num = $db->num_rows($query);

							  while ($items = $db->fetch_assoc($query))
							  {		
							  	$vote_costs = $db->query("SELECT * FROM vote_costs WHERE start_itemlevel <= ".$items["ItemLevel"]." AND end_itemlevel >= ".$items["ItemLevel"]." LIMIT 1") or die (mysql_error());
                                $row = $db->fetch_assoc($vote_costs);
	
                                 if (!$row)
                                  $cost = '100';
                                 else
								 if ($items["custom"]=="1"){                                  $cost = $row["points"];

										$cont2.= '<tr onmouseover="this.style.backgroundImage = \'url(./res/images/transp-green.png)\';" onmouseout="this.style.backgroundImage = \'none\';" onclick="document.getElementById(\'radio_'.$items['entry'].'\').checked = \'checked\';">';
										$cont2.= "<td id='s7233s'>";
										$cont2.= '<td colspan="4"><div class="store-item-list-row clearfix"><span class="q'.$items['Quality'].'" href="#" onmouseover="$WowheadPower.showTooltip(event, \'This is a custom item.\')" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();">'.$items['name'].'</span></td>';										
										$cont2.= "<td id='s7233s'>".$cost."</td>";
										$cont2.= '<td id="s7233s"><input type="radio" name="itemsgrup" value="'.$items['entry'].'" id="radio_'.$items['entry'].'" />';									
										$cont2.='</td></tr>';}
								 else{
                                  $cost = $row["points"];

										$cont2.= '<tr onmouseover="this.style.backgroundImage = \'url(./res/images/transp-green.png)\';" onmouseout="this.style.backgroundImage = \'none\';" onclick="document.getElementById(\'radio_'.$items['entry'].'\').checked = \'checked\';">';
										$cont2.= "<td id='s7233s'>";
										$cont2.= "<a class='q".$items['Quality']."' href='http://www.wowhead.com/?item=".$items['entry']."'><div class='store-item-list-row clearfix'>".$items['name']."</a></td>";	
                                        $cont2.= "<td id='s7233s'><p>1</p></td>";											
										$cont2.= "<td><p><font color='#ad8b15'>".$cost."</font> Vote Points</p></td>";
										$cont2.= '<td id="s7233s"><input type="radio" name="itemsgrup" value="'.$items['entry'].'" id="radio_'.$items['entry'].'" />';									
										$cont2.='</div></td></tr>';
									
							  }}
							  
						   } else {
					 $cont2 .= '<tr><td colspan="0" align="center">
							 	<center><h3>Try again!</h3></center></td></tr>';
					       }
					} else {
					 $cont2 .= '';
					}
							  $cont2.='</table><br/><div class="account-menu clearfix">
<div id="left" class="text-shadow">
<font color="#6f5933">'. $a_user['vp'].'</font> Vote Points &nbsp;&nbsp; & &nbsp;&nbsp; <font color="#6f5933">'. $a_user['dp'].'</font> Donate Points
</div>
<div id="right" class="text-shadow">
<a href="quest.php?name=votesites">VOTE NOW</a>
<a href="quest_ac.php?name=Donate_with_PayPal">DONATE</a>
</div>
</div>
<div class="store-complete-box" align="center">
<center><table border="0" cellspacing="0" cellpadding="0"><tr><td>



						<font color="#5d6161"><center><b> Select Your Chracter: </center></font><select name="character"></b></center>';
							
							//#########################################CHAR START
								$i=0;$j=$_SESSION['realm'];
							
								
									$db->select_db($realm[$j]['db'])or error('Unable to select realm database. Probabley you misspelled database name');
									$result = $db->query("SELECT * FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."'") or die (mysql_error());
									
									while ($char = $db->fetch_assoc($result))
									{
										$cont2.= "<option selected='selected' value='".$char[$db_translation['characters_guid']]."-".$j."'>".$realm[$j]['']."".$char[$db_translation['characters_name']]." level ".$char[$db_translation['characters_level']]." </option>";
										
										$i++;
									}
									
								
												
							
							
								if ($i=='0')
								{
									$cont2.=  "<option value='none'>You do not have any characters</option>";
								}
							//go back to default db selection
							$db->select_db($db_name);
								
                             	
								$cont2.=  "</select></tr></td> ";
							//#########################################CHAR END
                           		$cont2.= '<tr><td><center><input name="action" type="submit" value="Purchase!"/></tr></td></center></form>	


							';
						$box_wide->setVar("content_title", "ACCOUNT PANEL");	
                        $box_wide->setVar("content", $cont2);					
                        print $box_wide->toString();
?>