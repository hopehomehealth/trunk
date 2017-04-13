<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$now_page = 1; 
$total_number = 0;
$total_page = 0;
$pape_size = 15;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p')));
} 
if($now_page<1){ 
	$now_page=1;
} 

if(req('cat_id')!=''){ 
	$sql_cat_id = req('cat_id'); 
	$qer .= " AND a.`cat_id` IN( $sql_cat_id )";
} 
if(req('kw')!=''){
	$qer .= " AND (a.`goods_name` LIKE '%".req('kw')."%' OR a.`goods_id` = '".req('kw')."' )";
} 
if(req('is_sale')!=''){
	$qer .= " AND a.`is_sale`='".req('is_sale')."' ";
} 
if(req('is_hot')!=''){
	$qer .= " AND a.`is_hot`='".req('is_hot')."' ";
}   

$sql = "SELECT a.* FROM `t_score_goods_thread` a WHERE a.`site_id`='$g_siteid' $qer ORDER BY a.goods_id DESC ";   
 
/// ²éÑ¯×ÜÊı
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
 

$sql = "SELECT * FROM `t_score_goods_catalog` WHERE site_id='$g_siteid' ORDER BY `order_id` ASC ";
$cat_list = $db->get_all($sql);
?>  

