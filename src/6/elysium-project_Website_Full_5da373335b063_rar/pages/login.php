<?php if (!isset($_SESSION['cw_user'])) { 
 	  if (isset($_POST['login'])) 
	  	account::logIn($_POST['login_username'],$_POST['login_password'],$_SERVER['REQUEST_URI'],$_POST['login_remember']);
?>

<?php include "header.php" ?>

<div class="container">
<div class="row">
<div class="user-panel not-logged">
<button data-target="login-content" class="btn btn-yellow scrollToForm wow rotateInUpLeft">Control Panel</button>
&nbsp; or &nbsp;
<button data-target="registration-content" class="btn btn-green scrollToForm wow rotateInUpRight">Create account</button>
</div>
</div>
</div>

<?php include "right.php" ?>

<section class="main-section with-sidebar">
<div class="newsbox clearfix">
<div class="newsbox clearfix">
<article class="news2 wow bounceInUp first" style="background-image: url(/images/news-1.jpg)">
<span class="ico-horn"></span>
<div class="date">October 09, 2019, 18:58 PM</div>
<div class="">
<h3 class="title">
<a href="/news/183-Dark+Portal+Opening+Event">
New Website </a>
</h3>
<div class="content">
Update [Website] # 2:
Dear players on the project, we have updated our site and a few fixes to the game world. </div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="#" class="btn">Read more</a>
</div>
</article>
<article class="news2 wow bounceInUp " style="background-image: url(/images/news.jpg)">
<span class="ico-horn"></span>
<div class="date">October 04, 2019, 13:58 PM</div>
<div class="news-content">
<h3 class="title">
<a href="#">
Admin </a>
</h3>
<div class="content">
Hello everyone, as of today 04/10/2019 we have added a new Major Oak vendor that gives "Heirlooms" for free. The vendor is located in Horde, Orgrimmar, and Alliance, Stormwind. Thanks for taking the time, enjoyable fun sincerely Admin </div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="#" class="btn">Read more</a>
</div>
</article>
<article class="news2 wow bounceInUp " style="background-image: url(/images/news.jpg)">
<span class="ico-horn"></span>
<div class="date">October 04, 2019, 15:58 PM</div>
<div class="news-content">
<h3 class="title">
<a href="#">
Vote Shop </a>
</h3>
<div class="content">
Our store is ready for work All items are on promotion. </div>
</div>
<div class="readmore">
<div class="fadeout"></div>
<a href="#" class="btn">Read more</a>
</div>
</article>
</div>
<div class="readmore">
<a href="#">All news</a></div>
</div>
</section>
</div>
</div>
</main>

<?php 
account::isLoggedIn();
if ($_POST['register']) {
	account::register($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password_repeat'],$_POST['referer'],$_POST['captcha']);
} 
?>

<section class="section-panel">
<div class="container">
<div class="form-content registration-content active">
<h3 class="title">Register an Account</h3>
<div class="section-content">


<input type="hidden" value="<?php echo $_GET['id']; ?>" id="referer" />
<span id="username_check" style="display:none;"></span>

<div class="errors"></div>
<div class="row">
<div class="form-group">
<label>Your E-mail:</label>
<div class="form-control">
<input id="email" type="text" class="inputbox" alt="email" size="38" placeholder="E-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'E-mail'" value="<?php echo $_POST['email']; ?>">
</div>
</div>
<div class="form-group">
<label>Username:</label>
<div class="form-control">
<input id="username" type="text" class="inputbox" alt="username" size="38" maxlength="16" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Account'" value="<?php echo $_POST['username']; ?>" onkeyup="checkUsername()"/>
</div>
</div>
<div class="form-group">
<label>Password:</label>
<div class="form-control">
<input id="password" type="password" class="inputbox" alt="password" size="38" maxlength="16" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
</div>
</div>
<div class="form-group">
<label>Confirm Password:</label>
<div class="form-control">
<input id="password_repeat" type="password" class="inputbox" alt="Repeat the password" size="38" maxlength="16" placeholder="Repeat the Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Repeat Password'">
</div>
</div>
</div>
<div class="row">
<div class="form-group text-right captcha">
<div id="greCaptcha"></div> </div>
<div class="form-group text-right">

<input type="submit" class="btn btn-green" value="Sign Up" onclick="register(<?php if($GLOBALS['registration']['captcha']==TRUE)  echo 1;  else  echo 0; ?>)" id="register"/>


</div>
</div>
<div class="row text-center">
<div class="form-link">
<a href="" data-target="login-content" class="showFormContent">I already have an Account</a>
</div>
</div>
</form>
</div>
</div>
<div class="form-content login-content">
<h3 class="title">Log In to Your Account</h3>
<div class="section-content">
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="login_form">
<div class="errors"></div>
<div class="row">
<div class="form-group form-group-lg">
<label>Username:</label>
<div class="form-control">
<input type="text" name="login_username" id='customID1'>
</div>
</div>
<div class="form-group form-group-lg">
<label>Password:</label>
<div class="form-control">
<input type="password" name="login_password">
</div>
</div>
</div>
<div class="row">
<div class="form-group text-right captcha"></div>
<div class="form-group text-right">
<button type="submit" class="btn btn-green" name="login" id='customID2'>Log in</button>
</div>
</div>
<div class="row">
<div class="pull-left form-link" style="background-color: transparent; text-align: left; padding: 16px 9px 20px;">
<a href="" data-target="registration-content" class="showFormContent">
I want to Register a New Account </a>
</div>
<div class="pull-right form-link " style="background-color: transparent; text-align: right; padding: 16px 9px 20px;">
<a href="#">
Password recovery </a>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<footer id="footer">
<div class="container">
<div class="row clearfix">
<div id="footer-copy" class="wow fadeInUp">
&copy; 2018 - 2019 <a href="./">Nefelin-WoW Project, Wotlk Server</a>
</div>
</div>
</div>
</footer>
<script type="text/javascript" src="/themes/nefelin/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/themes/nefelin/js/custom.js"></script>



<script>
    var input = document.getElementById('customID1');
    var submit = document.getElementById('customID2');
    
    submit.addEventListener('click', function(event){
        input.value = input.value.replace(/ /g,'');
        console.log(input.value);
    });
</script>
</body>
</html>

<?php } ?>

<?php if(isset($_SESSION['cw_user'])) { ?>
<meta http-equiv="refresh" content="0;url=?p=account">
<?php } ?>