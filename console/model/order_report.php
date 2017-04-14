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
 
if(req('report_ym')!=''){
	$qer .= " AND a.`addtime`>='".req('report_ym')."-01' AND a.`addtime`<='".req('report_ym')."-31'";
}  
if(req('is_settle')!=''){
	$qer .= " AND a.`is_settle`='".req('is_settle')."' ";
}   

$sql = "SELECT * FROM t_user_order a WHERE a.`site_id`='$g_siteid' AND a.`state`='4' $qer ORDER BY a.`order_code` DESC ";   
 
/// 查询总数 
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
 
$sql = "SELECT * FROM (SELECT DATE_FORMAT(`addtime`,'%Y年%m月') AS ym_text, DATE_FORMAT(`addtime`,'%Y-%m') AS ym FROM t_user_order a WHERE a.site_id='$g_siteid' AND a.`state`='4' $sqler ) t GROUP BY t.ym ASC";   
$ym_rows = $db->get_all($sql);  

$sql = "SELECT SUM(`real_price`) as sum_real_price, COUNT(*) AS cnt_order_number FROM t_user_order a WHERE a.`site_id`='$g_siteid' AND a.`state`='4' $sqler ";   
$order_stat = $db->get_one($sql); 

?>