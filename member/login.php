<? 
include('config.php');

$db->check_cookie();
// 已登录自动重定向
is_login();
if($g_config['mobile_domain'] == $g_http_host){  
	include(dirname(__FILE__).'/login.mobile.php');
	exit();
}  
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="GBK" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>会员登录_<?=$g_sitename?></title>
<link type="text/css" rel="stylesheet" href="/member/static/pc/login.css">
<!--[if lt IE 7]>
<link type="text/css" rel="stylesheet" href="/member/static/pc/login-ie6.css">
<![endif]-->
<!--[if lt IE 9]>
<link type="text/css" rel="stylesheet" href="/member/static/pc/login-ie.css">
<![endif]-->
<!--[if lt IE 7]>
<link type="text/css" rel="stylesheet" href="/member/static/pc/login-ie6.css">
<![endif]-->
</head>

<body> 
<div class="log_header"> <a href="/">
	<h1><?=$g_sitename?></h1>
	<img src="/images/logo.png" alt="<?=$g_sitename?>"> </a> <span></span>
	<h2>会员登录</h2>
</div> 

<div class="log_content">  
	<div class="log_con_l"> <img src="/member/static/pc/advertising.jpg" alt="登录"> </div>
 
	<div class="log_con_r">
		<div class="login">  
			<ul class="login_nav ">
				<li class="on"> 会员登录 <span></span> </li>
			</ul>
			<div class="clear"></div> 
			<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe> 
			<div class="content membershipcard ">
				<form action="do.passport?ac=login" target="frm" method="post">  
					<div class="form_line">
						<label>用户名</label>
						<input name="username" id="username" type="text" placeholder="手机 /邮箱 /会籍卡号" autocomplete="off" required/>
						<br>
						<div id="login_error" class="log_error" style="display:none;">验证失败，账号或密码错误！</div>
					</div>

					<div class="form_line">
						<label>密码</label>
						<input name="password" id="password" type="password" maxlength="30" onselectstart="return false"  autocomplete="off" required/> 
					</div>

					<div class="form_line yan">
						<label>验证码</label>
						<input name="verify_code" type="text" autocomplete="off" maxlength="4" required/>
						<img id="randcode" src="libs/vcode/code.php?tm=<?=rand(10000,90000)?>" onclick="javascript:this.src='libs/vcode/code.php?tm='+Math.random();" style="margin-top:6px;"> <a href="javascript:void();" onclick="document.getElementById('randcode').src='libs/vcode/code.php?tm='+Math.random();">换一张</a> <br>
						<div id="vcode_error" class="log_error" style="display:none;">验证码输入错误</div>
					</div>

					<div class="automatic_login">
						<input name="login_day" id="login_day" type="checkbox" checked="checked" value="30" />
						<label>自动登录(30天内有效)</label>
						<span> <a href="/member/findpwd">忘记密码？</a> </span> </div>
					
					<input type="hidden" name="ref" value="<?=req('ref')?>">
					<input type="submit" value="登录" class="subt"/>
				</form>
			</div>
			 
			<div class="other"> 还不是<?=$g_sitename?>的会员？ <span> <a href="/member/register">免费注册</a> </span> </div>
			<div class="other m_20"><!-- 您还可以使用以下方式登录：
				<div class="otherway"> <a href="javascript:;" onclick="toQQ()" class="c0"></a> <a href="javascript:;" onclick="toXinLangWeiBo()" class="c1"></a> <a href="javascript:;" onclick="toAliPay()" class="c3"></a> --></div>
			</div>
		</div>
	</div>
</div>
</body>
</html>