<? 
function list_this_child_catalog($c_cat_id){
	global $db, $g_siteid, $this_child_catalog_array;

	// 先取得本类
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC";  
	$this_child_catalog_array = $db->get_all($sql);   

	// 递归取得子类
	function list_child_catalog($this_parent_id){
		global $db, $g_siteid, $this_child_catalog_array;

		$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$this_parent_id' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC";  
		$catalog = $db->get_all($sql);  
		 
		if(notnull($catalog)){
			foreach ($catalog as $val){  
				$this_child_catalog_array[] = $val; 
				list_child_catalog($val['cat_id']);
			}
		}
	}
	list_child_catalog($c_cat_id);
} 
 
/// 构造传递参数
function build_args($arg_array){
	$args_string = '';
	foreach ($arg_array as $k => $v) {
		if(trim($v)!=''){
			$args_string .= "&$k=$v";
		}
	}
	return $args_string;
} 

//// 主查询语句 ////
function get_sql($sqler, $oer){
	global $g_siteid;
	$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 $sqler $oer ";  
	return $sql;
}

// 执行动作
$action = req('action');

// 默认排序
$oer = "ORDER BY a.`order_id` ASC, a.`goods_id` DESC";


/// 排序方式
$orderby = req('ord'); 

if($orderby == 'true'){ 
	$field	= req('col'); // 排序字段
	$type	= req('type');  // ASC DESC

	// 销量排序
	if($field=='sale'){
		$oer = "ORDER BY a.`sale_number` $type";
	}
	// 新品排序
	elseif($field=='new'){
		$oer = "ORDER BY a.`goods_id` $type";
	}
	// 新品排序
	elseif($field=='clicks'){
		$oer = "ORDER BY a.`clicks` $type";
	}
	// 推荐排序
	elseif($field=='hot'){
		$oer = "ORDER BY a.`is_hot` $type";
	}
	// 价格排序
	elseif($field=='price'){ 
		$oer = "ORDER BY a.`real_price` $type"; 
	}
}
 
/// 按关键词查询 ///

$sqler		= '';
$keywords	= req('keywords');
$goods_type = req('goods_type'); 

$is_hot = req('hot');
if($is_hot=='yes'){ 
	$sqler .= " AND a.`is_hot`='1' ";
}  

if($keywords!=''){
 
	if(req('l_money')!=''){
		$sqler .= " AND a.`real_price`>='".req('l_money')."' ";
	}
	if(req('h_money')!=''){
		$sqler .= " AND a.`real_price`<='".req('h_money')."' ";
	} 

	if($goods_type!='' && $goods_type!='0'){
		$search_qer = " AND `goods_type`='$goods_type' ";
	}

	$ft_mode = false; 
	if($ft_mode == true){  
		$chars_array = ft_split($keywords);
		foreach ($chars_array as &$val) {
			$ft_string .= '+'.$val.' ';
		} 
		$sqler .= "AND MATCH (a.ft) AGAINST ('".$ft_string."' IN BOOLEAN MODE) $search_qer ";
	} else { 
		$sqler .= "AND (`goods_name` LIKE '%$keywords%' OR `summary` LIKE '%$keywords%') $search_qer ";
	}

	// 记录查询关键词
	$other_sql = "INSERT INTO `t_goods_search` (`site_id`, `user_id`, `session_id`, `keywords`, `addtime`) VALUES ( '$g_siteid', '$g_userid', '".sessionid()."', '$keywords', '".date('Y-m-d H:i:s')."' );"; 
	$db->query($other_sql);
} 
 
$sql = get_sql($sqler, $oer); 
$query_sql = $sql;  

///-----------------------------------------------/// 分页列表

$now_page		= 1; 
$total_number	= 0;
$total_page		= 0;

$page_limit		= $_COOKIE['catalog_limit'];
if($page_limit != ''){
	$pape_size	= $page_limit;
} else {
	if($g_misc['product_page_num']==0)
		$pape_size = 20;
	else
		$pape_size = $g_misc['product_page_num']; //默认12
}

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p'))); 
} 
if($now_page<1){ 
	$now_page=1;
}    
 
 
/// 查询产品总数(高效)
$pre_sql_select		= substr($sql, 0, strpos($sql,'FROM')+4);
$sql_total_number	= str_replace($pre_sql_select, 'SELECT COUNT(*) FROM', $sql);
$total_number		= $db->get_value($sql_total_number);


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

//// 主查询语句 ////

$sql .= " LIMIT $start_limit , $pape_size";
 
$query_rows = $db->get_all($sql);  
 
//echo $sql;


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
 

// 最新分类下的文章列表
function list_goods_article($limit){
	global $db, $g_siteid, $c_cat_id; 

	if($c_cat_id!=''){
		$qer = " AND `goods_cat_id`='$c_cat_id'";
	}
 
	$sql = "SELECT * FROM `t_article_thread` WHERE `site_id`='$g_siteid' $qer ORDER BY `thread_id` ASC LIMIT 0, $limit";  
	return $db->get_all($sql); 
} 


// 查询关键词过滤
$query_keywords = $_GET['keywords']; 
$query_keywords = str_replace('&','%26',$query_keywords); 


$arg_array = array(      
	'h_money'	=> req('h_money'), 
	'l_money'	=> req('l_money'), 
	'hot'		=> req('hot'),  
	'keywords'	=> req('keywords')  
);
 
$page_args = build_args($arg_array); 

/// SEO配置
function seo(){
	global $g_sitename;
?>
<title>产品搜索_<?=$g_sitename?></title>  
<?
}
?>