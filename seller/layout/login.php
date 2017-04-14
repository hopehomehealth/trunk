<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="GBK" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>商家登录_<?=$g_sitename?></title>
<!--[if lt IE 11]>
<script type="text/javascript">
alert('对不起，系统不支持IE 11以下的浏览器，建议使用谷歌浏览器、360浏览器、火狐浏览器！');
location.replace('/');
</script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="/member/static/pc/login.css">
</head>

<body> 
<div class="log_header"> <a href="/">
	<h1><?=$g_sitename?></h1>
	<img src="/images/logo.png" alt="<?=$g_sitename?>"> </a> <span></span>
	<h2>商家登录</h2>
</div> 

<div class="log_content">  
	<div class="log_con_l"> <img src="/seller/static/image/ad.jpg" alt="登录"> </div>
 
	<div class="log_con_r">
		<div class="login">  
			<ul class="login_nav ">
				<li class="on"> 商家登录 <span></span> </li>
			</ul>
			<div class="clear"></div> 

			<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe> 

			<div class="content membershipcard ">
				<form action="./do.sso?ac=login&hash=<?=strtoupper(substr(md5('CLOOTA_CONSOLE'.date('Ymd')),0,20))?>" target="frm" method="post">  
					<div class="form_line">
						<label>用户名</label>
						<input name="account" id="account" type="text" placeholder="商家账号..." autocomplete="off" required/>
						<br>
						<div id="login_error" class="log_error" style="display:none;">验证失败，账号或密码错误！</div>
					</div>

					<div class="form_line">
						<label>密码</label>
						<input name="password" id="password" type="password" maxlength="30" onselectstart="return false"  autocomplete="off" required/> 
					</div>
 
					<div class="automatic_login">
						<input name="login_day" id="login_day" type="checkbox" checked="checked" value="30" />
						<label>自动登录(30天内有效)</label>
					</div>
					<div id="err" style="text-align:center;color:red"></div>
					<input type="hidden" name="ref" value="<?=req('ref')?>">
					<input type="submit" value="登录" class="subt"/>
					
				</form>
			</div>
			 
			<div class="other" style="margin-bottom:40px"> 还没有账号？ <span> <a href="/union/" target="_blank">了解并申请加盟</a> 咨询：<?=$g_profile['hot_line']?></span> </div> 
		</div> 
	</div> 
</div> 
</body>
</html>