<?  
// 设置用户会话ID
function set_client_id(){
	if($_COOKIE['client_id'] == ''){
		$sessionid = sessionid();
		setcookies('client_id', $sessionid);
	}
}

// 读取用户会话ID
function get_client_id(){
	if($_COOKIE['client_id'] == ''){
		$sessionid = sessionid();
		setcookies('client_id', $sessionid);
		return $sessionid;
	} else {
		return $_COOKIE['client_id'];
	}
}


 
// 已登录，则自动跳转
function is_login(){
	if($_COOKIE['CLOOTA_B2B2C_USER_UUID']!=''){
?>
<script type="text/javascript"> 
window.top.location.replace('<?=url('order.php')?>');
</script>
<? 
		exit();
	}
}

// 查询订单数量
function get_order_number(){
	global $db, $g_siteid, $g_userid;
	$sql = "SELECT COUNT(*) FROM `t_user_order` a WHERE a.`user_id`='$g_userid' AND a.`site_id`='$g_siteid' ";   
	$rs = $db->get_value($sql); 
	if($rs=='') $rs=0;
	return $rs;
}

// 查询客户
function get_member(){
	global $db, $g_userid;
	$sql = "SELECT * FROM t_user WHERE user_id='$g_userid' AND `state`='1' ";  
	return $db->get_one($sql); 
}

// 菜单激活
function hover($words, $is_array=false){
	global $cmd; 

	if($is_array==true){
		if(notnull($words)){
			foreach ($words as &$v) {
				if(strpos($cmd, $v) !== false){
					echo 'active'; 
					break;
				}
			}
		}
	} else {
		if(strpos($cmd, $words) !== false){
			echo 'active'; 
		}
	}
}



// 发送通知邮件
function send_member_mail($subject, $body, $sendto=''){  
	global $g_config;

	$mail = f_smtp();
	$mail->Subject = $subject;  
	$mail->MsgHTML($body);  

	if($sendto!=''){
		$mail->AddAddress($sendto, ''); 
		$mail->Send();

	} else {

		$alert_email = trim($g_config['alert_email']);

		$alert_email_array = explode("\n", $alert_email);

		if(notnull($alert_email_array)){
 
			foreach ($alert_email_array as &$v) {
				$v = trim($v);
				if($v!=''){
					$mail->AddAddress($v, ''); 
				}
			}  
			$mail->Send();
		}
	} 
}

?>