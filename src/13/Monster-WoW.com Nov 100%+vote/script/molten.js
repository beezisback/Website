var timeSys = function(c){
	var timer = new Date(c);
	
	function showDate(b) {
		timer.setSeconds(timer.getSeconds() + 1);
		var date = getDateTime(timer);
			$("#"+b).html(date);
	}
	
	function getDateTime(c) {
		var d = new Date(c);
		var month=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
		var hours = d.getHours();
		var minutes = d.getMinutes();
		var sec = d.getSeconds();
		
		var suffix = "AM";
		if (hours > 12){
			suffix = "PM";
		}
		if (hours < 10){
			hours = "0" + hours;
		}
		if (minutes < 10) {
			minutes = "0" + minutes;
		}

		var TODAY = hours + ":" + minutes;
		return TODAY;
	}
	
	this.showDate = showDate;
	this.getDateTime = getDateTime;
}

function fnChkFrmLg() {
	if (document.frmLogin.strID.value.length == 0 || document.frmLogin.strID.value == "Username") {
		alert ('Please enter a valid username.');
		frmLogin.strID.value = "";
		frmLogin.strID.focus();
		return false;
	}
	if (document.frmLogin.strPW.value.length == 0 || document.frmLogin.strPW.value == "Password") {
		alert ('Please enter a valid password.');
		frmLogin.strPW.value = "";
		frmLogin.strPW.focus();
		return false;
	}
	document.frmLogin.submit();
	return true;
}

function fnChkActFrm() {
	
	if (document.actFrm.activation_code.value.length == 0) {
		alert ('Please insert your activation code.');
		actFrm.activation_code.value = "";
		actFrm.activation_code.focus();
		return false;
	}
	else {
		document.getElementById('actFrm').submit();
		return true;
	}
}

function fnChkResendFrm() {
	if (document.resendForm.resend_activation.value.length == 0 || document.resendForm.resend_activation.value == "Username") {
		alert ('Please enter a valid username.');
		resendForm.resend_activation.value = "";
		resendForm.resend_activation.focus();
		return false;
	}else{
		document.getElementById('resendForm').submit();
		return true;
	}
}

function fnChkRegFrm() {
	if (document.regForm.username.value.length == 0) {
		alert ('Please enter a valid username.');
		regForm.username.value = "";
		regForm.username.focus();
		return false;
	}else if (document.regForm.username.value.length <= 3) {
		alert ('Username must be 4 characters or more.');
		regForm.username.focus();
		return false;
	}
	else if (document.regForm.password.value == document.regForm.username.value) {
		alert ('Please do not use the same password as your username.');
		regForm.password.value = "";
		regForm.password.focus();
		return false;
	}
	else if (document.regForm.password.value.length == 0) {
		alert ('Please enter a valid password.');
		regForm.password.value = "";
		regForm.password.focus();
		return false;
	}
	else if (document.regForm.password.value.length <= 3) {
		alert ('Password must be 4 characters or more.');
		regForm.password.focus();
		return false;
	}
	else if (document.regForm.passwordc.value.length == 0) {
		alert ('Please retype your password.');
		regForm.passwordc.value = "";
		regForm.passwordc.focus();
		return false;
	}
	else if (document.regForm.password.value != document.regForm.passwordc.value) {
		alert ('The passwords you entered did not match.');
		regForm.password.value = "";
		regForm.passwordc.value = "";
		regForm.password.focus();
		return false;
	}
	else if (document.regForm.email.value.length == 0) {
		alert ('Please enter a valid email address.');
		regForm.email.value = "";
		regForm.email.focus();
		return false;
	}
	else if (document.regForm.emailc.value.length == 0) {
		alert ('Please retype your email address.');
		regForm.emailc.value = "";
		regForm.emailc.focus();
		return false;
	}
	else if (document.regForm.email.value != document.regForm.emailc.value) {
		alert ('The email address you entered did not match.');
		regForm.emailc.value = "";
		regForm.emailc.focus();
		return false;
	}
	else if (document.regForm.acceptrules.value == 0) {
		alert ('You must accept our rules and guidelines.');
		return false;
	}
	else {
		document.getElementById('regForm').submit();
		return true;
	}
}

function ChkUser(user){
    $.get("/register/?check=1&user="+user, function (data) {}).success(function (data) {
        if(data){
			if(data == "Taken"){
				$("#checkBtn").css("color","#ff0000");
			}else{
				$("#checkBtn").css("color","#99cc00");
			}
		}
    }).error(function () {}).complete(function () {});
}

function linkLoader(strTarget, strLinkUrl){
	if (strTarget == 'blank'){
		window.open(strLinkUrl);
	}else{
		if (strLinkUrl != '#'){
			location.href = strLinkUrl; return;
		}
	}
}

function acceptRules()
{
	var check = document.getElementById('Rules');
	if(check.className == 'checkBox'){
		document.getElementById('acceptrules').value = 1;
		check.setAttribute("class", "checkBoxClear");
	}else{
		document.getElementById('acceptrules').value = 0;
		check.setAttribute("class", "checkBox");
	}
}

function popUp(URL,height,width){
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(\""+URL+"\", '" + id + "', 'toolbar=0,location=0,statusbar=0,menubar=0,resizable=0,width="+width+",height="+height+",left = 477,top = 174');");
}

function colExp(id,content,exists){
	if(exists == null){
		exists = true;
	}
	var seg  = document.getElementById(id);
	var top = document.getElementById(content);
	if(seg.style.display != "none"){
		seg.style.display = "none";
		if(exists == true){
			top.className = "header";
		}
	}else{
		seg.style.display = "";
		if(exists == true){
			top.className = "header active";
		}
	}
}