<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$now_page = 1; 
$total_number = 0;
$total_page = 0;
$pape_size = 5;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p')));
} 
if($now_page<1){ 
	$now_page=1;
} 
 
if(req('kw')!=''){
	$qer .= " AND (`goods_id`='".req('kw')."' OR `goods_code` LIKE '%".req('kw')."%' OR `goods_name` LIKE '%".req('kw')."%')";
}

if(req('goods_type')!=''){
	$qer .= " AND `goods_type`='".req('goods_type')."' ";
}

$sql = "SELECT * FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `is_sale`=1 $qer ORDER BY `goods_id` DESC ";   
 

/// 查询产品总数
$pre_sql_select = substr($sql, 0, strpos($sql,'FROM')+4);
$sql_total_number = str_replace($pre_sql_select, 'SELECT COUNT(*) FROM', $sql);
$total_number = $db->get_value($sql_total_number); 

$sql .= " LIMIT ".(($now_page-1)*$pape_size).", $pape_size";
$query_rows = $db->get_all($sql); 


if($total_number % $pape_size == 0){
	  $total_page = intval($total_number / $pape_size);
} else{
	  $total_page = intval($total_number / $pape_size) + 1;
}
if($now_page>$total_page){ 
	$now_page = $total_page;
} 

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


// 已加入产品
$sql = "select a.item_id, a.order_id as o_id, b.goods_id, b.goods_code, b.goods_name from `t_goods_floor_goods` a, `t_goods_thread` b where a.`site_id`='$g_siteid' and a.`goods_id`=b.`goods_id` and a.`floor_id`='".req('floor_id')."' ORDER BY a.order_id ASC";
$joined_goods = $db->get_all($sql);

// 退款记录
$sql = "SELECT * FROM `t_refund_fee_apply`  ORDER BY `create_time` DESC ";
$sql .= " LIMIT ".(($now_page-1)*$pape_size).", $pape_size";
$refund_rows = $db->get_all($sql);
?>   

