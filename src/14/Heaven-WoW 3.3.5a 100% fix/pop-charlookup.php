<?php

require "include/common.php";

if (!defined('AXE')) exit;

//if session set, then we shoudlnt be here
if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]==$db_translation['az']) 
{ 
	?>
	<html><head><title>Character GUID look-up</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="styles/default/style-popup.css" rel="stylesheet" type="text/css">
    </head><body>
	<div align="center">
    <div class="pop-inside-box" align="left">
	<form action="" method="post">
	Select realm:<br/>
    <select name="realm">
	<?php
	foreach ($realm as $id => $data)
	{
		print '<option value="'.$id.'">'.$data['name'].'</option>';
	}
	
	?></select>
	<br>Character name:<br>
	<input name="name" type="text">
	<div id="log-b3"><input name="action" type="submit" value="Search"></div>
	</form>
	<br>
	<?php
	if (isset($_POST['action']))
	{
		$realm2 = (int)$_POST['realm'];

		$REALM_DB = newRealmPDO($realm2);

		$name = $_POST['name'];
		
		$res = $REALM_DB->prepare("SELECT ".$db_translation['characters_guid'].", ".$db_translation['characters_name']." FROM `".$db_translation['characters']."` WHERE `".$db_translation['characters_name']."` = :name LIMIT 1");
		$res->bindParam(':name', $name, PDO::PARAM_STR);
		$res->execute();
		
		if ($res->rowCount() == 0)
		{
			print "There is no characters with name '".$name."'.";
		}
		else
		{
			$a1 = $res->fetch(PDO::FETCH_ASSOC);
			print 'Name: <strong>'.$a1[$db_translation['characters_name']].'</strong>  GUID: <strong>'.$a1[$db_translation['characters_guid']].'</strong>';
		}
		unset($res);
		unset($REALM_DB);
	}
}
?>
</div>
</div>
</body>
</html>