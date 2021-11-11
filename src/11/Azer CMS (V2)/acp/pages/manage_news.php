<?php 
if(isset($_SESSION['acp']))
{
  print"<b>Post News:</b> To post news, enter a title, and then some information into the body, and click post. BBcode and Smilies are available. You can also use :bull: to post a bullet.<br/><br/>";
  print"<b>Edit News:</b> To edit a news post, select the post you want to edit, and then click edit. Edit what you need, then click post to re-post the edited version.<br/><br/>";
  print"<b>Delete News:</b> To delete a news post, select a post, and select edit, then click delete to delete the post. Remember, once you delete a news post, you can not recover it.";
  print"<br/><br/>";
  print'<table width="100%" align="center" id="grid">';
  news();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>