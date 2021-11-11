<?php 
if(isset($_SESSION['acp']))
{
  if(isset($_GET['action']))
  {
    $action = $_GET['action'];
  
  
    if($action == "search")
    {
      print'
      <form action="?page=manage_characters&action=display" method="post">
      <center><select name="charealm"><option>Select A Realm</option>'; charealm(); print'</select> <input type="text" name="char_name" AUTOCOMPLETE="off" value="Character Name" onfocus=\'if (this.value == "Character Name") this.value = "";\' onblur=\'if (!this.value){ this.value = "Character Name"; }\'> <input type="submit" name="search" value="Search">
      </form>';
    }

    if($action == "display")
    {
      print'
      <table width="100%" align="center" id="grid">
      <tr>
      <td id="title">Account</td>
      <td id="title">Guid</td>
      <td id="title">Name</td>
      <td id="title">Race</td>
      <td id="title">Class</td>
      <td id="title">Gender</td>
      <td id="title">Level</td>
      <td id="title">Money</td>
      <td id="title">Ap</td>
      <td id="title">Honor</td>
      <td id="title">Options</td>
      </tr>';
      charsearch();
      print'</table>';
    }

      if($action == "edit")
      {
      print'
      <table width="100%" align="center" id="grid">
      <tr>
      <td id="title">Guid</td>
      <td id="title">Account</td>
      <td id="title">Name</td>
      <td id="title">Race</td>
      <td id="title">Class</td>
      <td id="title">Gender</td>
      <td id="title">Level</td>
      <td id="title">Money</td>
      <td id="title">Ap</td>
      <td id="title">Honor</td>
      <td id="title">Save</td>
      </tr>';
      charedit();
      print'</table>';
    }
  }
  else
  {
    header("Location: ?page=manage_characters&action=search");
  }
}
else
{
  header("Location: ../");
}
?>