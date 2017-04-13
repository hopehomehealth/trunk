<?php
header("Content-type: text/html; charset=GBK"); 

$g_dir  = dirname(dirname(__FILE__));

include($g_dir.'/config.php'); 
include($g_dir.'/model/common.model.php'); 

/// 连接到数据库
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);
 
$g_shopid = $_COOKIE['CLOOTA_B2B2C_SHOP_UUID'];
 
$sql = "SELECT a.account, b.* FROM `t_shop` a, `t_site_config` b WHERE a.`site_id`=b.`site_id` AND a.`shop_id`='$g_shopid' AND a.`state`='1'";  
$g_login = $db->get_one($sql);
 

/// 全局信息
$g_root				= $g_dir."/"; 
$g_siteid			= $g_login['site_id'];
$g_tpl				= $g_login['tpl_name'];  
$g_account			= $g_login['account']; 
$g_site_domain		= $g_login['site_domain']; 
$g_mobile_domain	= $g_login['mobile_domain'];
$g_www_url			= 'http://'.$g_site_domain.'/';  
$g_mobile_url		= 'http://'.$g_mobile_domain.'/'; 
$g_profile			= unserialize($g_login['profile']); // 站点资料 
$g_tpl				= $g_login['tpl_name']; 
$g_tpl_dir			= $g_dir.'/themes/'.$g_tpl.'/';  
	
/// 商家明细
$sql = "SELECT * FROM `t_shop` WHERE `shop_id`='$g_shopid'";  
$g_shop = $db->get_one($sql); 
	
/// 商家网址
$g_shop_url = 'http://'.$g_shop['shop_domain'].'.'.$g_shop_root_domain.'/';

/// 系统信息
$g_sys_name = '云驴通';
if($g_login['site_name']!=''){
	$g_sys_name	= $g_login['site_name'];
}


/// 判断是否当前导航
function nav_active($filename) { 
	if(req('cmd')==base64_encode($filename)){
		return true;
	} else {
		return false;
	} 
}
?>