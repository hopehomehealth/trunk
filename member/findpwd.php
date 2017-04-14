<? 
include('config.php');
 

is_login(); // 已登录自动重定向

if($g_config['mobile_domain'] == $g_http_host){ 

	include(dirname(__FILE__).'/findpwd.mobile.php');
	exit;
}  
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="GBK" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>找回密码_<?=$g_sitename?></title>
<link type="text/css" rel="stylesheet" href="/member/static/pc/register.css">
  
<script type="text/javascript">
//电话号码验证
function isPhone(v){
      var reg=/^1[0-9]{10}/;
      if(!reg.test(v)){
        //alert("请正确填写手机号！");
        //obj.value="";
		return false;
      } else {
		return true;
	  }
}
        
function checkUsername(v){
	if(isPhone(v) == true) { 
		document.getElementById('mobileCodeInput').style.display = 'block';
	}
}

function checkForm(obj){
	var username_value = obj.username.value;
	if(isPhone(username_value) == false && isEmail(username_value) == false) {   
		document.getElementById('mobileError').style.display = 'block';
		return false
	}

	if(document.getElementById('readAgreement').checked == false){
		document.getElementById('agreementError').style.display = 'block';
		return false
	} 
}

function checkAndGetStrength() {
	if(checkPassword()) {
		getStrength();
	}
}

function setInnerText(element, text) {
    if (typeof element.textContent == "string") {
        element.textContent = text;
    } else {
        element.innerText = text;
    }
} 

function checkPassword() {
	var password = document.getElementById("password").value;
	if(password == null || password == '') {
		document.getElementById("pswdSuccess").style.display='none'; 
		setInnerText(document.getElementById("pswdError"),'密码长度不小于6位');
		document.getElementById("pswdError").style.display = '';
		return false;
	}
	if(password.length < 6) {
		document.getElementById("safetydegree").className = 'safetydegree on-ruo';
		document.getElementById("strength").value = '弱';
		document.getElementById("pswdSuccess").style.display='none';
		setInnerText(document.getElementById("pswdError"),'密码长度不小于6位');
		document.getElementById("pswdError").style.display = '';
		return false;
	} else {
		if(password=="111111" || password=="222222" || password=="333333" || password=="444444" || password=="555555"
    		|| password=="666666" || password=="777777" || password=="888888" || password=="999999" || password=="000000"
    		|| password=="123456" || password=="654321") {
    		document.getElementById("pswdSuccess").style.display='none';
    		setInnerText(document.getElementById("pswdError"),'您的密码太简单，为了保证您的个人资料不被泄漏，请设置更复杂的密码。'); 
			document.getElementById("pswdError").style.display = '';
       	 	return false;
    	} 
		document.getElementById("pswdError").style.display = 'none';
		document.getElementById("pswdSuccess").style.display='';
		return true;
	}
} 

function getStrength() {
	var password = document.getElementById("password").value;
	if(password == null || password == '') {
		document.getElementById("safetydegree").style.display='none';
	} else {
		document.getElementById("safetydegree").style.display='';
	}
	if(password.length <= 6) {
		document.getElementById("safetydegree").className = 'safetydegree on-ruo';
		document.getElementById("strength").value = '弱';
	}
	if(password.length > 6 && password.length <= 9) {
		document.getElementById("safetydegree").className = 'safetydegree on-zhong';
		document.getElementById("strength").value = '中';
	}
	if(password.length > 9) {
		document.getElementById("safetydegree").className = 'safetydegree on-qiang';
		document.getElementById("strength").value = '强';
	}
}

function checkRepassword() {
	var rePassword = document.getElementById("repassword").value;
	var password = document.getElementById("password").value;
	if(password == null || password == "") {
		document.getElementById("rePswdSuccess").style.display='none';
		document.getElementById("rePswdError").style.display='none';
		return false;
	}
	if(password == rePassword) {
		document.getElementById("rePswdError").style.display='none';
		document.getElementById("rePswdSuccess").style.display='';
		return true;
	} else {
		document.getElementById("rePswdError").style.display='';
		setInnerText(document.getElementById("rePswdError"),'确认密码不正确'); 
		document.getElementById("rePswdSuccess").style.display='none';
		return false;
	}
} 

