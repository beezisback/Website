<?php 
if(isset($_SESSION['acp']))
{
  print'<table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Type</td>
  <td id="title">Character</td>
  <td id="title">Item</td>
  <td id="title">Cost</td>
  <td id="title">Date</td>
  <td id="title">Status</td>
  </tr>';

  storelogs();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>