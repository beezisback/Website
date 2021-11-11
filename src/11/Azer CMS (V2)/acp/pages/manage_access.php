<?php 
if(isset($_SESSION['acp']))
{
  print'
  <table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Account Id</td>
  <td id="title">Gm Level</td>
  <td id="title">Realm Id</td>
  <td id="title">Options</td>
  </tr>';
  saccess();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>