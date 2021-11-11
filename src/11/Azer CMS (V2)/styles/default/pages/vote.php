<!--Box-->
<div class="left-bar" id="vote"><div class="left-space">Vote For Us</div></div>
<div class="left-mid-box"><div style="margin-left:10px; margin-right:10px;"><br/>
<br/>
<table width="500px" align="center">
  <tr>
    <td align="center" width="33%">Site</td>
    <td align="center" width="33%">Points</td>
    <td align="center" width="33%">Banner</td>
  </tr>
  
{view_sites}
  <tr>
    <td align="center">{view_sites.name}</td>
    <td align="center">{view_sites.cost}</td>
    <td align="center">
  <form action="#vote" method="post" name="vote-{view_sites.id}">
    <input type="image" src="{view_sites.img}" border="none" OnClick="document['vote-{view_sites.id}'].submit(); window.open('{view_sites.url}', '_BLANK'); return false;">
    <input type="hidden" name="site" value="{view_sites.id}">
  </form>
    </td>
  </tr>
{/view_sites}
  
</table>
{vote}
</div></div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->