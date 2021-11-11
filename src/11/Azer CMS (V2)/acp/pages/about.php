<?php 
if(isset($_SESSION['acp']))
{
  echo"Current CMS Version: 2.0<br/>
Acp Version: 2.0<br/>
Author: Azer<br/>
Core Support: Trinity<br/>
Cata Support: Partial<br/><br/>
<b>Included Features:</b><br/>
Admin Control Panel<br/>
News<br/>
ShoutBox<br/>
Realm Status<br/>
Register<br/>
How To Connect<br/>
Character Unstuck<br/>
Character Revive<br/>
Forgot Password<br/>
Vote Panel/Shop<br/>
V.I.P Panel/Shop<br/>
Manage News<br/>
Manage Vote Sites<br/>
Manage ShoutBox<br/>
Manage Item Store<br/>
Manage Accounts<br/>
Manage Characters<br/>
Manage Realms<br/>
Manage Styles<br/>
Manage Access<br/>
Login Logs<br/>
Vote Logs<br/>
V.I.P Logs<br/>
Top 10 Slayer List<br/><br/>";
  echo"Azer CMS V2 also includes an optional register bridge for <b>Phpbb3</b>.";
}
else
{
  header("Location: ../");
}
?>