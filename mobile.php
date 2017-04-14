<?
header("Content-type: text/html; charset=utf-8"); 

date_default_timezone_set('Asia/Shanghai');  

 
$g_site_root		= dirname(__FILE__);

$g_mobile_root		= $g_site_root.'/mobi';

include(dirname($g_site_root).'/config/cfg.php');
include(dirname($g_site_root).'/libs/mysql_class.php');
include($g_mobile_root.'/function.php');
  
     
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);

$db->query("set names utf8");

$g_http_host = $_SERVER['SERVER_NAME'];

$action = req('action');

include($g_mobile_root.'/'.$action.'.php');


function get_menu($parent_id='0', $limit='6'){
	global $db, $g_siteid;
 
	$sql = "SELECT * FROM `t_site_menu` WHERE unshow='0' AND `parent_id`='$parent_id' AND `site_id`='$g_siteid' ORDER BY order_id ASC LIMIT 0,$limit";  
	return $db->get_all($sql); 
}

?>