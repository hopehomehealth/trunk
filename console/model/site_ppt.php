<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_site_ppt` WHERE `site_id`='$g_siteid' ORDER BY  `ppt_type` ASC, `order_id` ASC ";   
$ppt_rows = $db->get_all($sql); 

$sql = "SELECT MAX(`order_id`)+1 FROM `t_site_ppt` WHERE `site_id`='$g_siteid' ";   
$max_order_id = $db->get_all($sql); 
?>    

