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
	$qer .= " AND (a.`content` LIKE '%".req('kw')."%' OR b.`goods_name` LIKE '%".req('kw')."%' )";
}

$sql = "SELECT a.*, b.cat_key, b.goods_name, c.account FROM t_goods_comment a, t_goods_thread b, t_user c WHERE a.goods_id=b.goods_id AND a.`user_id`=c.`user_id` AND a.site_id='$g_siteid' $qer ORDER BY comment_id DESC ";   
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

//-----------------------------------------//
function get_parent_catalog($cat_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM `t_article_catalog` WHERE `cat_id`=(SELECT t.`parent_id` FROM `t_article_catalog` t WHERE t.`site_id`='$g_siteid' AND t.`cat_id`='$cat_id') ";  
	return $db->get_one($sql); 
} 
?> 

