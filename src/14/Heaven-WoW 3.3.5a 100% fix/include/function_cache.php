<?php

/*if (!defined('AXE'))
	exit;*/

function generate_navigation_cache()
{
	global $WEB_PDO, $tpl_header;
	
	$error=false;

	$res = $WEB_PDO->prepare("SELECT * FROM pages ORDER BY position DESC, orderby ASC");
	$res->execute();
	
	$output='<?php'."\n";
	while ($data = $res->fetch(PDO::FETCH_ASSOC))
	{
		
		if ($data['description']=='')
			$wowhead='';
		else
			$wowhead='onmouseover="$WowheadPower.showTooltip(event, &#39;'.$data['description'].'&#39;)" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();"';
		
		$title_link=explode('[|]',$data['title']);
		
		if  ($data['position']=='1')						
			$output.='$tpl_header->gotoNext("link_custom");	
$tpl_header->setVar("link_custom", array("wowhead"=>\''.$wowhead.'\',"title"=>"'.$title_link[0].'","linkpath"=>"'.$data['link'].'"));'."\n";
		else
			$output.='$tpl_header->gotoNext("link_custom2");	
$tpl_header->setVar("link_custom2", array("wowhead"=>\''.$wowhead.'\',"title"=>"'.$title_link[0].'","linkpath"=>"'.$data['link'].'"));'."\n";
	}
	$output.="\n".'?>';
	
	$fh = fopen('./cache/cache_navigation.php', 'wb');
	
	fwrite($fh, $output);

	fclose($fh);

	unset($res);
	
	echo $error;
	
}
