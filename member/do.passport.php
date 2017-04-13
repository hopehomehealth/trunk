<?
session_start();
header("Content-type: text/html; charset=GBK");
include('config.php');

$ac		= req('ac');
$ymd	= date('Y-m-d H:i:s');


/// 用户登录
if($ac == 'login'){ 
	$username	= req('username');
	$password	= req('password');

	if(strlen($username)<3 || strlen($password)<3) { 
		js('parent.document.getElementById("login_error").style.display="block"');
		exit;
	} 

	if($_SESSION['rand_code'] != req('verify_code') || req('verify_code')=='') { 
		js('alert("对不起，验证码错误！")');
		exit;
	} 

	$sql = "SELECT * FROM `t_user` WHERE `account`='$username' AND `password`=MD5('$password') AND `site_id`='$g_siteid' AND `state`='1' ";  
	$login_user = $db->get_one($sql); 
	 
	if($login_user['user_id'] != ''){ 
		setcookies('CLOOTA_B2B2C_USER_UUID', $login_user['user_id']);  

		/// 更新微信ID
		$weixin_id = $_COOKIE['CLOOTA_B2B2C_WEIXIN_ID']; 
		if($login_user['weixin_id'] == '' && $weixin_id != ''){ 
			$sql = "UPDATE `t_user` SET `weixin_id`='".$weixin_id."' WHERE `site_id`='$g_siteid' AND `user_id`='".$login_user['user_id']."'";  
			$db->query($sql); 
		}

		/// 转移到我的账户
		if(req('ref')!=''){
			$ref = urldecode(req('ref'));
			$ref = str_replace('&amp;','&',$ref);
			gotop($ref);
		} else {
			gotop(url('order.php'));
		} 
	} else {
		//senderror('对不起，帐号或密码错误！');
		js('parent.document.getElementById("login_error").style.display="block"');
		exit;
	} 
}

/// 短信验证
if($ac == 'register_sms'){  
	$sms_mobile		  = req('username');
	$user_verify_code = strtolower(req('verify_code'));
	$sys_verify_code  = $_SESSION['rand_code'];
	
	if($user_verify_code != $sys_verify_code || $user_verify_code==''){
		sendwarn('校验码错误！');
		exit;
	}

	if(strlen($sms_mobile)!=11) {
		sendwarn('手机号不正确！');
		exit;
	}

	// 同一站点的用户名不能重复
	$sql = "SELECT user_id FROM `t_user` WHERE `account`='$sms_mobile' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id!=''){
		sendwarn('对不起，手机号已经存在！');
		exit;
	}
	
	$sms_code = rand(1000, 9000);
	setcookie('SMS_CODE', false, -1, '/');
	setcookie('SMS_CODE', $sms_code, 0, '/');

	$rs = send_sms($sms_juhe_id_reg, $sms_mobile, $sms_code, '', '');
?>
<script type="text/javascript">
parent.document.getElementById("registerForm").action = "do.passport?ac=register";
</script>
<?

	if($rs==true){
		sendwarn('验证码短信已经发送到您的手机！'); 
	} else {
		sendwarn('短信发送失败，请重试！');
	}
}


/// 注册
if($ac == 'register'){ 
	$username		= req('username');
	$password		= req('password');
	$repassword		= req('repassword');
	 
	if(strlen($username)<5) {
		senderror('用户名不能小于5个字符！');
	}
	if(strlen($password)<5) {
		senderror('密码不能小于5个字符！');
	}

	if($username == $password) {
		senderror('用户名和密码不能相同！');
	}

	if($password!=$repassword) {
		senderror('两次输入的密码不一致！');
	}
	 
	if($_COOKIE['SMS_CODE'] != req('phone_code') || req('phone_code')=='') {
		senderror('对不起，手机验证码错误！');
	} 

	// 同一站点的用户名不能重复
	$sql = "SELECT user_id FROM `t_user` WHERE `account`='$username' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id!=''){
		senderror('用户名已存在！');
	}

	// MD5加密
	$password = md5($password);

	$weixin_id = $_COOKIE['CLOOTA_B2B2C_WEIXIN_ID'];

	$sql = "INSERT INTO `t_user` (`site_id`, `account`, `password`,  `reg_type`, `state`, `weixin_id`, `addtime` ) VALUES ('$g_siteid', '$username', '$password', 'SELF', '1', '$weixin_id', '$ymd' ); ";  
	$db->query($sql); 

	$sql = "SELECT * FROM `t_user` WHERE `account`='$username' AND `password`='$password' AND `site_id`='$g_siteid'";  
	$login_user = $db->get_one($sql); 
 
	setcookies('CLOOTA_B2B2C_USER_UUID', $login_user['user_id']);

	if(req('ref')!=''){
		gotop(urldecode(req('ref')));
	} else {
		gotop(url('order.php'));
	}
}

if($ac == 'findpwd_sms'){  
	$sms_mobile		  = req('username');
	$user_verify_code = strtolower(req('verify_code'));
	$sys_verify_code  = $_SESSION['rand_code'];
	
	if($user_verify_code != $sys_verify_code || $user_verify_code==''){
		sendwarn('校验码错误！');
		exit;
	}

	if(strlen($sms_mobile)!=11) {
		sendwarn('手机号不正确！');
		exit;
	}

	// 读取用户
	$sql = "SELECT user_id FROM `t_user` WHERE `account`='$sms_mobile' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id==''){
		sendwarn('对不起，手机号不存在！');
		exit;
	}
	
	setcookie('SMS_MOBILE', $sms_mobile, 0, '/');

	$sms_code = rand(1000, 9000);
	setcookie('SMS_PWD_CODE', false, -1, '/');
	setcookie('SMS_PWD_CODE', $sms_code, 0, '/');

	$rs = send_sms($sms_juhe_id_pwd, $sms_mobile, $sms_code, '', '');
?>
<script type="text/javascript">
parent.document.getElementById("registerForm").action = "do.passport?ac=findpwd";
</script>
<?
	if($rs==true){ 
		sendwarn('验证码短信已经发送到您的手机！');  
	} else {
		sendwarn('短信发送失败，请重试！');
	}
}

/// 找回密码
if($ac == 'findpwd'){ 
	$username		= $_COOKIE['SMS_MOBILE'];
	$password		= req('password');
	$repassword		= req('repassword');
	 
	if(strlen($password)<5) {
		senderror('密码不能小于5个字符！');
	}

	if($username == $password) {
		senderror('用户名和密码不能相同！');
	}

	if($password!=$repassword) {
		senderror('两次输入的密码不一致！');
	}
	 
	if($_COOKIE['SMS_PWD_CODE'] != req('phone_code') && req('phone_code')!='') {
		senderror('对不起，手机验证码错误！');
	}  

	$sql = "UPDATE `t_user` SET `password`=MD5('$password') WHERE `account`='$username' AND `site_id`='$g_siteid'";  
	$db->query($sql);  
 
	gotop('/member/', '您的密码已修改，请重新登录！');
}
 
?>