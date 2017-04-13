<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$now_page = 1; 
$total_number = 0;
$total_page = 0;
$pape_size = 30;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p')));
} 
if($now_page<1){ 
	$now_page=1;
} 
  

$sql = "SELECT a.*, b.goods_id, b.goods_name FROM `t_user_order_tourist` a, t_user_order b WHERE a.order_id=b.order_id AND a.`site_id`='$g_siteid' AND a.`order_code`='".req('order_code')."' ORDER BY a.`tourist_id` DESC";

/// ²éÑ¯×ÜÊı
$pre_sql_select = substr($sql, 0, strpos($sql,'FROM')+4);
$sql_total_number = str_replace($pre_sql_select, 'SELECT COUNT(*) FROM', $sql);
$total_number = $db->get_value($sql_total_number); 

$sql .= " LIMIT ".(($now_page-1)*$pape_size).", $pape_size";

if($total_number % $pape_size == 0){
	  $total_page = intval($total_number / $pape_size);
} else{
	  $total_page = intval($total_number / $pape_size) + 1;
}

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

