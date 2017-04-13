<?

// 查询店铺热门的产品列表
function get_shop_goods_list($limit='6', $is_hot='1'){
	global $db, $g_siteid, $g_shopid; 
	
	if($is_hot=='1'){
		$qer = " AND `is_hot`=1 ";
	}
	$sql = "SELECT * FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid' AND `is_sale`=1 $qer ORDER BY `order_id` ASC, `goods_id` DESC LIMIT 0,$limit";     
	return $db->get_all($sql); 
} 

// 查询店铺热门的产品列表
function get_ppt_list($limit='6'){
	global $db, $g_siteid, $g_shopid; 
	 
	$sql = "SELECT * FROM `t_shop_ppt` WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid' AND state='1' ORDER BY `order_id` ASC LIMIT 0, $limit";     
	return $db->get_all($sql); 
} 

$is_index = true;

?>