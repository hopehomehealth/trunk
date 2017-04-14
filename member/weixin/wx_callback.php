<?php 
include(dirname(dirname(dirname(__FILE__))).'/config.php');

$wx = unserialize($g_config['wx_config']);

$api_url		= 'https://api.weixin.qq.com/sns/oauth2/access_token';
$appid			= $wx['appid'];
$secret			= $wx['appsecret'];
$code			= $_GET['code'];
$get_token_url	= $api_url.'?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$get_token_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);
$json_obj = json_decode($res,true);

/// 根据OPENID和ACCESS_TOKEN查询用户信息
$access_token = $json_obj['access_token'];
$openid = $json_obj['openid'];
$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);

/// 解析json
$user_obj = json_decode($res, true);
 
//print_r($user_obj);
//exit; 

$weixin_id = trim($user_obj['openid']); 

if($weixin_id == ''){
	die('<h2>WECHAT LOGIN ERROR</h2>');
}

/// 是否存在微信ID
$sql = "SELECT `user_id` FROM `t_user` WHERE `weixin_id`='$weixin_id' AND `site_id`='$g_siteid'";  
$exist_user_id = $db->get_value($sql); 

if($exist_user_id != ''){ //存在ID，则自动登录
	setcookies('CLOOTA_B2B2C_USER_UUID', $exist_user_id);    
} else {
	$nickname = mb_convert_encoding($user_obj['nickname'], 'gbk', 'utf-8');

	$sex = $user_obj['sex'];
	if($sex=='1') $sex='男'; else $sex='女';

	$sql = "INSERT INTO `t_user` (`site_id`, `account`, `password`, `avatar`, `nickname`, `sex`, `reg_type`, `state`, `weixin_id`, `addtime` ) VALUES ('$g_siteid', '', '', '".$user_obj['headimgurl']."', '".$nickname."', '".$sex."', 'WEIXIN', '1', '$weixin_id', '".date('Y-m-d H:i:s')."' ); ";  
	$db->query($sql); 

	$sql = "SELECT `user_id` FROM `t_user` WHERE `weixin_id`='$weixin_id' AND `site_id`='$g_siteid'";  
	$exist_user_id = $db->get_value($sql); 

	setcookies('CLOOTA_B2B2C_USER_UUID', $exist_user_id); 
}

setcookies('CLOOTA_B2B2C_WEIXIN_ID', $weixin_id); 

?>
<script type="text/javascript">
location.replace('/member/login#WX');
</script>