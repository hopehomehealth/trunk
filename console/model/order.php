<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}


$now_page = 1; 
$total_number = 0;
$total_page = 0;
$pape_size = 20;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p')));
} 
if($now_page<1){ 
	$now_page=1;
} 

 
if(req('kw')!=''){
	$qer .= " AND ( a.order_code='".req('kw')."' OR a.`goods_name` LIKE '%".req('kw')."%' OR b.`shop_name` LIKE '%".req('kw')."%' OR a.`linker` LIKE '%".req('kw')."%' OR a.mobile='".req('kw')."')";
}
if(req('state')!= '' && req('state') != '6' && req('state') != '2'){
	$qer .= " AND a.`state`='".req('state')."'";
}
if(req('state') == '2'){
	$flag = "0";
    $qer .= " AND a.`state`='".req('state')."' AND a.`verify_flag`='" . $flag."'";
}
if(req('state') == '6'){
	$flag = "2";
    $qer .= " AND a.`verify_flag`='".$flag."'";
}

$sql = "SELECT a.*,c.lv_scenic_id,c.data_sources FROM t_user_order a, t_shop b, t_goods_thread c WHERE a.shop_id=b.shop_id AND a.lv_product_id=c.lv_product_id AND a.`site_id`='$g_siteid' $qer ORDER BY a.`order_id` DESC ";

/// 查询总数 
$total_number = $db->get_value("SELECT COUNT(*) FROM ( $sql ) TMP"); 
 
$sql .= " LIMIT ".(($now_page-1)*$pape_size).", $pape_size";

if($total_number % $pape_size == 0){
	$total_page = intval($total_number / $pape_size);
} else{
	$total_page = intval($total_number / $pape_size) + 1;
}
echo "";
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

// 更新阅读状态
$db->query("UPDATE `t_user_order` SET `is_read`='1' "); 

function get_shop($shop_id){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_shop` WHERE site_id='$g_siteid' AND shop_id='".$shop_id."' ";  
	return $db->get_one($sql);  
}
?> 

