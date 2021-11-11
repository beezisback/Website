<?php
if (!defined('AXE'))
	exit;
//common include
$box_simple_wide = new Template("styles/".$style."/box_simple_wide.php");
$box_wide = new Template("styles/".$style."/box_wide.php");
$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_wide->setVar("imagepath", 'styles/'.$style.'/images/');
//end common include

foreach ($realm as $id => $data)
{
	$cont2.=
	$data['name']." - 
	<div style='width:200px; height:20px;'> <span id='server".$id."'></span>
	<script type='text/javascript'>ajax_loadContent('server".$id."','./dynamic/status.php?id=".$id."');</script> </div><br>";
}	
			
$box_wide->setVar("content_title", "Realm Status");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();	