<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

/// 模板信息更新插件 
 
$sql = "SELECT tpl_name FROM t_site_config WHERE site_id='$g_siteid'";  
$this_site_tpl = $db->get_value($sql);  
 
$sql = "SELECT mobile_tpl_name FROM t_site_config WHERE site_id='$g_siteid'";  
$this_mobile_tpl = $db->get_value($sql);  

$sql = "select * from `t_tpl` group by tags  ";   
$tags = $db->get_all($sql); 
?>

