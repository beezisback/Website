<script type="text/javascript" language="javascript" src="script/molten.js"></script>
<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="script/jquery.cycle.lite.js"></script>
<div class="page"><script type="text/javascript" language="javascript" src="script/dropdown/js/jquery.dd.js"></script>
<link rel="stylesheet" type="text/css" href="script/dropdown/dropdown.css" />
<script type="text/javascript">
var loading = true;
var web = "http://monster-wow.net/";
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


<?php /************************************************************************************** * Shop mod by AXE, this one is secure and is not hackable trough POST data modifying. * * Created: 8 April 2009, this mod uses 'shop' table.          * **************************************************************************************/ 
 if (!defined('AXE'))  exit;
 /*common include*/
 $box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
 $box_wide = new Template("styles/".$style."/box_wide.php"); 
 $box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
 $box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
 /*end common include*/ 
 patch_include("sendmail",false);
 if (!isset($_SESSION['user'])) 
 {  print "You are not logged in.";
 $tpl_footer = new Template("styles/".$style."/footer.php");
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit; } 
 
 if (isset($_POST['realm']))
 {

 $_SESSION['realm']= $_POST['id'];
 
 }
if (!isset($_SESSION['realm'])) 
{
                         
						 $cont2.="<center><div class='new_vote_searchdiv' align='center'><table cellspan='0' rowspan='0'>";
						 
						 		$i=0;$j=1;
							while ($j<=count($realm))
							{
						 
						 $cont2.="<div class='account-realm-menu'><div id='item'><form method='POST' action='./quest.php?name=Goblin_workshop'><input type='hidden' value='".$j."' name='id'><div id='log-b2'><input type='submit' value='".$realm[$j]['name']."' name='realm' id='active-item' /></div></form></td>";
						 	
								$j++;					
							}	
						 $cont2.="</table></div>";
						$box_wide->setVar("content_title", "ACCOUNT PANEL");	
                        $box_wide->setVar("content", $cont2);					
                        print $box_wide->toString();
						$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
 
 
 /*now reduce points*/ $db->select_db($db_name) or die(mysql_error());
 /*delete shop item, for admins*/ 
 if (isset($_GET['delid']) && $a_user[$db_translation['gm']]==$db_translation['az']) 
 {  
 $points=pun_htmlspecialchars($_GET['points']);  $delid=pun_htmlspecialchars($_GET['delid']); 
 if (isset($_GET['confirm']))
 {   $db->query("DELETE FROM shop WHERE id='".$db->escape($delid)."' LIMIT 1") or die (mysql_error());
 box ( "Delete Item","Item deleted!<br><br><a href='./quest_ac.php?name=Donation_Shop'>Go to Shop</a>" );  
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit;  } 
 else  
 {  box ( "Delete Item","<center>Are you sure you want delete this item?<br><br><a href='quest_ac.php?name=Donation_Shop&delid=".$delid."&confirm=YES'>YES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='./quest_ac.php?name=Donation_Shop'>NO</a></center>" );
 $tpl_footer = new Template("styles/".$style."/footer.php");
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit;  }  } 
 /*send item to character*/ if (isset($_POST['action']))
 {  /*we get char id*/  if ($_POST['character']=='none')
 {   box ('Fail','You don\'t have any characters. Mail can\'t be sent.'); 
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/'); 
 print $tpl_footer->toString();   exit;  } 
 $pieces = explode("-", $_POST['character']);  $char = $pieces[0]; 
 /*char guid*/  $realm_data123 = $pieces[1]; /*realm*/     
 if ($_POST['itemsgrup']=='')  
 {   box ('Fail','No item selected.');  
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  
 print $tpl_footer->toString();   exit;  }  
 $itemsgrup = $_POST['itemsgrup']; /*this is shop ID*/ 
 $itemsgrup = preg_replace( "/[^0-9]/", "", $_POST['itemsgrup'] ); 
 /*only  numbers  /*now we get all required data for this shop ID*/  $checkshopid = $db->query("SELECT * FROM shop WHERE id='".$itemsgrup."' AND donateorvote='1' LIMIT 1") or die(mysql_error());   if (mysql_num_rows($checkshopid)=='0')    {box ('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.webwow.totalh.com" target="_blank">AXE</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$a_user[$db_translation['login']].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? Stupid humans...'); $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;}    $checkshopid2=mysql_fetch_assoc($checkshopid);  $cost = $checkshopid2['cost'];  $itemid = $checkshopid2['itemid'];  $item_stack = $checkshopid2['charges'];  if($checkshopid2['realm']!=$_SESSION['realm'] && $checkshopid2['realm']!="0")  {   box ('Fail','This item is not available on that realm.');   $tpl_footer = new Template("styles/".$style."/footer.php");   $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');   print $tpl_footer->toString();   exit;  }       /*reduce points*/   if ($a_user['dp']>=$cost)   {       }   else   {    box ('Fail','You don\'t have enough points to buy that item.<br>You have '.$a_user['dp'].' points and item costs '.$cost.' points.');    $tpl_footer = new Template("styles/".$style."/footer.php");    $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');    print $tpl_footer->toString();    exit;   }    /*check if realm db is availavable and select db*/   $i=1;   while ($i<=count($realm))   {    if ($pieces[1]==$i)    {     if ($realm[$i]['db']=='')     {box ('Fail','Realm '.$pieces[1].' does not exist!');$tpl_footer = new Template("styles/".$style."/footer.php");     $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');     print $tpl_footer->toString();     exit;}     $db->select_db($realm[$i]['db']);    }    $i++;   }      /*now we check if this is truly char witch belongs to your account*/   $checkchar = $db->query("SELECT ".$db_translation['characters_name'].",".$db_translation['characters_guid']." FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_guid']."='".$char."' AND ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."' LIMIT 1") or die(mysql_error());   if (mysql_num_rows($checkchar)=='0')    {box ('EPIC Fail','<font color="red"><blink>Hack attempt!</blink></font><br><strong>WebScript:</strong> What the fuck are you doing?<br><strong>WebScript:</strong> <a href="http://www.web-wow.net" target="_blank">AXE</a> will punish you becouse you doing this to me!<br><strong>WebScript:</strong> In matter of fact ill report your ass to admins right now!<br><strong>WebScript:</strong> I know who you are <strong>'.$db_translation['login'].'</strong> and your IP is '.$_SERVER['REMOTE_ADDR'].'...<br><strong>WebScript:</strong> <i>[Grunting] (That will teach you...)</i><br><br><strong>WebScript:</strong> Tell me one good reason, one! Why i don\'t ban you right now at spot, ha...<br><strong>WebScript:</strong> Wtf did u doing SQL injecting like that? You CAN\'T SEND ITEMS TO CHARACTERS THAT AREN\'T ON YOUR ACCOUNT. Stupid humans...'); $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;}      $charname=$db->fetch_array($checkchar);   /*add mail here*/   $time = date("m-d-Y, h:i");   $refnum=date("jnGis");   $subject = 'WebsiteDonationShopREF'.$refnum.'';/*do not remove $refnum*/   $body = 'Enjoy your new reward! Item costed '.$cost.' points. [Time sent: '.$time.'] [Item ID:'.$itemid.']';    /*refrence-> sendmail($playername,$playerguid, $subject, $text, $item, $shopid, $money=0,$realmid=false) //returns*/   $sendingmail=sendmail($charname[0],$charname[1], $subject, $body, $itemid,$itemsgrup,'0',$pieces[1]);   /*SQL*/      if (substr($sendingmail, 0, 16)=="<!-- success -->")   {    $newpoints=$a_user['dp']-$cost;    $db->select_db($db_name);    $delpoints = $db->query("UPDATE accounts_more SET dp='".$newpoints."' WHERE acc_login='".$a_user[$db_translation['login']]."'") or die(mysql_error());    $sendingmail.="<br>Points are taken.";   }      /*end SQL*/       box ('Report',$sendingmail);   $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;  }    
 $box_simple_wide->setVar("content", $cont1); print $box_simple_wide->toString(); /**/ /*select web database*/ /**/ $db->select_db($db_name);  /**/ /* Something is bought (post data submitted)*/ /**/  if ($a_user[$db_translation['gm']]==$db_translation['az']) { 
 if ($_POST['additem']) 
 {    if ($_POST['sep']=='0') /*is item*/  
 {    if ($_POST['itemid']=='')   
 {     box ('Fail','Make sure you type in item id.');  
 $tpl_footer = new Template("styles/".$style."/footer.php");
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/'); 
 print $tpl_footer->toString();  exit;    }  
 else if ($_POST['name']=='')  
 {     box ('Fail','Make sure you type in item name.');  
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit;    } 
 else if ($_POST['description']=='')   
 {     box ('Failure','Make sure you typed in an item description.');  
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/'); 
 print $tpl_footer->toString();  exit;    } 
 else if ($_POST['points']=='')    
 {     box ('Fail','Make sure you type in item point cost.'); 
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit;    } 
 else if ($_POST['charges']=='')    
 {     box ('Fail','Make sure you type in charges.');  
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/'); 
 print $tpl_footer->toString();  exit;    }
 else if ($_POST['cat']=='')    
 {     box ('Fail','Make sure you type in category number for sorting items.'); 
 $tpl_footer = new Template("styles/".$style."/footer.php");
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit;    }
 else if ($_POST['sort']=='')    
 {     box ('Fail','Make sure you type in sort items within same category.');  
 $tpl_footer = new Template("styles/".$style."/footer.php"); 
 $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
 print $tpl_footer->toString();  exit;    }    else /*pass*/   
 {     $result=$db->query("INSERT INTO shop (sep,name,itemid,color,cat,sort,cost,charges,donateorvote,description,custom,realm) VALUES ('0','".$db->escape($_POST['name'])."','".$db->escape($_POST['itemid'])."','".$_POST['color']."','".$db->escape($_POST['cat'])."','".$db->escape($_POST['sort'])."','".$db->escape($_POST['points'])."','".$db->escape($_POST['charges'])."','1','".$db->escape($_POST['description'])."', '".$db->escape($_POST['custom'])."','".$db->escape($_POST['realm1'])."')") or die(mysql_error());       box ('Success','Item is added!');  $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;    }   }   else /*is seperator*/   {    if ($_POST['name']=='')    {     box ('Fail','Make sure you type in item name.');     $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;    }    else if ($_POST['cat']=='')    {     box ('Fail','Make sure you type in category number for sorting items.');     $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;    }    else if ($_POST['sort']=='')    {     box ('Fail','Make sure you type in sort items within same category.');     $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;    }    else /*pass*/    {     $result=$db->query("INSERT INTO shop (sep,name,cat,sort,donateorvote,itemid) VALUES ('1','".$db->escape($_POST['name'])."','".$db->escape($_POST['cat'])."','".$_POST['sort']."','1','0')") or die(mysql_error());          box ('Success','Item is added!');     $tpl_footer = new Template("styles/".$style."/footer.php");  $tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');  print $tpl_footer->toString();  exit;    }   }  }              } /**/ /* Display shop:*/ /**/ 

 $cont2='<center><div class="voteshop1">
 <div class="account-navigation box-shadow-inset clearfix">
<div id="left">
<p id="title">Goblin Workshop</p>
</div>
<div id="right">
<a href="./quest.php?name=account">Back to Account</a>
</div>
</div>';
 
$cont2.="<table cellspan='0' rowspan='0'>";
						 
						 		$i=0;$j=1;
							while ($j<=count($realm))
							{
						 if ($j==$_SESSION['realm']){$cont2.="<div class='account-realm-menu'><div id='item'><input type='submit' value='".$realm[$j]['name']."' name='realm' id='active-item' disabled='disabled'>";} else{
						 $cont2.="<form method='POST' action='./quest_ac.php?name=Donation_Shop'><input type='hidden' value='".$j."' name='id'><input type='submit' value='".$realm[$j]['name']."' name='realm' /></div></form>";
						 	}
								$j++;					
							}	
						 $cont2.='
<form method="post" action="./quest.php?name=Goblin_workshop">
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
<tbody><tr onclick="document.getElementById("radio_120").checked = "checked";">
<td colspan="4">
<div class="store-item-list-row clearfix">
<p><a class="q" ">TCG Loot</a></p><p></p><p></p><p></p>
</div>
						</td></tr>
						
';          




 $query = $db->query("SELECT * FROM shop WHERE donateorvote='1' AND realm = '".$_SESSION['realm']."' OR donateorvote='1' AND realm = '0' ORDER BY cat, sort ASC") or die (mysql_error());   
 while ($items = $db->fetch_assoc($query))      
 {              /*its seperator*/    
 if ($items['sep']=='1')       
 {           $cont2.= "<tr><td colspan='3'>";    
 if ($a_user[$db_translation['gm']]==$db_translation['az'])     
 {            $cont2.= '<a href="./quest.php?name=account&points=1&delid='.$items['id'].'">[x]</a> ';    
 }           $cont2.= "<strong><u>".$items['name']."</u></strong></td></tr>";       
 }          else /*its item*/          {     
 $cont2.= '<tr onmouseover="this.style.backgroundImage = \'url(./res/images/transp-green.png)\';" onmouseout="this.style.backgroundImage = \'none\'; ">';    
 $cont2.= "<td>";           if ($a_user[$db_translation['gm']]==$db_translation['az'])       
 {            $cont2.= '<a href="./quest_ac.php?name=Donation_Shop&delid='.$items['id'].'">[x]</a>  ';       
 }           if ($items['custom']=='1')        
 {            /*color codes here*/         
 $cil = array (         
 '0'=>'gray',    
 '1'=>'white',  
 '2'=>'#25FF16',  
 '3'=>'#0070AC',   
 '4'=>'#A335EE',  
 '5'=>'#FF8000',   
 );      
 $cont2.= '
<span style="color:'.$cil[$items['color']].'" onmouseover="$WowheadPower.showTooltip(event, \'<font color='.$cil[$items['color']].'>'.$items['name'].'</font><br><small>This is a donation token.</small>\')" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();">['.$items['name'].']';           }           else           {           $cont2.= "<div class='store-item-list-row clearfix'><p><a class='q".$items['color']."' href='http://www.wowhead.com/?item=".$items['itemid']."'>[".$items['name']."]</p>";           }                      if ($items['charges']=='0' || $items['charges']=='1')           {            $charges='';           }           else           {            $charges='x'.$items['charges'];           }           $cont2.= "<td><p>1</p>".$charges."";           $cont2.= "<td><font color='#ad8b15'>".$items['cost']."</font> Donate Points</p>";           $cont2.= "<td>".$real_descr[0]."</td>";                  $cont2.= '<td><input type="radio" name="itemsgrup" value="'.$items['id'].'" />		</div>
						</td>
';
                       $cont2.='';          }          }                                       $cont2.='
 					   
   
 
					
					
					
					
							</div>
						</td>
 <tr><td colspan="4"> <div class="account-menu clearfix">
				<div id="left" class="text-shadow">
					<font color="#6f5933">'. $a_user['vp'].'</font> Vote Points &nbsp;&nbsp; & &nbsp;&nbsp; <font color="#6f5933">'. $a_user['dp'].'</font> Donate Points
				</div>
				<div id="right" class="text-shadow">
					<a href="quest.php?name=votesites">VOTE NOW</a>
					<a href="quest_ac.php?name=Donate_with_PayPal">DONATE</a>
				</div>
			</div>  <br/>
<div class="store-complete-box" align="center">
			
			<center><b> Select Your Chracter: </center></font>
<center><table border="0" cellspacing="0" cellpadding="0"><tr><td>



						<div id="pageWrap"> <select name="char" id="charname" style="width:200px;"></b></center>';                
 /*#########################################CHAR START*/         $i=0;        $j=$_SESSION['realm'];       
 $db->select_db($realm[$j]['db'])or error('Unable to select realm database. Probabley you misspelled database name');  
 $result = $db->query("SELECT * FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."'") or die (mysql_error());  
 while ($char = $db->fetch_assoc($result))      
 {       
 $cont2.= "<option selected='selected' value='".$char[$db_translation['characters_guid']]."-".$j."'>".$realm[$j]['']."".$char[$db_translation['characters_name']]." level ".$char[$db_translation['characters_level']]." </option>";
										 $i++;          }                            $j++;                     if ($i=='0')        {         $cont2.=  "<option value='none'>You do not have any characters</option></select>";        }        /*go back to default db selection*/        $db->select_db($db_name);                                                 $cont2.=  "</select> ";        /*#########################################CHAR END*/ 
     $cont2.= ' <div id="log-b3"><input name="action" type="submit" value="Purchase" /></div></form>                 
	 <br /> <br /> Upon purchasing the website might take more than 10 seconds to load.<br> Please be patient and wait whilst your purchase is progressed.   </div>
							</tr></td>  </table> </div></center>       ';       
$box_wide->setVar("content_title", "ACCOUNT PANEL");  
$box_wide->setVar("content", $cont2);      
print $box_wide->toString();      
if ($a_user[$db_translation['gm']]==$db_translation['az'])       
  {       
  $cont2= '
<center>      
<div class="sub-box1" align="left">                  
   <form action="" method="post">      
    <table  border="0" align="center" cellpadding="3"> <tr>       
	 <td>Item?:<br /></td>       
	 <td><select name="sep">         
	 <option value="0" selected="selected">Item</option>         
	 <option value="1">Seperator *</option>                 
	 </select></td>    
	 </tr>        
	 <tr>          
	 <td>Custom item? </td>         
	  <td><select name="custom">         
	  <option value="0" selected="selected">No</option>         
	  <option value="1">Yes</option>        
	  </select></td>   </tr>       
	  <tr>          
	  <td>Available on: </td>          
	  <td> <select name="realm1"> ';        $i=1;        while ($i<=count($realm))        {         
	  $cont2.='
	  <div id="fix66"><option value="'.$i.'" > '.$realm[$i]['name'].'</option>'; 
	  $i++;
	  $cont2.='</div>';          
	  }
	  $cont2.='<option value="0" > All realms</option></select>';
	  $cont2.='</td></tr> <tr>       
	  <td>Item ID:</td>       
	  <td><input name="itemid" type="text" /> 
	  <a href=\'#\' onClick=\'window.open("./pop-itemlookup.php","item","width=450,height=400,screenX=50,left=250,screenY=50,top=200,scrollbars=yes,status=no,menubar=no");return false\'><strong>[Search for item ID]</strong></a></td>        
	  </tr> <tr>       
	  <td>Item name:</td>       
	  <td><input name="name" type="text" /> *</td> 
	  </tr>     
	  <tr>       
	  <td>Item color:</td>       
	  <td><select name="color">         
	  <option value="0">Poor (gray)</option>         
	  <option value="1" selected="selected">Common (white)</option>         
	  <option value="2">Uncommon (green)</option>         
	  <option value="3">Rare (blue)</option>         
	  <option value="4">Epic (purple)</option>         
	  <option value="5">Legendary (orange)</option>        
	  </select>
	  </td>        
	  </tr>         
	  <tr>       
	  <td>Description:</td>       
	  <td><input name="description" type="text" /></td>        
	  </tr>        
	  <tr>       
	  <td>Cost Points:</td>       
	  <td><input name="points" type="text" value="1" /></td>        
	  </tr>        
	  <tr>       
	  <td>Item Stack:</td>       
	  <td><input name="charges" type="text" value="1" /><br />Default is 1 for one item.</td>        
	  </tr>        
	  <tr>       
	  <td>Cat Sort:</td>       
	  <td><input name="cat" type="text" value="0" />        
	  *  &laquo;<strong>X</strong>-x&raquo;</td>        
	  </tr>        
	  <tr>       
	  <td>Sort within Cat:</td>       
	  <td><input name="sort" type="text" value="0" />       
	  * &laquo;x-<strong>X</strong>&raquo;</td>        
	  </tr> </table>      
	  <center><br />      
	  If you select "Seperator" then only fields marked with an"*" are required.<br /><br />      
	  <div id="log-b2"><input name="additem" type="submit" value="Add Item" /></div>      
	  </center>            
	  </form>
</div>
</center>
'; 
$box_wide->setVar("content_title", "Admin tool to add an item:");  
$box_wide->setVar("content", $cont2);      
print $box_wide->toString();           
} /*end admin*/ 
?>