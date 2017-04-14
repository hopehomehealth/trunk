<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}   

// 获取URL
function get_goods_url($cat_key, $goods_id){
	global $g_www_url; 

	return $g_www_url.'product/detail-'.$goods_id.'.html';
}

// 获取URL
function get_news_url($thread_id){
	global $db, $g_siteid, $g_www_url; 
 
	return $g_www_url.'news/detail-'.$thread_id.'.html';
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

function get_user_level_by_type($level_type){
	global $db, $g_siteid; 
	
	$csql = "SELECT * FROM `t_user_level` WHERE `site_id`='$g_siteid' AND `level_type`='".$level_type."'";  
	return $db->get_one($csql); 
}
?>