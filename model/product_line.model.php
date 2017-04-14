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

function get_cid($cid){
	global $db, $g_siteid;

	$sql = "SELECT `cat_id` FROM `t_goods_catalog` WHERE `parent_id`='$cid' AND `site_id`='$g_siteid' ";  
	return $db->get_all($sql); 
}

function get_all_cid($cid){
	global $db, $g_siteid;

	$cid_str = '';
   
	$c1 = get_cid($cid); 
	if(notnull($c1)){
		foreach ($c1 as $v1){ 
			$cid_str .= ','.$v1['cat_id'];

			$c2 = get_cid($v1['cat_id']);  
			if(notnull($c2)){
				foreach ($c2 as $v2){ 
					$cid_str .= ','.$v2['cat_id'];

					$c3 = get_cid($v2['cat_id']);  
					if(notnull($c3)){
						foreach ($c3 as $v3){ 
							$cid_str .= ','.$v3['cat_id']; 
						}
					}
				}
			}
		}
	} 
	return $cid.$cid_str;
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
	$sc	= req('sc');  // ASC DESC

	// 销量排序
	if($field=='sale'){
		$oer = "ORDER BY a.`sale_number` $sc";
	}
	// 新品排序
	elseif($field=='new'){
		$oer = "ORDER BY a.`goods_id` $sc";
	}
	// 新品排序
	elseif($field=='clicks'){
		$oer = "ORDER BY a.`clicks` $sc";
	}
	// 推荐排序
	elseif($field=='hot'){
		$oer = "ORDER BY a.`is_hot` $sc";
	}
	// 价格排序
	elseif($field=='price'){ 
		$oer = "ORDER BY a.`real_price` $sc"; 
	}
}

/// 默认标题
$this_page_title = $g_start_city.'游学产品'; 

if($c_goods_type != ''){
	$sqler = '';
  
	$sqler .= "AND a.`goods_type`='$c_goods_type' ";

	$sql = get_sql($sqler, $oer);  
}
 
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

/// 页面导航
function get_page_nav($cat_id){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$cat_id' AND `site_id`='$g_siteid'";  
	$cat1 = $db->get_one($sql);  

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='".$cat1['parent_id']."' AND `site_id`='$g_siteid'";  
	$cat2 = $db->get_one($sql);  

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='".$cat2['parent_id']."' AND `site_id`='$g_siteid'";  
	$cat3 = $db->get_one($sql);  

	return array($cat3, $cat2, $cat1);
}  

$c_breadcrumb = get_page_nav($c_cat_id);

// 筛选分类
function filter_catalog(){
	global $db, $g_siteid, $c_cat_id;
	
	if($c_cat_id=='') $c_cat_id=0;
	
	$sql = "SELECT `cat_id`,`parent_id` FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' ";  
	$cat = $db->get_one($sql);

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='".$cat['cat_id']."' ORDER BY `order_id` ASC";  
	$rs = $db->get_all($sql);

	if(notnull($rs)){ 
		return $rs;
	} else {
		$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='".$cat['parent_id']."' ORDER BY `order_id` ASC";  
		return $db->get_all($sql);
	}
} 

$filter_catalog = filter_catalog();


// 最新分类下的文章列表
function list_goods_article($limit){
	global $db, $g_siteid, $c_cat_id; 

	if($c_cat_id!=''){
		$qer = " AND `goods_cat_id`='$c_cat_id'";
	}
 
	$sql = "SELECT * FROM `t_article_thread` WHERE `site_id`='$g_siteid' $qer ORDER BY `order_id` ASC LIMIT 0, $limit";  
	return $db->get_all($sql); 
}


// 当前分类详细信息
$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ";  
$this_catalog = $db->get_one($sql); 


// 查询关键词过滤
$query_keywords = $_GET['keywords']; 
$query_keywords = str_replace('&','%26',$query_keywords); 


$arg_array = array( 
	'catalog'	=> req('catalog'),
	'day'		=> req('day'),
	'type'		=> req('type'), 
	'tag'		=> req('tag'),  
	'money'		=> req('money'), 
	'h_money'	=> req('h_money'), 
	'l_money'	=> req('l_money'), 
	'hot'		=> req('hot'),  
	'sc'		=> req('sc'),
	'keywords'	=> req('keywords')  
);
 
$page_args = build_args($arg_array); 

/// SEO配置
function seo(){
	global $g_sitename, $g_start_city, $this_page_title, $this_catalog_key;
?>
<title><?if($this_page_title!=''){echo $this_page_title;} else {echo $g_start_city.'旅行社报价';}?> - <?=$g_sitename?></title> 
<?if($this_catalog_key!=''){?>
<meta name="description" content="<?=$g_sitename?>为您提供最佳的<?=$this_page_title?>产品，100%品质保证，多种套餐任意选择，全网最低价，无强制购物！优质<?=$this_page_title?>产品尽在<?=$g_sitename?>。" /> 
<?}?>
<?}?>