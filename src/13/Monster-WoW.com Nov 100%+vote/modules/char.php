
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
	//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include
if (isset($_POST['unstuck'])) 
{
	$realmid=$_POST['realm'];
	$realmid = preg_replace( "/[^0-9]/", "", $_POST['realm'] ); //only letters and numbers
	
	
	$i=1;
	while ($i<=count($realm))
	{
		if ($realmid==$i)
		{
			$db->select_db($realm[$i]['db']);
		}
	
		$i++;
	}
	
	
	$char_guid = preg_replace( "/[^0-9]/", "", $_POST['char_guid'] ); //only letters and numbers
	$a=unstuck($char_guid);
	if ($a)
	{
		box ('Fail',$a);
	}
	else
	{
		box ('Success','Your character has been unstuck! It is now located at its innkeeper. All auras has been cleared and the character was revived. You must be logged out for this to work.');
	}

		

	
	$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
} 

							
								
$i=1;

while ($i<=count($realm))
{
	$cont2.= '<center>
<div class="account-navigation box-shadow-inset clearfix">
<div id="left">
<p id="title">CHARACTER UNSTUCKER</p>
</div>
<div id="right">
<a href="./quest.php?name=account">Back to Account</a>
</div>
</div><div class="unstucker-container">
<div class="unstucker-realm">
<div id="realm-name">'.$realm[$i]['name'];
	$db->select_db($realm[$i]['db']);
	
	$result = $db->query("SELECT * FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."'") or die (mysql_error());
	
	while ($char = $db->fetch_assoc($result))
	{
		//set race
		if ($char[$db_translation['characters_race']]=="1" || $char[$db_translation['characters_race']]=="3" || $char[$db_translation['characters_race']]=="4" || $char[$db_translation['characters_race']]=="7" || $char[$db_translation['characters_race']]=="11")
		{ $side="0"; } else {$side="1";}
		//set avvy
		if ($char[$db_translation['characters_level']]<="50") 
		{
			$avvy = "<img src='./images/portraits/wow-default/".$char[$db_translation['characters_gender']]."-".$char[$db_translation['characters_race']]."-".$char[$db_translation['characters_class']].".gif' border='0' class='avatar'>"; 
		} 
		elseif ($char[$db_translation['characters_level']]>="51" && $char[$db_translation['characters_level']]<="69" )
		{
			$avvy = "<img src='./images/portraits/wow/".$char[$db_translation['characters_gender']]."-".$char[$db_translation['characters_race']]."-".$char[$db_translation['characters_class']].".gif' border='0' class='avatar'>";  
		}
		else 
		{
			$avvy = "<img src='./images/portraits/wow-70/".$char[$db_translation['characters_gender']]."-".$char[$db_translation['characters_race']]."-".$char[$db_translation['characters_class']].".gif' border='0' class='avatar'>"; 
		}
		
		
		//end
		//set money
		$gold=substr($char[$db_translation['characters_gold']], 0, -4); if ($gold=='') {$gold="0";}
		$silver=substr($char[$db_translation['characters_gold']], 0, -2); 
		$silver2=substr($silver, -2); if ($silver2=='') {$silver2="0";}
		$copper=substr($char[$db_translation['characters_gold']], -2); if ($copper=='') {$copper="0";}
		$cont2.= "<center><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	   
		$cont2.= '</div>

<hr/></div><form action="" method="post">';
		$cont2.= '<input name="char_guid" type="hidden" value="'.$char[$db_translation['characters_guid']].'" />';
		$cont2.= '<input name="realm" type="hidden" value="'.$i.'" />';
        $cont2.= "<div id='pageWrap'><select name='char' id='charname' style='width:200px;'>";
		$cont2.= '<option title="'.$avvy.'</td>
		<td valign="top" align="right"><strong>'.$char[$db_translation['characters_name']].'<img src="./images/icon/race/'.$char[$db_translation['characters_race']].'-'.$char[$db_translation['characters_gender']].'.gif"  title="Race" />&nbsp;&nbsp;<img src="./images/icon/pvpranks/rank_default_'.$side.'.gif"  title="Faction" /><br>
		</td></option></select>
		<td width="100px"  valign="middle" style="text-align:right">
		<div id="log-b2"><input type="submit" name="unstuck" value="Unstuck" /></div></td>
		</tr>
		</table>';
		$cont2.= '</form>';
	
	}
	$i++;
}
	
							//go back to default db selection
							$db->select_db($db_name);
								
                             	
								$cont2.= "</select>";
							//#########################################CHAR END
							$cont2.='<br /><br />';
$box_wide->setVar("content_title", "ACCOUNT PANEL");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	
							
?>					