<?

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

function get_goods_sku_by_id($sku_id){
	global $db, $g_siteid; 
	
	$csql = "SELECT * FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `sku_id`='".$sku_id."'";  
	return $db->get_one($csql); 
}

function get_traffic_detail_by_id($traffic_id){
	global $db, $g_siteid; 
	
	$csql = "SELECT * FROM `t_user_traffic` WHERE `site_id`='$g_siteid' AND `traffic_id`='".$traffic_id."'";  
	return $db->get_one($csql); 
}

$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ";	
$total_order_number = $db->get_value($sql); 
?>