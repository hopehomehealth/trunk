<? 
function list_this_child_catalog($c_cat_id){
	global $db, $g_siteid, $this_child_catalog_array;

	// ��ȡ�ñ���
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC";  
	$this_child_catalog_array = $db->get_all($sql);   

	// �ݹ�ȡ������
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

/// ���촫�ݲ���
function build_args($arg_array){
	$args_string = '';
	foreach ($arg_array as $k => $v) {
		if(trim($v)!=''){
			$args_string .= "&$k=$v";
		}
	}
	return $args_string;
} 

//// ����ѯ��� ////
function get_sql($sqler, $oer){
	global $g_siteid;
	$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 $sqler $oer ";  
	return $sql;
}

// ִ�ж���
$action = req('action');

// Ĭ������
$oer = "ORDER BY a.`order_id` ASC, a.`goods_id` DESC";


/// ����ʽ
$orderby = req('ord'); 

if($orderby == 'true'){ 
	$field	= req('col'); // �����ֶ�
	$sc	= req('sc');  // ASC DESC

	// ��������
	if($field=='sale'){
		$oer = "ORDER BY a.`sale_number` $sc";
	}
	// ��Ʒ����
	elseif($field=='new'){
		$oer = "ORDER BY a.`goods_id` $sc";
	}
	// ��Ʒ����
	elseif($field=='clicks'){
		$oer = "ORDER BY a.`clicks` $sc";
	}
	// �Ƽ�����
	elseif($field=='hot'){
		$oer = "ORDER BY a.`is_hot` $sc";
	}
	// �۸�����
	elseif($field=='price'){ 
		$oer = "ORDER BY a.`real_price` $sc"; 
	}
}

/// Ĭ�ϱ���
$this_page_title = $g_start_city.'��ѧ��Ʒ'; 

if($c_goods_type != ''){
	$sqler = '';
  
	$sqler .= "AND a.`goods_type`='$c_goods_type' ";

	$sql = get_sql($sqler, $oer);  
}
 
$query_sql = $sql; 

///-----------------------------------------------/// ��ҳ�б�

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
		$pape_size = $g_misc['product_page_num']; //Ĭ��12
}

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p'))); 
} 
if($now_page<1){ 
	$now_page=1;
}    
 
 
/// ��ѯ��Ʒ����(��Ч)
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

/// ִ�в�ѯ
$start_limit = ($now_page-1)*$pape_size;
if($start_limit<0){
	$start_limit = 0;
}

//// ����ѯ��� ////

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

/// ҳ�浼��
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

// ɸѡ����
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


// ���·����µ������б�
function list_goods_article($limit){
	global $db, $g_siteid, $c_cat_id; 

	if($c_cat_id!=''){
		$qer = " AND `goods_cat_id`='$c_cat_id'";
	}
 
	$sql = "SELECT * FROM `t_article_thread` WHERE `site_id`='$g_siteid' $qer ORDER BY `order_id` ASC LIMIT 0, $limit";  
	return $db->get_all($sql); 
}


// ��ǰ������ϸ��Ϣ
$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ";  
$this_catalog = $db->get_one($sql); 


// ��ѯ�ؼ��ʹ���
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

/// SEO����
function seo(){
	global $g_sitename, $g_start_city, $this_page_title, $this_catalog_key;
?>
<title><?if($this_page_title!=''){echo $this_page_title;} else {echo $g_start_city.'�����籨��';}?> - <?=$g_sitename?></title> 
<?if($this_catalog_key!=''){?>
<meta name="description" content="<?=$g_sitename?>Ϊ���ṩ��ѵ�<?=$this_page_title?>��Ʒ��100%Ʒ�ʱ�֤�������ײ�����ѡ��ȫ����ͼۣ���ǿ�ƹ������<?=$this_page_title?>��Ʒ����<?=$g_sitename?>��" /> 
<?}?>
<?}?>