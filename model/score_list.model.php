<? 
$c_cat_id = req('id');
 

// 查询分类列表
function get_all_catalog(){
	global $db, $g_siteid; 
 
	$sql = "SELECT * FROM `t_score_goods_catalog` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC";  
	return $db->get_all($sql); 
}

// 查询TOP10列表
function get_top10_goods(){
	global $db, $g_siteid; 
 
	$sql = "SELECT * FROM `t_score_goods_thread` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC LIMIT 0,10 ";  
	return $db->get_all($sql); 
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

// 默认排序
$oer = "ORDER BY a.`goods_id` DESC";

if($c_cat_id>0){
	$qer = "AND a.cat_id='$c_cat_id'";
}
$sql = "SELECT * FROM t_score_goods_thread a LEFT JOIN t_score_goods_catalog b ON a.cat_id=b.cat_id WHERE a.`site_id`='$g_siteid' $qer $oer "; 
 
//echo "<!-- $sql -->";

/// 查询产品总数(高效)
$pre_sql_select = substr($sql, 0, strpos($sql,'FROM')+4);
$sql_total_number = str_replace($pre_sql_select, 'SELECT COUNT(*) FROM', $sql);
$total_number = $db->get_value($sql_total_number);


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

$cat_list = get_all_catalog();
  
// 我的积分
$sql = "SELECT SUM(`score_number`) FROM `t_user_score` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ";	
$c_total_score_number = $db->get_value($sql); 

function seo(){
	global $g_sitename, $curr_cat;
?>
<title>积分商城_<?=$g_sitename?></title> 
<?}?>