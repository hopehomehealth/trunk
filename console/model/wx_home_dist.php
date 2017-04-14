<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_wx_home_dist` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC ";   
$dist_rows = $db->get_all($sql); 

$sql = "SELECT MAX(`order_id`)+1 FROM `t_wx_home_dist` WHERE `site_id`='$g_siteid' ";   
$max_order_id = $db->get_all($sql); 
?>    

