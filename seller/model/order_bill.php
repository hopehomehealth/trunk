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
 
if(req('kw')!=''){
	$qer .= " AND a.`site_order_code` = '".req('kw')."'";
}
if($g_shopid != ''){
	$qer .= " AND c.`shop_id`='$g_shopid' ";
}

$sql = "SELECT a.*, b.account  FROM `t_user_bill` a, `t_user` b, `t_user_order` c WHERE a.`site_order_code`=c.`order_code` AND b.`user_id`=c.`user_id` AND a.`site_id`='$g_siteid' $qer ORDER BY a.`pay_id` DESC ";   
 
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


$sql = "SELECT SUM(a.`total_fee`) FROM `t_user_bill` a WHERE a.site_id='$g_siteid' $qer ";   
$total_fee = $db->get_value($sql)
?> 

