<?

// 查询与店铺相关的分类
function get_shop_cat_cond_list(){
	global $db, $g_siteid, $g_shopid; 

	$sql = "SELECT b.cat_id, b.cat_name FROM `t_goods_thread` a, `t_goods_catalog` b WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$g_shopid' AND a.`cat_id`=b.`cat_id` AND b.`parent_id`>0 GROUP BY b.cat_id, b.cat_name"; 
 
	return $db->get_all($sql);  
} 

// 查询与店铺相关的分类
function get_shop_cat_one($cat_id){
	global $db, $g_siteid, $g_shopid; 

	$sql = "SELECT * FROM `t_shop_goods_catalog` a WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$g_shopid' AND a.`cat_id`='$cat_id' "; 
	return $db->get_one($sql);  
} 

// 查询与店铺子分类
function get_shop_child_cat($cat_id){
	global $db, $g_siteid, $g_shopid; 

	$sql = "SELECT `cat_id` FROM `t_shop_goods_catalog` a WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$g_shopid' AND a.`parent_id`='$cat_id' "; 
	return $db->get_all($sql);  
} 

$now_cat_id = req('id');
if($now_cat_id != ''){
	$now_cat = get_shop_cat_one($now_cat_id); 
}
  
///-----------------------------------------------/// 分页列表

$now_page		= 1; 
$total_number	= 0;
$total_page		= 0;

$pape_size		= 12;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p'))); 
} 
if($now_page<1){ 
	$now_page=1;
}

//// 主查询语句 ////
if(req('keywords')!=''){
	$sqler = " AND a.goods_name LIKE '%".req('keywords')."%'";
}

if(req('v_line_nature')!=''){
	$sqler = " AND a.goods_type='".req('v_line_nature')."'";
}

if(req('v_money')!=''){
	$day_txt = $g_product_money_filter[req('v_money')];
	$sqler .= str_replace('###', ' a.`real_price` ', $day_txt); 
}
 
if(req('v_line_day')!=''){
	$day_txt = $g_product_day_filter[req('v_line_day')];
	$sqler .= str_replace('###', ' a.`line_days` ', $day_txt); 
} 

if(req('v_cat_id')!=''){
	$sqler .= " AND a.cat_id='".req('v_cat_id')."'";
}

if(req('v_start_price')!=''){
	$sqler .= " AND a.real_price>='".req('v_start_price')."'";
}

if(req('v_end_price')!=''){
	$sqler .= " AND a.real_price<='".req('v_end_price')."'";
}
 
// 排序
if(req('v_order_new')!=''){
	$oer = " ORDER BY a.goods_id ".req('v_order_new');
}
elseif(req('v_order_price')!=''){
	$oer = " ORDER BY a.real_price ".req('v_order_price');
}
elseif(req('v_order_sale')!=''){
	$oer = " ORDER BY a.sale_number ".req('v_order_price');
}
else {
	$oer = " ORDER BY a.goods_id DESC ";
}
 
if(req('id') != ''){ 
	$childs = get_shop_child_cat(req('id'));
	if(notnull($childs)){  
		foreach ($childs as $val){  
			$ids .= ','.$val['cat_id'];
		}
	} 
	$sqler .= " AND a.`shop_cat_id` IN ( ".req('id')." $ids ) ";
}

$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$g_shopid' AND a.`is_sale`=1 $sqler $oer ";  
 
/// 查询产品总数(高效)
$pre_sql_select		= substr($sql, 0, strpos($sql,'FROM')+4);
$sql_total_number	= str_replace($pre_sql_select, 'SELECT COUNT(*) FROM', $sql);
$total_number		= $db->get_value($sql_total_number);


if($total_number % $pape_size == 0){
	$total_page = intval($total_number / $pape_size);
} else{
	$total_page = intval($total_number / $pape_size) + 1;
}
if($now_page>$total_page){ 
	$now_page = $total_page;
} 

/// 执行查询
$start_limit = ($now_page-1)*$pape_size;
if($start_limit<0){
	$start_limit = 0;
} 

$sql .= " LIMIT $start_limit , $pape_size";
$query_rows = $db->get_all($sql);  
  
if($now_page>1){ 
	$prev_number=$now_page-1;
} else {
	$prev_number= $now_page;
}
if($now_page<$total_page){ 
	$next_number=$now_page+1;
} else {
	$next_number = $now_page;
} 
?>