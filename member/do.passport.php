<?
session_start();
header("Content-type: text/html; charset=GBK");
include('config.php');

$ac		= req('ac');
$ymd	= date('Y-m-d H:i:s');


/// �û���¼
if($ac == 'login'){ 
	$username	= req('username');
	$password	= req('password');

	if(strlen($username)<3 || strlen($password)<3) { 
		js('parent.document.getElementById("login_error").style.display="block"');
		exit;
	} 

	if($_SESSION['rand_code'] != req('verify_code') || req('verify_code')=='') { 
		js('alert("�Բ�����֤�����")');
		exit;
	} 

	$sql = "SELECT * FROM `t_user` WHERE `account`='$username' AND `password`=MD5('$password') AND `site_id`='$g_siteid' AND `state`='1' ";  
	$login_user = $db->get_one($sql); 
	 
	if($login_user['user_id'] != ''){ 
		setcookies('CLOOTA_B2B2C_USER_UUID', $login_user['user_id']);  

		/// ����΢��ID
		$weixin_id = $_COOKIE['CLOOTA_B2B2C_WEIXIN_ID']; 
		if($login_user['weixin_id'] == '' && $weixin_id != ''){ 
			$sql = "UPDATE `t_user` SET `weixin_id`='".$weixin_id."' WHERE `site_id`='$g_siteid' AND `user_id`='".$login_user['user_id']."'";  
			$db->query($sql); 
		}

		/// ת�Ƶ��ҵ��˻�
		if(req('ref')!=''){
			$ref = urldecode(req('ref'));
			$ref = str_replace('&amp;','&',$ref);
			gotop($ref);
		} else {
			gotop(url('order.php'));
		} 
	} else {
		//senderror('�Բ����ʺŻ��������');
		js('parent.document.getElementById("login_error").style.display="block"');
		exit;
	} 
}

/// ������֤
if($ac == 'register_sms'){  
	$sms_mobile		  = req('username');
	$user_verify_code = strtolower(req('verify_code'));
	$sys_verify_code  = $_SESSION['rand_code'];
	
	if($user_verify_code != $sys_verify_code || $user_verify_code==''){
		sendwarn('У�������');
		exit;
	}

	if(strlen($sms_mobile)!=11) {
		sendwarn('�ֻ��Ų���ȷ��');
		exit;
	}

	// ͬһվ����û��������ظ�
	$sql = "SELECT user_id FROM `t_user` WHERE `account`='$sms_mobile' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id!=''){
		sendwarn('�Բ����ֻ����Ѿ����ڣ�');
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
		sendwarn('��֤������Ѿ����͵������ֻ���'); 
	} else {
		sendwarn('���ŷ���ʧ�ܣ������ԣ�');
	}
}


/// ע��
if($ac == 'register'){ 
	$username		= req('username');
	$password		= req('password');
	$repassword		= req('repassword');
	 
	if(strlen($username)<5) {
		senderror('�û�������С��5���ַ���');
	}
	if(strlen($password)<5) {
		senderror('���벻��С��5���ַ���');
	}

	if($username == $password) {
		senderror('�û��������벻����ͬ��');
	}

	if($password!=$repassword) {
		senderror('������������벻һ�£�');
	}
	 
	if($_COOKIE['SMS_CODE'] != req('phone_code') || req('phone_code')=='') {
		senderror('�Բ����ֻ���֤�����');
	} 

	// ͬһվ����û��������ظ�
	$sql = "SELECT user_id FROM `t_user` WHERE `account`='$username' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id!=''){
		senderror('�û����Ѵ��ڣ�');
	}

	// MD5����
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
		sendwarn('У�������');
		exit;
	}

	if(strlen($sms_mobile)!=11) {
		sendwarn('�ֻ��Ų���ȷ��');
		exit;
	}

	// ��ȡ�û�
	$sql = "SELECT user_id FROM `t_user` WHERE `account`='$sms_mobile' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id==''){
		sendwarn('�Բ����ֻ��Ų����ڣ�');
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
		sendwarn('��֤������Ѿ����͵������ֻ���');  
	} else {
		sendwarn('���ŷ���ʧ�ܣ������ԣ�');
	}
}

/// �һ�����
if($ac == 'findpwd'){ 
	$username		= $_COOKIE['SMS_MOBILE'];
	$password		= req('password');
	$repassword		= req('repassword');
	 
	if(strlen($password)<5) {
		senderror('���벻��С��5���ַ���');
	}

	if($username == $password) {
		senderror('�û��������벻����ͬ��');
	}

	if($password!=$repassword) {
		senderror('������������벻һ�£�');
	}
	 
	if($_COOKIE['SMS_PWD_CODE'] != req('phone_code') && req('phone_code')!='') {
		senderror('�Բ����ֻ���֤�����');
	}  

	$sql = "UPDATE `t_user` SET `password`=MD5('$password') WHERE `account`='$username' AND `site_id`='$g_siteid'";  
	$db->query($sql);  
 
	gotop('/member/', '�����������޸ģ������µ�¼��');
}
 
?>