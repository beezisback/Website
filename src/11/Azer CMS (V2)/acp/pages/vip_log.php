<?php 
if(isset($_SESSION['acp']))
{
  print'<table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Type</td>
  <td id="title">User</td>
  <td id="title">Email</td>
  <td id="title">Cost</td>
  <td id="title">Date</td>
  <td id="title">Status</td>
  </tr>';

  viplogs();
 print'</table>';
}
else
{
  header("Location: ../");
}
?>