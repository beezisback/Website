<?php include "headers.php" ?>
<?php include "menus.php" ?>

<main id="content-wrapper">
<div class="container">
<div class="row">
<div class="column">
<div class="head-content">
<div class="breadcrumbs">
<a href="?p=ucp">
Control Panel </a>
<span class="ico-raquo"></span>
</div>
<div class="realm_picker">
<div class="">
Actual realm: </div>
<a href="#">
Nefelin-WoW </a>
</div>
</div>
<div class="content-box main">
<div class="content-holder">
<div class="content-frame">
<div class="content">
<h2>Change password</h2>
<?php
account::isNotLoggedIn();
if (isset($_POST['change_pass']))
	account::changePass($_POST['cur_pass'],$_POST['new_pass'],$_POST['new_pass_repeat']);
?>

<form action="?p=changepass" method="post">
<div class="row">
<label for="PasswordForm_password">New password</label>:<br />
<input class="default" name="new_pass" type="password" value="" /> </div>

<div class="row">
<label for="PasswordForm_password">Repeat new password</label>:<br />
<input class="default" name="new_pass_repeat" type="password" value="" /> </div>

<div class="row">
<label for="PasswordForm_password">Enter your current password</label>:<br />
<input class="default" name="cur_pass" type="password" value="" /> </div>

<div class="row">
<div class="form-group text-left captcha">
<div id="greCaptcha"></div> </div>
</div>
<div class="row">
<input class="btn btn-yellow" type="submit" name="change_pass" value="Change Password" /> </div>
</form> 
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
<?php include "footer.php" ?>