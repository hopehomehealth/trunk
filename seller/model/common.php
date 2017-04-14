<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}   

function get_goods_count($goods_type ){
	global $db, $g_siteid, $g_shopid;

	$sql = "SELECT COUNT(*) FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `shop_id`='".$g_shopid."' AND `goods_type`='$goods_type' ";  
	return $db->get_value($sql);
}

function get_order_count($state){
	global $db, $g_siteid, $g_shopid;

	$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `shop_id`='".$g_shopid."' AND `state`='$state'";  
	return $db->get_value($sql);
}

function get_settle_count($is_settle){
	global $db, $g_siteid, $g_shopid;

	$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `shop_id`='".$g_shopid."' AND `state`='4' AND `is_settle`='$is_settle'";  
	return $db->get_value($sql);
}

function get_shop_detail_by_id($shop_id){
	global $db, $g_siteid; 

	$csql = "SELECT * FROM `t_shop` WHERE `site_id`='$g_siteid' AND `shop_id`='".$shop_id."'";  
	return $db->get_one($csql);
}

function get_user_detail_by_id($user_id){
	global $db, $g_siteid; 
		 
	$csql = "SELECT * FROM `t_user` WHERE `site_id`='$g_siteid' AND `user_id`='".$user_id."'";  
	return $db->get_one($csql); 
}

function get_traffic_detail_by_id($traffic_id){
	global $db, $g_siteid; 
	
	$csql = "SELECT * FROM `t_user_traffic` WHERE `site_id`='$g_siteid' AND `traffic_id`='".$traffic_id."'";  
	return $db->get_one($csql); 
}

function get_goods_sku_by_id($sku_id){
	global $db, $g_siteid; 
	
	$csql = "SELECT * FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `sku_id`='".$sku_id."'";  
	return $db->get_one($csql); 
}

?>