<?php 
$g_site_root = dirname(dirname(dirname(__FILE__)));  

include($g_site_root.'/config/cfg.php');
include($g_site_root.'/libs/mysql_class.php');
 

/// ���ӵ����ݿ�
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);

//$db->query("set names utf8"); 

$g_http_host = $_SERVER['HTTP_HOST']; 

$config_sql = "SELECT * FROM `t_site_config` WHERE (`site_domain`='$g_http_host' OR `root_domain`='$g_http_host'  OR `mobile_domain`='$g_http_host' OR `other_domain` LIKE '%$g_http_host%' ) LIMIT 0,1";  
$g_config = $db->get_one($config_sql); 	

$g_siteid   = $g_config['site_id']; 
$g_userid   = $_COOKIE['CLOOTA_B2B2C_USER_UUID'];
$g_sitename = $g_config['site_name'];

//��ȡ��վ��ĲƸ�֧ͨ������
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='".$g_siteid."'"; 
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);

// �Ƿ�����
$pay_state = $pay_config['wxpay']['state'];

if($pay_state!='Y'){
	header("Content-type: text/html; charset=gb2312"); 
	die('<h1>�Բ���֧������δ����</h1>');
}

$wx_appid = $pay_config['wxpay']['appid'];
$wx_mchid = $pay_config['wxpay']['mchid'];
$wx_key = $pay_config['wxpay']['key'];
$wx_appsecret = $pay_config['wxpay']['appsecret'];

define('WX_APPID', $wx_appid);
define('WX_MCHID', $wx_mchid);
define('WX_KEY', $wx_key);
define('WX_APPSECRET', $wx_appsecret);
?>