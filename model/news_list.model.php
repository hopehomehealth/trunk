<?
$curr_news_key = req('cat_key');

if($curr_news_key!=''){

	// 当前文章分类详细信息
	$sql = "SELECT * FROM `t_article_catalog` WHERE `cat_key`= '$curr_news_key' AND `site_id`='$g_siteid' LIMIT 0,1"; 
	$curr_cat = $db->get_one($sql);

	// 当前文章分类ID
	$curr_cat_id = $curr_cat['cat_id'];
}

// 查询全部文章分类
function get_all_catalog(){
	global $db, $g_siteid; 
 
	$sql = "SELECT * FROM `t_article_catalog` WHERE `parent_id`='0' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC";  
	return $db->get_all($sql); 
}
 

// 查询推荐文章列表
function get_hot_article($limit){
	global $db, $g_siteid, $curr_cat_id; 
 
	$sql = "SELECT * FROM `t_article_thread` WHERE `cat_id`='$curr_cat_id' AND `site_id`='$g_siteid' AND `is_hot`=1 AND `image`<>'' ORDER BY `order_id` ASC LIMIT 0, $limit";  
	return $db->get_all($sql); 
} 

///-----------------------------------------------/// 分页列表

$now_page		= 1; 
$total_number	= 0;
$total_page		= 0; 
$pape_size		= 10;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p'))); 
} 
if($now_page<1){ 
	$now_page=1;
}    

// 默认排序
$oer = "ORDER BY a.is_top DESC, a.`thread_id` DESC";

if($curr_cat_id>0){
	$qer = "AND a.cat_id='$curr_cat_id'";
}
if(req('keywords')!=''){
	$qer = "AND a.title LIKE '%".req('keywords')."%'";
}
$sql = "SELECT * FROM t_article_thread a LEFT JOIN t_article_catalog b ON a.cat_id=b.cat_id WHERE a.`site_id`='$g_siteid' $qer $oer "; 
 
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
  
?>
<?
function seo(){
	global $g_sitename, $curr_cat;
?>
<title><?if($curr_cat['cat_name']!=''){?><?=$curr_cat['cat_name']?>_<?}?>新闻资讯_<?=$g_sitename?></title>
<meta name="keywords" content="<?=$curr_cat['cat_name']?>" />
<meta name="description" content="<?=$curr_cat['cat_name']?> <?=$g_sitename?> " /> 
<?}?>