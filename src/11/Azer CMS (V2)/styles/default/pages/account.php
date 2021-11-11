<!--Box-->
<div class="left-bar" id="info"><div class="left-space">{login=Account Panel: Information}404 Site Login Error{/login}</div></div>
<div class="left-mid-box"><br/>
<div style="margin-left:10px;">
{login=
<!---->
{user_get}
Username: <font color="#90cf5d">{session}</font><br/>
Email: {user_get.email}<br/>
Join Date: {user_get.joindate}<br/>
Site Rank: {user_admin}<br/>
Current Ip: {user_curip}<br/>
Last Ip: {user_get.last_ip}<br/>
Expansion: {user_get.expansion}<br/>
Vote Points: {user_get.vp}<br/>
V.I.P Points: {user_get.dp}<br/>
Banned: {banned}<br/>
{/user_get}
<!---->
}You must login to access this page.{/login}
</div>
</div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->

{login=
<!--Box-->
<div class="left-bar" id="char"><div class="left-space">Account Panel: Character Tools</div></div>
<div class="left-mid-box"><br/>
<div style="margin-left:10px;">
<table align="center"><form action="?page=account#char" method="post">
<tr><td><select name="chart" id="unstuck"><option value="None">Choose A Character</option>
{view_realm}<option value="none">---{view_realm.name}---</option>{view_chars}<option value="{view_chars.2}-{view_realm.id}">{view_chars.4}</option>{/view_chars}{/view_realm}
</select></td></tr>
<tr><td></td></tr>
<tr><td align="center"><input type="submit" name="tool" class="login" value="Unstuck"></td></tr>
</form></table>
{unstuck_revive}
</div>
</div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->

<!--Box-->
<div class="left-bar" id="pass"><div class="left-space">Account Panel: Change Password</div></div>
<div class="left-mid-box"><br/>
<div style="margin-left:10px;">
<table align="center"><form action="?page=account#pass" method="post">
<tr><td>Old Password:</td> <td><input type="password" name="opass" id="login"></td></tr>
<tr><td>New Password:</td> <td><input type="password" name="npass" id="login"></td></tr>
<tr><td>Confirm Password:</td> <td><input type="password" name="cpass" id="login"></td></tr>
<tr><td></td> <td></td></tr>
<tr><td></td> <td align="center"><input type="submit" name="change" value="Change" class="login"></td></tr>
</form></table>
{change_password}
</div>
</div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->
}{/login}