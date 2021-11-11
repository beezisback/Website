<?php
if (!defined('AXE'))
	exit;

//common include
$box_wide = new Template("styles/".$style."/box_wide.php");
//end common include
if (!$a_user['is_guest']) 
{

$cont2= "Logging out failed, Please delete all cookies and sessions or try go to index page and then click on 'Logout'.";
}
else
{
	 $cont2= "You are now logged in! <meta http-equiv='refresh' content='0;url=./'/>";
	//header("Location: accounts.wow");//
	//$cont2= "<font size='4'>You are now logged out.</font><meta http-equiv='refresh' content='0;url=./'/>";
}
$box_wide->setVar("content_title", "Logout");	
$box_wide->setVar("content", $cont2);					
print $box_wide->toString();

?>
<?php
include "top.php";
?>