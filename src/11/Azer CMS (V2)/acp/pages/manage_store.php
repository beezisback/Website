<?php 
if(isset($_SESSION['acp']))
{
  print"With Azer CMS V1.5 there were problems with the item store, because I didn't explain what the type field should be set to. Well all it does is define wether the item should be placed inside the <b>Vote</b> section, or the <b>V.I.P</b> section. The value of type should be vote or vip.";
  print"<br/><br/>";
  print'
  <table width="100%" align="center" id="grid">
  <tr>
  <td id="title">Id</td>
  <td id="title">Name</td>
  <td id="title">Item Id</td>
  <td id="title">Amount</td>
  <td id="title">Cost</td>
  <td id="title">Type</td>
  <td id="title">Realm</td>
  <td id="title">Options</td>
  </tr>';
  store();
  print'</table>';
}
else
{
  header("Location: ../");
}