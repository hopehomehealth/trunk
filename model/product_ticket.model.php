<?
$mm['reqType'] ='web';
$nowUrl = $db->getUrl();
$temp = $_GET['pageNo'];
if(strstr($nowUrl,'&pageNo')){
	$meiyong = strrchr($nowUrl,'&pageNo');
	$nowUrl = str_replace($meiyong,'',$nowUrl);
}

$data['orderByPrice'] = '';
if(!empty($_GET['scenicTheme'])){
		$scenicTheme = '&scenicTheme='.$_GET['scenicTheme'];
	}
if($_GET['sc']=='asc'){
	$data['orderByPrice'] = 'desc';
}elseif($_GET['sc']=='desc'){
	$data['orderByPrice'] = 'asc';
}else{
	$data['orderByPrice'] = '';
}



//主题

$zhuti = array_iconv(json_decode($db->api_post($host."/travel/interface/menpiao/getFilterCondition"),true),'utf-8','gbk');

$data['pageSize'] = '10';

$pageNo = 1;
$nextPage = 2;
$prePage = 1;
$data['pageNo'] = strval(1);
$data['scenicTheme'] = gbk_to_utf8(req('scenicTheme'));//主题
$data['isHot'] = req('hot');//推荐

function jiequ($num,$data){
    if(mb_strlen($data,'gbk')>$num){
        return mb_substr($data, 0, $num,'gbk').'...';
    }else{
        return $data;
    }

}

if(!empty($_GET['pageNo'])){
	$data['pageNo'] = strval($_GET['pageNo']);
	$pageNo = $_GET['pageNo'];
	$prePage = intval($data['pageNo'])-1;
	$nextPage = intval($data['pageNo'])+1;
}

$data['keyword'] = gbk_to_utf8(req('keyWord'));
$keyWord = req('keyWord');
$data['reqType'] ='web';
$liebiao = array_iconv(json_decode($db->api_post($host."/travel/interface/menpiao/getTicketGoodsList",$data),true),'utf-8','gbk');

$totalPage = $liebiao['data']['totalPage'];

if($prePage<1){
	$prePage = 1;
}
if($nextPage>=$totalPage){
	$nextPage = $totalPage;
}


$pagepre = '&pageNo='.$prePage;
$pagenext = '&pageNo='.$nextPage;                                                                   

//分页
function get_page_url($page){
		
				global $action, $c_catalog_key, $page_args;
 
				if($action == 'cat_key'){
					return "/$c_catalog_key/page-$page.html"; 
				} else {
					return "?p=$page$page_args"; 
				}
}
			
			

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
	$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 AND a.sale_type='0' $sqler $oer ";  
	return $sql;
}

/// 执行动作
$action = req('action');

/// 默认排序
$oer = "ORDER BY a.`order_id` ASC, a.`goods_id` DESC";

/// 默认标题
$c_page_title = $g_start_city.'旅游产品列表'; 

/// 排序方式
/*$orderby = req('ord'); 

if($orderby == 'true'){ 
	$field	= req('col'); // 排序字段
	$sc	= req('sc');  // ASC DESC*/

	// 推荐排序
	/*if($field=='sale'){*/
	
	/*}*/
	/*// 新品排序
	elseif($field=='new'){
		$oer = "ORDER BY a.`goods_id` $sc";
	}
	// 新品排序
	elseif($field=='clicks'){
		$oer = "ORDER BY a.`clicks` $sc";
	}
	// 推荐排序
	elseif($field=='hot'){
		$oer = "ORDER BY a.`is_hot` $sc";//推荐接口
	}*/
	// 价格排序
	/*elseif($field=='price'){ */

	/*}*/
/*}
*/
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

$page_limit		= $_COOKIE['catalog_limit'];//每页显示数
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