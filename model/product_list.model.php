<?
$nowUrl = $db->getUrl();
$temp = $_GET['pageNo'];
if(strstr($nowUrl,'&pageNo')){
    $meiyong = strrchr($nowUrl,'&pageNo');
    $nowUrl = str_replace($meiyong,'',$nowUrl);
}

$Word = gbk_to_utf8(req('keyWord'));
$keyWord = req('keyWord');
//$keyWord = '黑龙江';
$pageNo = 1;
$nextPage = 2;
$prePage = 1;
$orderby = req('ord');
//var_dump($keyWord);
function get_product_list($keyWord)
{
    global $host;
    global $orderby;
    global $db;
    /// 排序方式
    $post['orderByPrice'] = '';
    $post['soldNum'] = '';
    $post['isHot'] = '';
//    echo $orderby;
    if($orderby == 'true'){
        $field	= req('col'); // 排序字段
        $sc	= req('sc');  // ASC DESC

        // 销量排序
        if($field=='sale'){
            $post['soldNum'] = $sc;
        }
        // 推荐排序
        elseif($field=='hot'){
            $post['isHot'] = $sc;
        }
        // 价格排序
        elseif($field=='price'){
            $post['orderByPrice'] = $sc;
        }
    }

    $post['keyword'] = gbk_to_utf8($keyWord);
//    var_dump($post['keyWord']);
    if (!empty($post['keyword']) ||  $orderby == 'true'){

        $post['pageSize'] = '10';
        $post['city'] = '';
        $post['city'] = gbk_to_utf8($post['city']);
//        $post['pageNo'] = req('p');
        $post['pageNo'] = req('pageNo');
        if (empty($post['pageNo'])){
            $post['pageNo'] = 1;
        }
        $product_list = $db->api_post($host . "/travel/interface/zby/v3.2/getZbyList_v3.2", $post);
//        $product_list = post_curl("http://192.168.0.132:8080/travel/interface/zby/getZbyList", $post);
        $product_list = json_decode($product_list, true);
        $product_list = array_iconv($product_list,'utf-8','gbk');
        if ($product_list['status'] != '0000') {
            exit($product_list['msg']);
        }
//        echo "<pre>";
//        var_dump($product_list);


    }else {
        $post['homePage'] = '0';
//        $post['distCity'] = '';
//        $post['distCity'] = gbk_to_utf8($post['distCity']);
        $product_list = $db->api_post($host . "/travel/interface/zby/getHotZbyGoodsList", $post);
        $product_list = json_decode($product_list, true);
        $product_list = array_iconv($product_list,'utf-8','gbk');
        if ($product_list['status'] != '0000') {
            exit($product_list['msg']);
        }
    }

    return $product_list;

}


$product_list = get_product_list($keyWord);
if (!empty($keyWord) || $orderby == 'true'){
    $product_list_data = $product_list['data'];
    $zbyHotGoodsList = $product_list_data['zbyList'];
    $total = $product_list_data['total'];
    $totalPage = $product_list_data['totalPage'];
}else {
//    var_dump($product_list);
    $product_list_data = $product_list['data'];
    $zbyHotGoodsList = $product_list_data['zbyHotGoodsList'];
    $total = $product_list_data['total'];
}


