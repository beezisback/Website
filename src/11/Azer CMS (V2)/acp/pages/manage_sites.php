<?php 
if(isset($_SESSION['acp']))
{
  print'
  <table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Name</td>
  <td id="title">Cost</td>
  <td id="title">Url</td>
  <td id="title">Img</td>
  <td id="title">Options</td>
  </tr>';
  votesites();
  print'</table>';
}
else
{
  header("Location: ../");
}
?>