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
	$qer .= " AND ( a.order_id='".req('kw')."' OR a.`goods_name` LIKE '%".req('kw')."%' )";
}
if(req('state')!=''){
	$qer .= " AND a.`state`='".req('state')."'";
} 

$sql = "SELECT a.* FROM `t_user_score_order` a WHERE a.`site_id`='$g_siteid' $qer ORDER BY a.`order_id` DESC ";   

/// ²éÑ¯×ÜÊı 
$total_number = $db->get_value("SELECT COUNT(*) FROM ( $sql ) TMP"); 
 
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

