<?php 
if(isset($_SESSION['acp']))
{
  echo"<b>Welcome</b>, to your new Admin Control Panel, powered by Azer CMS V2, the latest and greatest <b>free</b> website CMS for TrinityCore.<br/><br/>";
  echo"<b>Need Tech Support?</b> If so, you can find instructions for tech support, by going to the tech support page found on the menu system under 'Website Info'.";
  echo" Please remember to post all bugs <a href=\"http://azer-cms.info/forums/index.php?/forum/9-cms-v15/\">here</a>.<br/><br/>";
  echo"<b>Craving a new style for your site?</b> If so, you can find many new styles for your website";
  echo" <a href=\"http://azer-cms.info/forums/index.php?/forum/5-styles/\">here</a>.";
}
else
{
  header("Location: ../");
}
?>