<?php 
if(isset($_SESSION['acp']))
{
  if(isset($_GET['action']))
  {
    $action = $_GET['action'];
  
    if($action == "search")
    {
      print"Azer CMS V1.5 only allowed you to search accounts by name, which was a small problem because the manage character tool, only listed the parent account's id. With V2, you can now search for an account by entering the username, account id, or email address.";
      print"<br/><br/>";
      print'
      <form action="?page=manage_accounts&action=display" method="post">
      <center> Search & Edit User Accounts <input type="text" name="acc_name" AUTOCOMPLETE="off"> <input type="submit" name="search" value="Search">
      </form>';
    }

    if($action == "display")
    {
      print'
      <table width="100%" align="center" id="grid">
      <tr>
      <td id="title">Id</td>
      <td id="title">Username</td>
      <td id="title">Email</td>
      <td id="title">Expansion</td>
      <td id="title">Locked</td>
      <td id="title">Acp</td>
      <td id="title">Staff Id</td>
      <td id="title">Vp</td>
      <td id="title">Dp</td>
      <td id="title">Options</td>
      </tr>';
      accsearch();
      print'</table>';
    }

    if($action == "edit")
    {
      print'
      <table width="100%" align="center" id="grid">
      <tr>
      <td id="title">Id</td>
      <td id="title">Username</td>
      <td id="title">Email</td>
      <td id="title">Expansion</td>
      <td id="title">Locked</td>
      <td id="title">Acp</td>
      <td id="title">Staff Id</td>
      <td id="title">Vp</td>
      <td id="title">Dp</td>
      <td id="title">Save</td>
      </tr>';
      accedit();
      print'</table>';
    }
  }
  else
  {
    header("Location: ?page=manage_accounts&action=search");
  }
}
else
{
  header("Location: ../");
}
?>