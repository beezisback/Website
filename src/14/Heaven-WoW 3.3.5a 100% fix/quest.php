<?php
require_once("header.php"); 
?>
<td id="page2">
<?php

if (isset($_GET['name']))
{
	//check for file itself
	$name = preg_replace( "/[^A-Za-z0-9_!()]/", "", $_GET['name'] ); //only letters and numbers
	if (!@file_exists('./modules/'.$name.'.php'))
	{
		$box_wide = new Template("styles/".$style."/box_wide.php");
		$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
		$cont2= "Error: The page you've entered was not found. Please excuse us for any inconvenience caused.";
		$box_wide->setVar("content_title", "Alert!");	
    	$box_wide->setVar("content", $cont2);					
    	print $box_wide->toString();
	}
	else
	{
		if ($name=='donate_success')
		{
			$box_wide = new Template("styles/".$style."/box_wide.php");
			$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
			$cont2= "Error: The page you've entered was not found. Please excuse us for any inconvenience caused.";
			$box_wide->setVar("content_title", "Alert!");	
    		$box_wide->setVar("content", $cont2);					
    		print $box_wide->toString();
		}
		else
		{
			include "./modules/".$name.".php";
		}
	}
} 
else
{ 
	$box_wide = new Template("styles/".$style."/box_wide.php");
	$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
	$cont2= "Error: The page you've entered was not found. Please excuse us for any inconvenience caused.";
	$box_wide->setVar("content_title", "Alert!");	
    $box_wide->setVar("content", $cont2);					
    print $box_wide->toString();
}
?>
</td>
<?php
$tpl_footer = new Template("styles/".$style."/footer.php");
$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
print $tpl_footer->toString();
//include "./include/timer-footer.php";	