<?   
if(is_weixin()==true){  
	if(is_weixin_login()==false){   
		include(dirname(__FILE__).'/weixin/wx_login.php'); 
		exit();
	}  
} 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>�ʺŵ�¼ - <?=$g_sitename?></title>
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">
<link href="/member/static/mobile/login.css" rel="stylesheet" type="text/css"> 
</head>
<body> 
<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
<section class="signup"> <a href="/" class="logo"></a>
	<ul class="Nav-tab">
		<li class="on"><a href="javascript:void(0)">�û���¼</a></li>
	</ul>
	<form action="do.passport?ac=login" method="post" id="_j_login_form" target="frm"> 
		<ul class="forms">
			<li>
				<input name="username" type="text" class="input" placeholder="�����ֻ���..." autocomplete="off" value="">
			</li>
			<li>
				<input name="password" type="password" class="input" placeholder="��������..." autocomplete="off" value="">
			</li>
			<li>
				<input name="verify_code" type="number" class="input" style="width:50%" autocomplete="off" maxlength="4" required/> <img id="randcode" src="libs/vcode/code.php?tm=<?=rand(10000,90000)?>" onclick="javascript:this.src='libs/vcode/code.php?tm='+Math.random();" /> 
				<a href="javascript:void();" onclick="document.getElementById('randcode').src='libs/vcode/code.php?tm='+Math.random();">��һ��</a>
			</li>
		</ul>
		<div class="links"><a href="/member/findpwd">�������룿</a></div>
		<div class="btns">
			<div id="login_error" style="font-size:14px;color:red;text-align:center;display:none;">�Բ����˺Ż��������</div>
			<button class="btn" type="submit">��¼</button>
			<button onclick="location.replace('/member/register?ref=<?=urlencode(req('ref'))?>')" class="btn" type="button">����ע��</button>
		</div>
		<input type="hidden" name="ref" value="<?=urlencode(req('ref'))?>">
	</form>
</section> 
</body>
</html>