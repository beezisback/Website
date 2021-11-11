<!--Box-->
<div class="left-bar" id="reg"><div class="left-space">Realm Status</div></div>
<div class="left-mid-box"><br/>
<div style="margin-left:10px; margin-right:10px;">
Top 10 Slayers
<table width="100%">
  <tr>
	  <td align="center"><u>Name</u></td>
	  <td align="center"><u>Faction</u></td>
	  <td align="center"><u>Race</u></td>
    <td align="center"><u>Class</u></td>
    <td align="center"><u>Total Killed</u></td>
    <td align="center"><u>Kills Today</u></td>
  </tr>
{top}
  <tr>
	<td align="center">{top.name}</td>
	<td align="center"><img src="./global/images/faction/[{top.race}-{top.race}].png" width="18" height="18" /></td>
	<td align="center"><img src="./global/images/race/{top.race}-{top.gender}.gif" width="18" height="18" /></td>
	<td align="center"><img src="./global/images/class/{top.class}.gif" width="18" height="18" /></td>	
	<td align="center">{top.totalKills}</td>
  <td align="center">{top.todayKills}</td>
	</tr>
{/top}
</table>
<br/><br/>
{realm_name}<br/><br/>
<table width="100%">

  <tr>
    <td align="center"><u>Name</u></td>
    <td align="center"><u>Level</u></td>
    <td align="center"><u>Race</u></td>
    <td align="center"><u>Class</u></td>
  <tr>
  
{online_players}
  <tr>
    <td align="center">{online_players.name}</td>
    <td align="center">{online_players.level}</td>
    <td align="center"><img src="./global/images/race/{online_players.race}-{online_players.gender}.gif" border="none"></td>
    <td align="center"><img src="./global/images/class/{online_players.class}.gif" border="none"></td>
  </tr>
{/online_players}

</table>
</div>
</div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->