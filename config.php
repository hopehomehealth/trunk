<?php 
date_default_timezone_set('Asia/Shanghai');  

define('IN_CLOOTA', true);
/// 站点根路径
$g_site_root = dirname(__FILE__); 
$g_root		 = $g_site_root.'/';


include($g_site_root.'/config/cfg.php');
include($g_site_root.'/libs/mysql_class.php');
include($g_site_root.'/libs/pinyin.php');
include($g_site_root.'/function.php'); 


/// 当前域名
$g_http_host	= $_SERVER['HTTP_HOST']; 
$g_domain		= "http://".$g_http_host."/";
$g_now_domain	= "http://".$g_http_host."/";


/// 连接到数据库
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);


/// 读取配置文件
$cfg_cache_file = $g_site_root.'/cache/cfg/'.$_SERVER['HTTP_HOST'].'.php';

// 预读配置文件缓存
if(file_exists($cfg_cache_file)==true){
	include($cfg_cache_file);
	$g_config = unserialize($site_serialize);
} else { 
	$config_sql = "SELECT * FROM `t_site_config` WHERE (`site_domain`='$g_http_host' OR `root_domain`='$g_http_host'  OR `mobile_domain`='$g_http_host' OR `other_domain` LIKE '%$g_http_host%' ) LIMIT 0,1";  
	$g_config = $db->get_one($config_sql); 	 
}  


// 站点不存在
if($g_config['site_id']==''){
	@header("http/1.1 404 not found");  
	@header("status: 404 not found");
	die('<h1>SITE NOT FOUND</h1>');
} 


// 站点状态
if($g_config['state']!='1'){
	load_page("对不起，系统升级，临时关闭，请稍候重试！");
}

// 创建缓存配置文件
if(file_exists($cfg_cache_file) == false){ 
	site_cache($g_root, $g_config['site_id'], $g_http_host);
} 


/// 全局参数配置  

$g_siteid				= $g_config['site_id']; 

$g_master				= $g_config['is_master']; //是否主站 1:0

$g_profile				= unserialize($g_config['profile']); // 站点资料

$g_misc					= unserialize($g_config['misc']);  // 站点杂项配置

$g_tpl					= $g_config['tpl_name']; 

$g_tpl_dir				= $g_site_root.'/themes/'.$g_tpl.'/'; 
 
$g_url					= $_SERVER['REQUEST_URI'];

$g_full_url				= "http://$g_http_host".$_SERVER['REQUEST_URI'];  // 完整网址

$g_www_url				= "http://".$g_config['site_domain']."/"; 
 
$g_mobile_url			= "http://".$g_config['mobile_domain']."/"; 

$g_sitename				= $g_config['site_name'];  //站点名称

$g_common_code			= stripslashes($g_config['common_code']);  //PC端通用网页代码

$g_page_title			= $g_config['page_title'];  //首页标题

$g_page_keywords		= $g_config['page_keywords']; //首页关键字 

$g_page_description		= $g_config['page_description']; //首页描述
	 
$g_userid				= $_COOKIE['CLOOTA_B2B2C_USER_UUID'];  //访客所在省份

$g_shopid				= $_COOKIE['CLOOTA_B2B2C_SHOP_UUID'];  //访客所在省份

$g_style				= $g_config['style_name'];

$g_mobile_style			= $g_config['mobile_style_name'];

if($g_userid>0){
	$g_user = get_member_info();
}
if($g_shopid>0){  
	$g_shop = get_shop_info();
} 

$g_start_city			= $g_profile['start_region']; //如：合肥

$g_start_city_code		= $g_profile['start_region_code']; //如：hefei 

$g_domain_return = 'http://192.168.0.253';

// 站点通用JS包含
$g_common_js = <<<END
<script language="javascript" src="/ajax/lazyload-1.9.1/jquery.lazyload.min.js"></script>
<script language="javascript" src="/static/js/cloota.js"></script>

END;


/**
 * 
 * 模板编写规范：
 * 1、包含文件，必须使用load_user_diy函数，如：include(load_user_diy('static.php'));
 * 2、可编辑的HTML页面必须分离出单独文件包含，文件规则为：diy.x数字.html
 * 3、可编辑的JS页面必须分离出单独文件包含，文件规则为：diy.j数字.html
 **/

?>
