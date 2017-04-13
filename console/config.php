<?php
header("Content-type: text/html; charset=GBK"); 

$g_dir  = dirname(dirname(__FILE__));

include($g_dir.'/config/cfg.php');
include($g_dir.'/libs/mysql_class.php');
include($g_dir.'/libs/pinyin.php'); 
include(dirname(__FILE__).'/function.php'); 
include(dirname(__FILE__).'/lang.php'); 

/// 连接到数据库
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);
 
$cookie_user_id = $_COOKIE['CLOOTA_B2B2C_ADMIN_UUID'];

 
$sql = "SELECT a.account, b.* FROM `t_admin` a, `t_site_config` b WHERE a.`site_id`=b.`site_id` AND a.`account_id`='$cookie_user_id'";  
$g_login = $db->get_one($sql); 


/// 全局信息
$g_root				= $g_dir."/"; 
$g_siteid			= $g_login['site_id'];
$g_tpl				= $g_login['tpl_name'];  
$g_m_tpl			= $g_login['mobile_tpl_name']; 
$g_account			= $g_login['account']; 
$g_site_domain		= $g_login['site_domain']; 
$g_mobile_domain	= $g_login['mobile_domain'];
$g_www_url			= 'http://'.$g_site_domain.'/';  
$g_profile			= unserialize($g_login['profile']); // 站点资料 

 
$sql = "SELECT * FROM `t_admin` WHERE `account_id`='$cookie_user_id'";  
$g_admin = $db->get_one($sql); 
 

/// 系统信息
$g_sys_name = '云驴通';
if($g_login['site_name']!=''){
	$g_sys_name	= $g_login['site_name'];
}
?>