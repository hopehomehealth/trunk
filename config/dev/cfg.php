<?php
date_default_timezone_set('Asia/Shanghai');  


// php.ini 关闭 magic_quotes_gpc  magic_quotes_runtime
if (get_magic_quotes_gpc() == true) {
	die("fatal error: please set php.ini magic_quotes_gpc=off ");
}


///-----------------------------------------------// 包含文件

require dirname(dirname(__FILE__)).'/libs/phpmailer/class.phpmailer.php';


include(dirname(__FILE__).'/attr.php'); 
include(dirname(__FILE__).'/acc.php');
include(dirname(__FILE__).'/fun.php');

///-----------------------------------------------// 系统消息

$g_sys_name				= "云驴通";
$g_sys_home				= "http://www.cloota.com";
$g_sys_version			= 'C';


///-----------------------------------------------// 域名消息 
$g_host_root_domain		= 'echinabus.cn'; 
$g_host_console			= 'http://'.$_SERVER['HTTP_HOST'].'/console/';
$g_shop_root_domain		= 'echinabus.cn';

$host 					= 'wwwd.bus365.cn';//接口地址
$loginUrl				= 'http://wwwd.bus365.cn/login0';//登录地址
$registerUrl			= 'http://wwwd.bus365.cn/user/registerpage/?ismock=0';//注册地址
$g_self_domain			= 'http://traveld.bus365.cn';//旅游板块地址(旅游这块的域名)
$g_bus365_domain        = 'http://wwwd.bus365.cn';
///-----------------------------------------------// DEBUG模式
$g_console_debug		= true;
$g_is_demo_site			= false;
?>