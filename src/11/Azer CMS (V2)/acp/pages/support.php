<?php 
if(isset($_SESSION['acp']))
{
  echo"Do to the large amount of spam I was getting at Ac-Web, the only way you will receive tech support from me is by posting your issues ";
  echo"<a href=\"http://azer-cms.info/forums/index.php?/forum/18-support/\">Here</a>.";
  echo"<br/><br/><b>Note:</b> You must register and login to view the support forum, due to advertising bots. ";
  echo"Before you post a new thread asking for support, search the support forum and see if someone has already asked about the issue and if it has already been solved.";
}
else
{
  header("Location: ../");
}
?>