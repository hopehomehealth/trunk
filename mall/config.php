<?
/// 主目录
$g_dir = dirname(dirname(__FILE__));

/// 核心文件
include($g_dir.'/config/cfg.php');
include($g_dir.'/libs/mysql_class.php'); 
include(dirname(dirname(__FILE__)).'/function.php'); 

/// 连接到数据库
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);

/// 域名
$g_http_host   = $_SERVER['HTTP_HOST']; 

$domain_array = explode('.', $g_http_host);

$mall_domainer = $domain_array[0];

/// 店铺参数
$sql = "SELECT *, a.state AS shop_state FROM `t_shop` a, `t_shop_theme` b WHERE a.`theme_id`=b.`theme_id` AND a.`shop_domain`='$mall_domainer' LIMIT 0,1";  
$g_shop = $db->get_one($sql); 
 
if($g_shop['shop_id']==''){
	die('<h1> ERROR: MALL IS NOT EXIST</h1>');
}

if($g_shop['shop_state']!='1'){
	die('<h1> ERROR: MALL IS CLOSE</h1>');
}

/// 所属主站参数
$site_sql = "SELECT * FROM `t_site_config` WHERE `site_id`='".$g_shop['site_id']."' LIMIT 0,1";  
$g_site = $db->get_one($site_sql); 


$g_shopid				= $g_shop['shop_id'];
$g_shopname				= $g_shop['shop_name'];
$g_shop_url				= 'http://'.$g_http_host.'/';
$g_tpl_path				= '/tpl/'.$g_shop['tpl_name'].'/';
$g_siteid				= $g_site['site_id'];
$g_sitename				= $g_site['site_name'];
$g_site_url				= 'http://'.$g_site['site_domain'].'/';
$g_mobile_url			= 'http://'.$g_site['mobile_domain'].'/';
$g_upfile_url			= $g_site_url.'upfiles/'.$g_siteid.'/';
$g_site_profile			= unserialize($g_site['profile']); // 站点资料
$g_start_city			= $g_site_profile['start_region']; //如：合肥
$g_start_city_code		= $g_site_profile['start_region_code']; //如：hefei 
$g_full_url				= "http://$g_http_host".$_SERVER['REQUEST_URI'];
$g_url					= $_SERVER['REQUEST_URI'];
?>