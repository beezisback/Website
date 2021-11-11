<?php
require_once("header.php"); 
?>
<td id="page2">
<?php
if ($a_user['is_guest']) 
{
	$box_wide = new Template("styles/".$style."/box_wide.php");
	$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
	$cont2= "You are not logged in.";
	$box_wide->setVar("content_title", "Alert!");	
    $box_wide->setVar("content", $cont2);					
    print $box_wide->toString();
	$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
if ($a_user[$db_translation['gm']]<>$db_translation['az'])
{
	$box_wide = new Template("styles/".$style."/box_wide.php");
	$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
	$cont2= "You don't have access to this page.";
	$box_wide->setVar("content_title", "Alert!");	
    $box_wide->setVar("content", $cont2);					
    print $box_wide->toString();
	$tpl_footer = new Template("styles/".$style."/footer.php");
	$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
	print $tpl_footer->toString();
	exit;
}
if (isset($_GET['name']))
{
	//check for file itself
	$name = preg_replace( "/[^A-Za-z0-9_!()]/", "", $_GET['name'] ); //only letters and numbers
	if (!@file_exists('./modules/m_admincp/'.$name.'.php'))
	{
		$box_wide = new Template("styles/".$style."/box_wide.php");
		$box_wide->setVar("imagepath", 'styles/'.$style.'/images/');
		$cont2= "Error: The page you've entered was not found. Please excuse us for any inconvenience caused.";
		$box_wide->setVar("content_title", "Alert!");	
    	$box_wide->setVar("content", $cont2);					
    	print $box_wide->toString();
	}
	else
				include "./modules/m_admincp/".$name.".php";
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
?>
	