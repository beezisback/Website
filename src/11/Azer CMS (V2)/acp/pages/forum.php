<?php 
if(isset($_SESSION['acp']))
{
  echo"With Azer CMS V2, you can now activate a register bridge between your <b>Phpbb3</b> forums, and the site registration page. The bridge will allow user to create both their forum and game account by using the register page in the website, instead of having to make each account separate. You can activate the forum bridge below, but make sure to specify the location of your <b>Phpbb3</b> install starting with ./ with no ending /.";
  forum();
}
else
{
  header("Location: ../");
}
?>