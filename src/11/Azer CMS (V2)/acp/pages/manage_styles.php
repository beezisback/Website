<?php 
if(isset($_SESSION['acp']))
{
  print"To add a style, enter an Id, (that is not already in use), and then enter the folder name of the style for the name, and set active to 1 for on and 0 for off. The template system will choose the newest active style for use. <b>default</b> is the name of the default style in use, and remember that the name is case sensitive.<br/><br/>";
  print'
  <table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Name</td>
  <td id="title">Active</td>
  <td id="title">Option</td>
  </tr>';
  style();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>