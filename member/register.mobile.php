<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>���û�ע�� - <?=$g_sitename?></title>
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">
<link href="/member/static/mobile/login.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript">
function send_sms(){
	document.getElementById("registerForm").target = "frm";
	document.getElementById("registerForm").action = "do.passport?ac=register_sms";
	document.getElementById("registerForm").submit();
}
</script>
</head>
<body> 
<section class="signup"> <a href="/" class="logo"></a>
	<ul class="Nav-tab">
		<li class="on"><a href="javascript:void(0)">���û�ע��</a></li>
	</ul>
	<form action="do.passport?ac=register" method="post" id="registerForm" target="frm"> 
		<ul class="forms">
			<li>
				<input name="username" type="text" class="input" placeholder="�����ֻ���..." autocomplete="off" value="">
			</li>
			<li>
				<input name="password" type="password" class="input" placeholder="��������..." autocomplete="off" value="">
			</li>
			<li>
				<input name="repassword" type="password" class="input" placeholder="�ٴ�ȷ������..." autocomplete="off" value="">
			</li>
			<li>
				<input name="verify_code" type="number" class="input" style="width:50%" autocomplete="off" maxlength="4" required/> <img id="randcode" src="libs/vcode/code.php?tm=<?=rand(10000,90000)?>" onclick="javascript:this.src='libs/vcode/code.php?tm='+Math.random();" /> 
				<a href="javascript:void();" onclick="document.getElementById('randcode').src='libs/vcode/code.php?tm='+Math.random();">��һ��</a>
			</li>
			<li>
				<input name="phone_code" type="number" class="input" style="width:50%" placeholder="�ֻ���֤��..." autocomplete="off" value="">
				<a href="javascript:;" onclick="send_sms()"><strong>������֤��</strong></a>
			</li> 
		</ul> 
		<div class="btns">
			<button class="btn" type="submit">����ע��</button>
			<button onclick="location.replace('/member/login?ref=<?=urlencode(req('ref'))?>')" class="btn" type="button">���ϵ�¼</button>
		</div>
		<input type="hidden" name="ref" value="<?=urlencode(req('ref'))?>">
	</form>
</section> 
<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
</body>
</html>