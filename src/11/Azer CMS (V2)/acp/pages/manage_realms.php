<?php 
if(isset($_SESSION['acp']))
{
  print'
  <table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Name</td>
  <td id="title">Type</td>
  <td id="title">Char_db</td>
  <td id="title">Port</td>
  <td id="title">Ra Port</td>
  <td id="title">Limit</td>
  <td id="title">Options</td>
  </tr>';
  realmlist();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>