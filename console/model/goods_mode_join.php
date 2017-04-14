<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 
$now_page = 1; 
$total_number = 0;
$total_page = 0;
$pape_size = 10;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p')));
} 
if($now_page<1){ 
	$now_page=1;
} 
 
if(req('kw')!=''){
	$qer .= " AND `goods_name` LIKE '%".req('kw')."%' ";
}

$sql = "SELECT * FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `is_sale`=1 $qer ORDER BY `is_hot` DESC, `goods_id` DESC ";   

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
 
/// 全部主题
$sql = "SELECT mode_id, mode_name FROM t_goods_mode WHERE site_id='$g_siteid' ORDER BY mode_id ASC";  
$goods_mode = $db->get_all($sql); 
?>   
