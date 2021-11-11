<!--Box-->
<div class="left-bar" id="reg"><div class="left-space">Account Creation</div></div>
<div class="left-mid-box">
<center>By registering an account, you agree to be bound by our terms and conditions.<br/>
To register, fill out the form below, and click register.<br/><br/></center>
<table align="center"><form action="#reg" method="post">
<tr><td>Username:</td> <td><input type="text" name="username" value="Username" id="login" onfocus='if (this.value == "Username") this.value = "";' onblur='if (!this.value){ this.value = "Username"; }' AutoComplete="off"></td></tr>
<tr><td>Password:</td> <td><input type="password" name="password" value="Password" id="login" onfocus='if (this.value == "Password") this.value = "";' onblur='if (!this.value){ this.value = "Password"; }' AutoComplete="off"></td></tr>
<tr><td>Email:</td> <td><input type="text" name="email" value="Email Address" id="login" onfocus='if (this.value == "Email Address") this.value = "";' onblur='if (!this.value){ this.value = "Email Address"; }' AutoComplete="off"></td></tr>
<tr><td><input type="hidden" name="code1" value="{antibot}">{antibot}:</td>
<td><input type="text" name="code2" value="Anti-Bot" id="login" onfocus='if (this.value == "Anti-Bot") this.value = "";' onblur='if (!this.value){ this.value = "Anti-Bot"; }' AutoComplete="off"></td></tr>
<tr><td></td> <td></td></tr>
<tr><td></td> <td align="center"><input type="submit" name="register" class="login" value="Register"></td></tr>
</form></table>
<br/><center>{register}</center>
</div>
<div class="left-foot-box"></div>
<br/>
<!--End Box-->