<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_shop_ppt` WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid' ORDER BY `ppt_type` ASC, `order_id` ASC "; 
$ppt_rows = $db->get_all($sql); 
?>   

