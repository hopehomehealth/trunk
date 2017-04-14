<?
include(dirname(__FILE__).'/config.php'); 

function show_error($err){
	js("parent.document.getElementById('err').innerHTML='$err'");
}

if(req('ac') == "login") {    
	$from_hash = req('hash');
	$this_hash = strtoupper(substr(md5('CLOOTA_CONSOLE'.date('Ymd')),0,20));
	
	if($from_hash != $this_hash){
		show_error("对不起，系统错误，请重新登录！");  
	}

	/// 获取表单
	$account	= req('account');   
	$password	= req('password');   
	$account	= addslashes($account);
	$password	= addslashes($password); 
	
	/// 商家登录
	$sql = "SELECT * FROM `t_shop` WHERE `account`='$account' AND `password`=MD5('$password') AND `state`='1'";  
	$user = $db->get_one($sql); 
 
	if($user['shop_id']!=''){    
		setcookies("CLOOTA_B2B2C_SHOP_UUID", $user['shop_id']);   

		if(req('ref')!=''){
			$url = req('ref');
		} else {
			$url = "./?".base64_encode($account.date('H/i/s'));
		}

		gotop($url);  
		exit; 
	} 
  
	show_error("对不起，账号或密码错误！");   
		 
}

if(req('ac') == "logout") { 
   
	setcookie('CLOOTA_B2B2C_SHOP_UUID', false, -1, '/');   
	
	echo '<script>window.top.location.replace("login?from=logout");</script>'; 
	exit;
}
?>