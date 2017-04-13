<?  
/// 动作
$ac = req('ac');

// 第三方平台登录并自动注册

if($ac == 'connect' ){

	$nick			= req('nick'); 
	$open_id		= req('open_id'); 
	$reg_type		= req('reg_type'); 
	$ymd			= date('Y-m-d H:i:s'); 
	$login_user_id  = $_COOKIE['CLOOTA_B2B2C_USER_UUID'];

	if($reg_type=='SINA' || $reg_type=='TAOBAO'){
		$open_id = md5($reg_type.$nick);
	}

	// 已有内部账户，自动绑定
	if($login_user_id != ''){
		$sql = "SELECT * FROM `t_user_connect` WHERE `open_id`='$open_id' AND `user_id`='$login_user_id' AND `site_id`='$g_siteid'";
		$exist_connect = $db->get_one($sql);
		
		if($exist_connect['connect_id'] == ''){
			$sql = "INSERT INTO `t_user_connect` (`site_id` , `user_id` , `open_id`) VALUES ('$g_siteid', '$login_user_id', '$open_id'); ";
			$db->query($sql); 
		} 
	}

	// 未登录账户，新增用户
	if($login_user_id == ''){  
		$sql = "SELECT * FROM `t_user_connect` WHERE `open_id`='$open_id' AND `site_id`='$g_siteid'";
		$exist_connect = $db->get_one($sql);

		$this_user_id = $exist_connect['user_id'];

		if($this_user_id == ''){ //不存在第三方ID  
			$sql = "INSERT INTO `t_user` (`site_id`, `username`, `nickname`, `reg_type`, `state`, `addtime` ) VALUES ('$g_siteid', '$username', '$nick', '$reg_type', '1', '$ymd' ); ";
			$db->query($sql);  

			$sql = "SELECT MAX(`user_id`) FROM `t_user` WHERE `site_id`='$g_siteid'";  
			$new_user_id = $db->get_value($sql);  
			 
			$sql = "INSERT INTO `t_user_connect` (`site_id` , `user_id` , `open_id`) VALUES ('$g_siteid', '$new_user_id', '$open_id'); ";
			$db->query($sql); 
			
			$this_user_id = $new_user_id;
		}

		// 自动登录
		setcookies('CLOOTA_B2B2C_USER_UUID', $this_user_id);
	}  
}
?>