$data['pageNo'] = 1;
if (!empty($keyWord) || $orderby == 'true') {

    if($_GET['pageNo']){
        $data['pageNo'] = strval($_GET['pageNo']);
        $pageNo = $_GET['pageNo'];
    }

    $prePage = intval($data['pageNo'])-1;
    $nextPage = intval($data['pageNo'])+1;
    if($prePage<1){
        $prePage = 1;
    }
    if($nextPage>$totalPage){
        $nextPage = $totalPage;
    }

    $pagepre = '&pageNo='.$prePage;
    $pagenext = '&pageNo='.$nextPage;

    if($totalPage<1){
        $totalPage = 1;
    }

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








//之前
///// 排序方式
//$orderby = req('ord');
//
//if($orderby == 'true'){
//    $field	= req('col'); // 排序字段
//    $sc	= req('sc');  // ASC DESC
//
//    // 销量排序
//    if($field=='sale'){
//        $oer = "ORDER BY a.`sale_number` $sc";
//    }
//    // 新品排序
//    elseif($field=='new'){
//        $oer = "ORDER BY a.`goods_id` $sc";
//    }
//    // 新品排序
//    elseif($field=='clicks'){
//        $oer = "ORDER BY a.`clicks` $sc";
//    }
//    // 推荐排序
//    elseif($field=='hot'){
//        $oer = "ORDER BY a.`is_hot` $sc";
//    }
//    // 价格排序
//    elseif($field=='price'){
//        $oer = "ORDER BY a.`real_price` $sc";
//    }
//}

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


//// 主查询语句 ////
function get_sql($sqler, $oer){
	global $g_siteid;
	$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 AND a.sale_type='0' $sqler $oer ";  
	return $sql;
}

/// 执行动作
$action = req('action');

/// 默认排序
$oer = "ORDER BY a.`order_id` ASC, a.`goods_id` DESC";

/// 默认标题
$c_page_title = $g_start_city.'旅游产品列表'; 



/// ----------------------------------------------// 景区类目
if($action == 'list'){
	$sqler = ''; 

	$c_catalog_key = req('cat_key');
	
	// 全部产品
	if($c_catalog_key=='all')
	{ 
		$c_cat_id = '0';
	} 
	else 
	{ 
		$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_key`='$c_catalog_key' AND `site_id`='$g_siteid'";  
		$c_catalog = $db->get_one($sql);  

		$c_cat_id = $c_catalog['cat_id'];
		 
		if($c_cat_id == ''){ 
			notfound();
		} 
	}

	$c_goods_type = $g_product_type_id[req('goods_type_key')];

	/// 查询该类的全部父类
	$this_parent_catalog = array();

	// 执行遍历所有父类
	list_goods_parent_catalog($c_cat_id);   

	/// 查询该类及所有子类的列表，以供查询产品
	$this_child_catalog_array = array();

	// 执行递归查询
	list_this_child_catalog($c_cat_id);

	/// 查询类别的SQL构造   
	if(notnull($this_child_catalog_array) && $c_cat_id != '0'){
		foreach ($this_child_catalog_array as $val){
			$sql_in .= ",'".$val['cat_id']."'";
		}
		$sql_in = substr($sql_in,1);
		$sqler = " AND ( a.`cat_id` in ($sql_in) OR MATCH (a.catalogs) AGAINST ('$c_cat_id') )";
	}    

	$c_page_title = $g_start_city.'出发'.' '.$c_catalog['cat_name'].'旅游'.' '.$g_product_type[$c_goods_type];
	  
	$sqler .= "AND a.`goods_type`='$c_goods_type' ";

	$sql = get_sql($sqler, $oer);   
}

/// ----------------------------------------------//  签证
elseif($action == 'visa'){
	$sqler			= ''; 
	$c_cat_id		= '0';
	$c_goods_type	= req('goods_type'); 

	if(req('zone_id')!=''){ 
		$ser = "AND a.visa_zone_id='".req('zone_id')."'";
	}

	$c_page_title = '签证';

	$sqler .= "AND a.`goods_type`='$c_goods_type' $ser "; 
	$sql = get_sql($sqler, $oer);  
}

/// ----------------------------------------------//  邮轮
elseif($action == 'ship'){
	$sqler			= ''; 
	$c_cat_id		= '0';
	$c_goods_type	= req('goods_type'); 

	$c_page_title = '邮轮';

	$sqler .= "AND a.`goods_type`='$c_goods_type' "; 
	$sql = get_sql($sqler, $oer);  
}

/// ----------------------------------------------//  区域分类
elseif($action == 'zone'){
	$sqler = ''; 
	$c_cat_id = '0';
	$c_goods_type = '1';
	$sqler .= "AND a.`goods_type`='$c_goods_type' "; 
	
	$goods_zone	= req('goods_zone');
	$zone_id	= $g_product_zone_key[$goods_zone];

	$c_page_title = $g_product_zone[$zone_id];

	$sqler .= "AND a.`goods_zone`='$zone_id' "; 
	$sql = get_sql($sqler, $oer);  

}

/// ----------------------------------------------//  筛选模式
elseif($action == 'filter'){
	$sqler = '';  

	$filter_cat_id = req('catalog');
	if($filter_cat_id!=''){  
		$all_cid = get_all_cid($filter_cat_id);
		$sqler .= " AND ( a.`cat_id` in ( $all_cid ) OR MATCH (a.`catalogs`) AGAINST ('$filter_cat_id') )";
	}

	$filter_hot = req('hot');
	if($filter_hot=='yes'){ 
		$sqler .= " AND a.`is_hot`='1' ";
	}

	$filter_day = req('day'); 
	if($filter_day!=''){
		$day_txt = $g_product_day_filter[$filter_day];
		$sqler .= str_replace('###', ' a.`line_days` ', $day_txt); 
	} 

	$filter_goods_type = req('goods_type');
	if($filter_goods_type!=''){ 
		$sqler .= " AND a.`goods_type`='$filter_goods_type' ";
	} 

	$filter_tag = req('tag');
	if($filter_tag!=''){ 
		$sqler .= " AND a.`line_tag` LIKE '%\"".$filter_tag."\"%' ";
	}

	$filter_money = req('money'); 
	if($filter_money!=''){
		$day_txt = $g_product_money_filter[$filter_money];
		$sqler .= str_replace('###', ' a.`real_price` ', $day_txt); 
	}
	 
	if(req('l_money')!=''){
		$sqler .= " AND a.`real_price`>='".req('l_money')."' ";
	}
	if(req('h_money')!=''){
		$sqler .= " AND a.`real_price`<='".req('h_money')."' ";
	}

	// 邮轮
	$filter_ship_line = req('ship_line');
	if($filter_ship_line!=''){ 
		$sqler .= " AND a.`ship_line` LIKE '%\"$filter_ship_line\"%' ";
	}

	$filter_ship_port = req('ship_port');
	if($filter_ship_port!=''){ 
		$sqler .= " AND a.`ship_port`='$filter_ship_port' ";
	}

	// 邮轮
	$filter_visa_zone = req('visa_zone');
	if($filter_visa_zone!=''){ 
		$sqler .= " AND a.`visa_zone_id`='$filter_visa_zone' ";
	}

	$filter_visa_type = req('visa_type');
	if($filter_visa_type!=''){ 
		$sqler .= " AND a.`visa_type`='$filter_visa_type' ";
	}

	$c_cat_id = $filter_cat_id; 
	$c_goods_type = req('goods_type');

	/// 查询该类的全部父类
	$this_parent_catalog = array();

	// 执行遍历所有父类
	list_goods_parent_catalog($c_cat_id);   
	
	$c_page_title = '产品筛选';

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

// 全部签证区域
function get_visa_zone_list(){
	global $db; 
 
	$sql = "SELECT * FROM `t_visa_zone` ORDER BY `zone_id` ASC ";  
	return $db->get_all($sql); 
}

// 全部签证区域
function get_sku_list($goods_id, $limit){
	global $db, $g_siteid; 
 
	$sql = "SELECT * FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND goods_id='$goods_id' AND `departdate`>='".date('Y-m-d')."' ORDER BY `sku_id` ASC LIMIT 0, $limit ";  
	return $db->get_all($sql); 
}


// 当前分类详细信息
$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ";  
$c_catalog = $db->get_one($sql); 


// 查询关键词过滤
$query_keywords = $_GET['keywords']; 
$query_keywords = str_replace('&','%26',$query_keywords); 


//$arg_array = array(
//	'catalog'	=> req('catalog'),
//	'day'		=> req('day'),
//	'type'		=> req('type'),
//	'tag'		=> req('tag'),
//	'money'		=> req('money'),
//	'h_money'	=> req('h_money'),
//	'l_money'	=> req('l_money'),
//	'hot'		=> req('hot'),
//	'sc'		=> req('sc'),
//	'keywords'	=> req('keywords')
//);

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
	global $g_sitename, $g_start_city, $c_page_title, $c_catalog_key;
?>
<title><?if($c_page_title!=''){echo $c_page_title;} else {echo '旅游产品';}?>_<?=$g_sitename?></title> 
<?if($c_catalog_key!=''){?>
<meta name="description" content="<?=$g_sitename?>为您提供最佳的<?=$c_page_title?>，100%品质保证，多种套餐任意选择，全网最低价，无强制购物！优质<?=$c_page_title?>产品尽在<?=$g_sitename?>。" /> 
<?}?>
<?}?>