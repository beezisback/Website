<?php 
if(isset($_SESSION['acp']))
{
  print'<table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Account</td>
  <td id="title">Ip</td>
  <td id="title">Date</td>
  <td id="title">Status</td>
  <td id="title">Type</td>
  </tr>';

  loginlogs();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>