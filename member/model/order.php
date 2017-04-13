<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

if(req('state')!=''){
	$qer = " AND a.`state`='".req('state')."'";
}

$sql = "SELECT a.*, b.shop_name FROM `t_user_order` a, t_shop b WHERE a.shop_id=b.shop_id AND a.`site_id`='$g_siteid' AND a.`user_id`='$g_userid' $qer ORDER BY a.`order_id` DESC";  
$order_list = $db->get_all($sql);  
 
$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ";	
$total_order_number = $db->get_value($sql);  
 

function get_tourist_count($order_code){
	global $db, $g_siteid;

	$csql = "SELECT COUNT(*) FROM `t_user_order_tourist` WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";  
	return $db->get_value($csql); 
}
 
function get_order_count($state){
	global $db, $g_siteid, $g_userid;

	$csql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `state`='$state' AND `user_id`='$g_userid'";  
	return $db->get_value($csql); 
}

function get_comment_count($goods_id){
	global $db, $g_siteid, $g_userid;

	$sql = "SELECT COUNT(*) FROM `t_goods_comment` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `user_id`='$g_userid'";
	return $db->get_value($sql); 
}
?>