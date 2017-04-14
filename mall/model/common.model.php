<?

// 查询店铺热门的产品列表
function get_shop_cat_list($parent_id, $limit='6' ){
	global $db, $g_siteid, $g_shopid; 
	 
	$sql = "SELECT * FROM `t_shop_goods_catalog` WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid' AND `parent_id`='$parent_id' $qer ORDER BY `order_id` ASC, `cat_id` DESC LIMIT 0,$limit"; 
	return $db->get_all($sql); 
} 

// 查询与店铺相关的分类
function get_shop_cat_nav_list($limit){
	global $db, $g_siteid, $g_shopid; 

	$sql = "SELECT cat_id, cat_name FROM `t_shop_goods_catalog` WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid' AND `parent_id`='0' GROUP BY cat_id, cat_name LIMIT 0,$limit"; 
 
	return $db->get_all($sql);  
} 

?>