function send_sms(){
	document.getElementById("registerForm").target = "frm";
	document.getElementById("registerForm").action = "do.passport?ac=findpwd_sms";
	document.getElementById("registerForm").submit();
}
</script>
</head>

<body> 
	<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>

	<div class="log_header">
		<a href="/">
			<h1><?=$g_sitename?></h1> <img src="/images/logo.png" alt="<?=$g_sitename?>">
		</a> <span></span>
		<h2>找回密码</h2>
	</div> 

	<div class="log_content">
		<div class="log_big"> 
			<div class="registered "> 
				<ul class="registered_nav clear">
					<li class="on">找回密码 <span></span>
					</li> 
				</ul>
				 
				<div class="membership mgw_card" id="registerInputDiv"> 
					<form id="registerForm" action="do.passport?ac=findpwd" method="post" onsubmit="return checkForm(this)">    
 
						<div class="form_line">
							<label for="mobileNo"><span>*</span>手机号</label> <input name="username" id="mobileNo" 
								type="text" value="" placeholder="输入手机号..." onblur="checkUsername(this.value);" autocomplete="off" required/>
							<div class="tishi">手机号</div>
							<div id="mobileSuccess" class="mber_success" style="display:none;"></div>
							<div id="mobileError" class="mber_error" style="display:none;">
								请正确填写你的手机号码或邮箱，以便我们确认你的预订服务</div>
						</div> 
						<div id="emailCodeInput" class="verification_code_email" >
							<label for="name">校验码</label> <input name="verify_code" type="text" value="" autocomplete="off" maxlength="4" required/> <img id="randcode" src="libs/vcode/code.php?tm=<?=rand(10000,90000)?>" onclick="javascript:this.src='libs/vcode/code.php?tm='+Math.random();" /> <a href="javascript:void();" onclick="document.getElementById('randcode').src='libs/vcode/code.php?tm='+Math.random();">换一张</a>
								<div class="log_error" style="display:none;">请输入正确的校验码</div>
						</div>
						<div id="mobileCodeInput" class="verification_code_phone" style="display:none">
							<label for="inputCode">手机验证码</label> <input name="phone_code" id="phone_code" type="text" value="" autocomplete="off" maxlength="6"/> 
							<div class="resend" id="sendCodeBtn" onclick="send_sms()">发送验证码</div>
						</div> 
						<div class="form_line">
							<label for="password"><span>*</span>设置新密码</label> 
							<input name="password" id="password" type="password" 
								value="" placeholder="6-12位数字" onkeyup="checkAndGetStrength()" onblur="checkAndGetStrength()" maxlength="12" 
								onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" autocomplete="off" required/>
							<div class="tishi">6-12位数字</div>
							<div id="pswdSuccess" class="mber_success" style="display:none;"></div>
							<div id="pswdError" class="mber_error" style="display:none;"></div>
						</div> 

						<div id="safetydegree" class="safetydegree on-ruo">
							安全程度 
							<span class="ruo">弱</span> 
							<span class="zhong">中</span> 
							<span class="qiang">强</span>
						</div>
						 
						<div class="form_line">
							<label for="password"><span>*</span>确认新密码</label> <input name="repassword" id="repassword" 
							type="password" value="" placeholder="再次输入密码" onblur="checkRepassword()" 
							onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" autocomplete="off" required/>
							<div class="tishi">再次输入密码</div>
							<div id="rePswdSuccess" class="mber_success" style="display:none;"></div>
							<div id="rePswdError" class="mber_error" style="display:none;"></div>
						</div> 
 
						<input id="btn_submit" type="submit" value="确定" class="members_submit" style="width:100px"/> 
					</form>
				</div> 
			</div>
		</div>
	</div> 
</body> 
</html>