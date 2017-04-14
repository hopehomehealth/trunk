<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_local_store` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC ";   
$local_store_rows = $db->get_all($sql); 

$sql = "SELECT MAX(`order_id`)+1 FROM `t_local_store` WHERE `site_id`='$g_siteid' ";   
$max_order_id = $db->get_all($sql); 
?>    

