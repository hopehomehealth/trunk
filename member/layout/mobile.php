<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
$view_file = dirname(dirname(__FILE__)).'/mobile/'.$cmd; 

$avatar = $g_member['avatar'];

if($avatar==''){
	$avatar = '/member/static/mobile/user.png';
}
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk"/>
<title><?if($g_console_debug==true) echo $cmd?><?=$g_sitename?> - 会员中心</title>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui" />
<meta name="copyright" content="Copyright (c) <?=date('Y')?> <?=$g_sitename?>" />
<meta name="format-detection" content="telephone=no,address=no" />
<meta name="referrer" content="always" />

<link href="/member/static/mobile/mobile.css" rel="stylesheet" type="text/css"/> 
<script type="text/javascript" src="/ajax/jquery-1.7.2.min.js"></script>

</head>
<body>
<header class="m-frm-head">
	<div class="left-btn" onclick="history.back()"><a class="btn2 back" href="javascript:history.back()" ></a> </div>
	<div class="center-btn">
		<h1><span onclick="location.replace('/member/')">我的账户</span></h1>
	</div>
	<div class="right-btn"> <a href="/" role="button" class="btn2 search" id="_j_topsetting"></a>
		<div class="setpop" id="_j_topsetting_list" style="display:none">
			<div class="con"> <a href="/member/logout" id="btn_logout">退出登录</a> <a href="#" id="btn_changeuser">切换帐号</a> </div>
		</div>
	</div>
</header>
<?if(is_file($view_file)==false){?>
<section class="user">
	<div class="user-info" style="background-image:url(/member/static/mobile/userbg.jpg);">
		<div class="user-photo"><img src="<?=$avatar?>"></div>
		<div class="user-level"> <span class="name"><?=$g_member['account']?></span> <span class="lv">V<?=$g_member['user_level']?></span> </div>
		 
		<?if($g_member['nickname']!=''){?><div class="autograph">签名：<?=$g_member['nickname']?></div><?}?>
	</div>
</section>
<br/><br/>
<?}?>
<? 
if(is_file($view_file)==true){
?>
	<div id="" style="padding:12px">
		<?include($view_file);?>
	</div>
<?
} else {  
?> 
<section class="m-frm-list-index m-frm-li-index">
	<ul>  
		<li class="huodong"><a href="<?=url('order.php')?>"><span class="icon"></span>我的订单</a> <a href="/" class="dakaBtn on" style="margin-top:-40px">去选购</a> </li>
		<li class="order"><a href="<?=url('bill.php')?>"><span class="icon"></span>支付记录<i class="arrow"></i></a></li>
 		<li class="dianping"><a href="<?=url('comment.php')?>"><span class="icon"></span>我的点评<i class="arrow"></i></a></li> 
		<li class="youji"><a href="<?=url('address.php')?>"><span class="icon"></span>常用地址<i class="arrow"></i></a></li>
		<li class="wengweng"><a href="<?=url('profile.php')?>"><span class="icon"></span>个人资料<i class="arrow"></i></a></li>
		<li class="jieban"><a href="<?=url('passwd.php')?>"><span class="icon"></span>更改密码<i class="arrow"></i></a></li>
		<li class="wallet"><a href="/member/logout" onclick="return confirm('确认退出账户？');"><span class="icon"></span>安全退出<i class="arrow"></i></a></li>
	</ul>
</section>
<?}?>   
</body>
</html>