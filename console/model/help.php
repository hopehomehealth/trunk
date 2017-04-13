<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

//-------------------------------------------------// 帮助列表

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

if(req('cat_id')!=''){
	$qer .= " AND b.`cat_id`='".req('cat_id')."'";
}
if(req('kw')!=''){
	$qer .= " AND (a.`title` LIKE '%".req('kw')."%' OR a.`content` LIKE '%".req('kw')."%')";
}

$sql = "SELECT a.*, b.cat_name FROM t_help_thread a, t_help_catalog b WHERE 1=1 $qer AND a.site_id='$g_siteid' AND a.cat_id=b.cat_id ORDER BY a.cat_id ASC, a.order_id ASC, a.help_id DESC ";   

/// 查询总数
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


//-------------------------------------------------// 帮助分类 

$sql = "SELECT max(order_id)+1 FROM t_help_catalog WHERE site_id='$g_siteid'";  
$max_order_id = $db->get_value($sql); 

function get_cat($parent_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM t_help_catalog WHERE site_id='$g_siteid' ORDER BY order_id ASC ";  
	return $db->get_all($sql); 
}

function get_help_number($cat_id){
	global $db, $g_siteid;
	$sql = "SELECT COUNT(*) FROM t_help_thread WHERE site_id='$g_siteid' AND cat_id='$cat_id' ";  
	return $db->get_value($sql); 
}

$list01 = get_cat('0');
?> 

