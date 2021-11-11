<!--Box-->
<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
<div class="left-bar" id="reg"><div class="left-space">Vote / V.I.P Store</div></div>
<div class="left-mid-box"><br/>
<div style="margin-left:10px; margin-right:10px;">
{login=
<table><tr><td>
<table align="center"><form action="?page=store#reg" method="post">
<tr><td><select name="realm" id="unstuck"><option value="0">Select A Realm</option>

{view_realm}
<option value="{view_realm.id}">{view_realm.name}</option>
{/view_realm}

</select></td></tr>
<tr><td></td></tr>
<tr><td align="center"><input type="submit" name="select" class="login" value="Select"></td></tr>
</form></table>
</td><td>
<table align="center"><form action="#reg" method="post">
<tr><td><select name="char" id="unstuck"><option value="0">Characters</option>

{view_char}
<option value="{char_view_db}-{view_char.2}-{char_view_id}">{view_char.4}</option>
{/view_char}


</select></td></tr>
<tr><td></td></tr>
<tr><td align="center"><input type="submit" name="buy" class="login" value="Purchase"></td></tr>
</table>
</td></tr>
</table>
<!--Category-->
<table><tr>
<td valign="top"><img src="./global/images/store/max.png" border="" onclick="return toggleMe('store_vote')" value="Vote Items" style="cursor:pointer;"></td>
<td valign="top">Vote Items</td>
</tr></table>
<div id="store_vote" style="display:none">

{view_vitem}
<a href="#" rel="item={view_vitem.item_id}">{view_vitem.name}</a> (x{view_vitem.amount}) - Cost: {view_vitem.cost} Vote Points. <input type="radio" name="item" value="{view_vitem.type}-{view_vitem.item_id}-{view_vitem.cost}-{view_vitem.amount}"><br/>
{/view_vitem}

</div>

<!--Category-->
<table><tr>
<td valign="top"><img src="./global/images/store/max.png" border="" onclick="return toggleMe('store_vip')" value="V.I.P Items" style="cursor:pointer;"></td>
<td valign="top">V.I.P Items</td>
</tr></table>
<div id="store_vip" style="display:none">

{view_ditem}
<a href="#" rel="item={view_ditem.item_id}">{view_ditem.name}</a> (x{view_ditem.amount}) - Cost: {view_ditem.cost} V.I.P Points. <input type="radio" name="item" value="{view_ditem.type}-{view_ditem.item_id}-{view_ditem.cost}-{view_ditem.amount}"><br/>
{/view_ditem}

</div>
<br/></form>
{store_purchase}
}You must login to access this page.{/login}
</div>
</div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->