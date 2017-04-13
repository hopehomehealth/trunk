<?
include(dirname(__FILE__).'/config.php'); 

define('IN_CLOOTA', true);

$config_sql = "SELECT * FROM `t_site_config` WHERE (`site_domain`='$g_http_host' OR `root_domain`='$g_http_host'  OR `mobile_domain`='$g_http_host' OR `other_domain` LIKE '%$g_http_host%' ) LIMIT 0,1";  
$g_config = $db->get_one($config_sql); 	

if($g_config['site_name']!=''){
	$g_sys_name	= $g_config['site_name'];
}

include(dirname(__FILE__).'/layout/login.php'); 
?>   