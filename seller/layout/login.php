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
<title>�̼ҵ�¼_<?=$g_sitename?></title>
<!--[if lt IE 11]>
<script type="text/javascript">
alert('�Բ���ϵͳ��֧��IE 11���µ������������ʹ�ùȸ��������360�����������������');
location.replace('/');
</script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="/member/static/pc/login.css">
</head>

<body> 
<div class="log_header"> <a href="/">
	<h1><?=$g_sitename?></h1>
	<img src="/images/logo.png" alt="<?=$g_sitename?>"> </a> <span></span>
	<h2>�̼ҵ�¼</h2>
</div> 

<div class="log_content">  
	<div class="log_con_l"> <img src="/seller/static/image/ad.jpg" alt="��¼"> </div>
 
	<div class="log_con_r">
		<div class="login">  
			<ul class="login_nav ">
				<li class="on"> �̼ҵ�¼ <span></span> </li>
			</ul>
			<div class="clear"></div> 

			<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe> 

			<div class="content membershipcard ">
				<form action="./do.sso?ac=login&hash=<?=strtoupper(substr(md5('CLOOTA_CONSOLE'.date('Ymd')),0,20))?>" target="frm" method="post">  
					<div class="form_line">
						<label>�û���</label>
						<input name="account" id="account" type="text" placeholder="�̼��˺�..." autocomplete="off" required/>
						<br>
						<div id="login_error" class="log_error" style="display:none;">��֤ʧ�ܣ��˺Ż��������</div>
					</div>

					<div class="form_line">
						<label>����</label>
						<input name="password" id="password" type="password" maxlength="30" onselectstart="return false"  autocomplete="off" required/> 
					</div>
 
					<div class="automatic_login">
						<input name="login_day" id="login_day" type="checkbox" checked="checked" value="30" />
						<label>�Զ���¼(30������Ч)</label>
					</div>
					<div id="err" style="text-align:center;color:red"></div>
					<input type="hidden" name="ref" value="<?=req('ref')?>">
					<input type="submit" value="��¼" class="subt"/>
					
				</form>
			</div>
			 
			<div class="other" style="margin-bottom:40px"> ��û���˺ţ� <span> <a href="/union/" target="_blank">�˽Ⲣ�������</a> ��ѯ��<?=$g_profile['hot_line']?></span> </div> 
		</div> 
	</div> 
</div> 
</body>
</html>