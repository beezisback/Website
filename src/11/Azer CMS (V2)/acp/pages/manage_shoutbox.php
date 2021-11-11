<?php 
if(isset($_SESSION['acp']))
{
  print'
  <table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Author</td>
  <td id="title">Body</td>
  <td id="title">Date</td>
  <td id="title">Option</td>
  </tr>';
  shoutbox();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>