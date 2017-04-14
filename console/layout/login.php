<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk"> 
<title>登录 | <?=$g_sys_name?>控制面板</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<script type="text/javascript">
window.onerror = function(){return true;}
if(top.location != location) {top.location.href = location.href;}
</script>
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="http://apps.bdimg.com/libs/fontawesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> 
<link href="http://apps.bdimg.com/libs/animate.css/3.1.0/animate.min.css" rel="stylesheet"> 
<link href="static/image/login.css" rel="stylesheet">
<!--[if lt IE 8]>
<script type="text/javascript">
alert('对不起，系统不支持IE 8.0以下的浏览器，建议使用谷歌、360、火狐浏览器！');
location.replace('/');
</script>
<![endif]-->
<script type="text/javascript">  
function on_focus(){
	document.getElementById('account').focus();
}
function verify(the){
	var tip = document.getElementById('feedback');
	
	if(the.account.value==""){ 
		tip.innerHTML="请输入账号！";
		the.account.focus();
		return false;
	}
	if(the.password.value==""){ 
		tip.innerHTML="请输入密码！";
		the.password.focus();
		return false;
	} 
}
</script>
</head>

<body class="gray-bg" onload="on_focus()">
	<div class="hide_layer">
		<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
	</div> 
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div> 
                <h1 class="logo-name">
				  <?
				  if($g_login['logo']!=''){
					$logo = "/upfiles/$g_siteid/".$g_login['logo'];
				  ?>
				  <img src="<?=$logo?>">
				  <?}else{?>
				  <img src="static/image/logo.png">
				  <?}?>
				</h1> 
            </div>
            <h3>欢迎使用<?=$g_sys_name?></h3>
        
            <p>输入账号和密码登录系统...</p>
            <form class="m-t" role="form" method="post" target="frm" action="./do.sso?ac=login&hash=<?=strtoupper(substr(md5('CLOOTA_CONSOLE'.date('Ymd')),0,20))?>" onsubmit="return verify(this)">
                <div class="form-group">
                    <input type="text" id="account" name="account" class="form-control" placeholder="输入账号..." required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="输入密码..." required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登录</button>
				<p id="err" style="color:red"></p>
            </form>
            <p class="m-t"> <small> &copy; <?=date('Y')?> <?=$g_sys_name?> 版权所有</small> </p>
        </div>
    </div> 
</body>
</html>