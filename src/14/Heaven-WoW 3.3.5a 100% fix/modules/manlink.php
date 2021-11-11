<?php
if (!defined('AXE'))
	exit;
if ($a_user['is_guest']) 
{
	print "You are not logged in."; $tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
if ($a_user[$db_translation['gm']]<>$db_translation['az'])
{
	print "You do not have access to this page.";$tpl_footer = new Template("styles/".$style."/footer.php");
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

//ADD NEW LINK
if (isset($_POST['submit']))
{
	if ($_POST['viewable']<>'')
		$viewable='[|]'.$_POST['viewable'];
	else
		$viewable='';	

	$title=pun_htmlspecialchars($_POST['title']);
	if ($title=='') die ("Title may not be empty.");
	$title = $title . $viewable;
	
	$insert = $WEB_PDO->prepare("INSERT INTO `pages` (title, link, position, orderby, description) VALUES (:title, :link, :pos, :orderby, :descr)");
	$insert->bindParam(':title', $title, PDO::PARAM_STR);
	$insert->bindParam(':link', $_POST['link'], PDO::PARAM_STR);
	$insert->bindParam(':pos', $_POST['position'], PDO::PARAM_INT);
	$insert->bindParam(':orderby', $_POST['orderby'], PDO::PARAM_INT);
	$insert->bindParam(':descr', pun_htmlspecialchars($_POST['descr']), PDO::PARAM_STR);
	$insert->execute();
	unset($insert);
	
	//generate_navigation_cache();
}

if (isset($_POST['editlink']))
{
	if ($_POST['viewable']<>'')
		$viewable='[|]'.$_POST['viewable'];
	else
		$viewable='';
	
	$title=pun_htmlspecialchars($_POST['title']);	
	if ($title=='') die ("Title can't be empty.");
	$title = $title . $viewable;
	
	$update = $WEB_PDO->prepare("UPDATE `pages` SET `title` = :title, `link` = :link, `position` = :pos, `orderby` = :orderby, `description` = :descr WHERE `id` = :id LIMIT 1");
	$update->bindParam(':title', $title, PDO::PARAM_STR);
	$update->bindParam(':link', $_POST['link'], PDO::PARAM_STR);
	$update->bindParam(':pos', $_POST['position'], PDO::PARAM_INT);
	$update->bindParam(':orderby', $_POST['orderby'], PDO::PARAM_INT);
	$update->bindParam(':descr', pun_htmlspecialchars($_POST['descr']), PDO::PARAM_STR);
	$update->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
	$update->execute();
	unset($update);
	
	//generate_navigation_cache();
}

if (isset($_GET['delete']) && !isset($_GET['edit']))
{
	$del = $WEB_PDO->prepare("DELETE FROM `pages` WHERE `id` = :id LIMIT 1");
	$del->bindParam(':id', $_GET['delete'], PDO::PARAM_INT);
	$del->execute();
	unset($del);

	//generate_navigation_cache();
}

if (!isset($_GET['delete']) && isset($_GET['edit']))
{
	$res = $WEB_PDO->prepare("SELECT * FROM `pages` WHERE `id` = :id LIMIT 1");
	$res->bindParam(':id', $_GET['edit'], PDO::PARAM_INT);
	$res->execute();
	
	if ($res->rowCount() == 0)
	{
		$cont2.= "Can not edit link. Error: invalid link id.<br><br>";
	}
	else
	{
		$b2 = $res->fetch(PDO::FETCH_ASSOC);
		$title_lin1 = explode("[|]", $b2['title']);
		$cont2.='
		<center>
        <div class="sub-box1" align="left">
		Edit link:
		<form action="./quest.php?name=manlink" method="post" style=" padding:5px;  method="post">
		<input name="id" type="hidden" value="'. $b2['id'] .'" />
	<label>Link title:<br/> <input name="title" type="text" value="'. $title_lin1[0] .'" /></label><br/>
	
	<label>Link path:<br/> <input name="link" type="text" value="'. $b2['link'] .'" style="width:285px"/></label><br /><br />
	
	<label>Position: <select name="position">
	<option value="1" '; if ($b2['position']=='1') $cont2.= "selected=\"selected\"" ; $cont2.='>Top menu</option>
	<option value="2" '; if ($b2['position']=='2') $cont2.= "selected=\"selected\""; $cont2.='>Bottom menu</option></select></label>
	<label>&nbsp;&nbsp;&nbsp;Order: <input name="orderby" type="text" value="'. $b2['orderby'] .'" style="width:50px; text-align:center" /></label>
	<br><br><label>Viewable to:<br/> <select name="viewable">
	<option value="" '; if ($title_lin1[1]=='') $cont2.= "selected=\"selected\"" ; $cont2.='>All</option>
	<option value="1" '; if ($title_lin1[1]=='1') $cont2.= "selected=\"selected\""; $cont2.='>Guests</option>
	<option value="2" '; if ($title_lin1[1]=='2') $cont2.= "selected=\"selected\""; $cont2.='>All Logged in</option>
	<option value="3" '; if ($title_lin1[1]=='3') $cont2.= "selected=\"selected\""; $cont2.='>&nbsp;&nbsp;Only normal players</option>
	<option value="4" '; if ($title_lin1[1]=='4') $cont2.= "selected=\"selected\""; $cont2.='>&nbsp;&nbsp;Only Admins (az)</option>
	<option value="5" '; if ($title_lin1[1]=='5') $cont2.= "selected=\"selected\""; $cont2.='>&nbsp;&nbsp;Only GMs and Admins (az and a)</option>
	
	
	</select></label><br><br>
	
	
	<label>Description: <input name="descr" type="text" value="'. $b2['description'] .'" style="width:400px;" /></label><br>
	<br /><br />
	<div id="log-b2"><input name="editlink" value="Edit Link" type="submit" /></div>
	</form><span style="float:right"><a href="./quest.php?name=manlink"><strong>[Add new link]</strong></a></span><br /><br />
		</div>
    </center>';
	}
	unset($res);
}

$res = $WEB_PDO->query("SELECT * FROM `pages` ORDER BY position, orderby ASC");

if ($res->rowCount() == 0)
{
	$cont2.= "There are no custom links.<br><br>";
}
else
{
	$a_drugo='0';

	$cont2.= '<br/><center>
        <div class="sub-box1" align="left">
        <strong>Top menu:</strong><br/><br/>';
		
	while ($a2 = $res->fetch(PDO::FETCH_ASSOC))
	{
		if ($a2['position']=='2' && $a_drugo=='0')
		{
			$cont2.= '<br><strong>Bottom menu:</strong><br>';
			$a_drugo='1';
		}
	
		$a_title=explode("[|]", $a2['title']);
		$cont2.= '&nbsp;&nbsp;&nbsp;&nbsp;'.$a_title[0].' <a href="./quest.php?name=manlink&edit='.$a2['id'].'">[edit]</a> <a href="./quest.php?name=manlink&delete='.$a2['id'].'">[delete]</a> <i>(order: '.$a2['orderby'].')</i><br>';       
	}
}
unset($res);

$cont2.='</div></center><br/>';

if (!$_GET['edit'])
{
$cont2.='
<center>
<div class="sub-box1" align="left">
Post a new link:
<form action="./quest.php?name=manlink" style=" padding:5px; " method="post">
<label>Link title:<br/><input name="title" type="text" /><br/></label>

<label>Link path:<br/><input name="link" type="text" value="./" style="width:285px"/></label><br /><br />

<label>Position: <select name="position"><option value="1">Top menu</option><option value="2">Bottom menu</option></select></label>

<label>Order: <input name="orderby" type="text" value="0" style="width:50px; text-align:center" /></label><br><br>
<label>Viewable to:<br/> <select name="viewable">
	<option value="">All</option>
	<option value="1">Guests</option>
	<option value="2">All Logged in</option>
	<option value="3">&nbsp;&nbsp;Only normal players</option>
	<option value="4">&nbsp;&nbsp;Only Admins (az)</option>
	<option value="5">&nbsp;&nbsp;Only GMs and Admins (az and a)</option>	
</select></label><br/><br/>

<label>Description: <input name="descr" type="text" value="" style="width:400px;" /></label><br>
 <div id="log-b2"><input name="submit" value="Add Link" type="submit" /></div></form>
</div>
</center>';
}
$box_wide->setVar("content_title", "Link manager");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();
					