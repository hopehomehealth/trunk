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



//����

$zhuti = array_iconv(json_decode($db->api_post($host."/travel/interface/menpiao/getFilterCondition"),true),'utf-8','gbk');

$data['pageSize'] = '10';

$pageNo = 1;
$nextPage = 2;
$prePage = 1;
$data['pageNo'] = strval(1);
$data['scenicTheme'] = gbk_to_utf8(req('scenicTheme'));//����
$data['isHot'] = req('hot');//�Ƽ�

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

//��ҳ
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
	$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 AND a.sale_type='0' $sqler $oer ";  
	return $sql;
}

/// ִ�ж���
$action = req('action');

/// Ĭ������
$oer = "ORDER BY a.`order_id` ASC, a.`goods_id` DESC";

/// Ĭ�ϱ���
$c_page_title = $g_start_city.'���β�Ʒ�б�'; 

/// ����ʽ
/*$orderby = req('ord'); 

if($orderby == 'true'){ 
	$field	= req('col'); // �����ֶ�
	$sc	= req('sc');  // ASC DESC*/

	// �Ƽ�����
	/*if($field=='sale'){*/
	
	/*}*/
	/*// ��Ʒ����
	elseif($field=='new'){
		$oer = "ORDER BY a.`goods_id` $sc";
	}
	// ��Ʒ����
	elseif($field=='clicks'){
		$oer = "ORDER BY a.`clicks` $sc";
	}
	// �Ƽ�����
	elseif($field=='hot'){
		$oer = "ORDER BY a.`is_hot` $sc";//�Ƽ��ӿ�
	}*/
	// �۸�����
	/*elseif($field=='price'){ */

	/*}*/
/*}
*/
/// ----------------------------------------------// ������Ŀ
if($action == 'list'){
	$sqler = ''; 

	$c_catalog_key = req('cat_key');
	
	// ȫ����Ʒ
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

	/// ��ѯ�����ȫ������
	$this_parent_catalog = array();

	// ִ�б������и���
	list_goods_parent_catalog($c_cat_id);   

	/// ��ѯ���༰����������б��Թ���ѯ��Ʒ
	$this_child_catalog_array = array();

	// ִ�еݹ��ѯ
	list_this_child_catalog($c_cat_id);

	/// ��ѯ����SQL����   
	if(notnull($this_child_catalog_array) && $c_cat_id != '0'){
		foreach ($this_child_catalog_array as $val){
			$sql_in .= ",'".$val['cat_id']."'";
		}
		$sql_in = substr($sql_in,1);
		$sqler = " AND ( a.`cat_id` in ($sql_in) OR MATCH (a.catalogs) AGAINST ('$c_cat_id') )";
	}    

	$c_page_title = $g_start_city.'����'.' '.$c_catalog['cat_name'].'����'.' '.$g_product_type[$c_goods_type];
	  
	$sqler .= "AND a.`goods_type`='$c_goods_type' ";

	$sql = get_sql($sqler, $oer);   
}

/// ----------------------------------------------//  ǩ֤
elseif($action == 'visa'){
	$sqler			= ''; 
	$c_cat_id		= '0';
	$c_goods_type	= req('goods_type'); 

	if(req('zone_id')!=''){ 
		$ser = "AND a.visa_zone_id='".req('zone_id')."'";
	}

	$c_page_title = 'ǩ֤';

	$sqler .= "AND a.`goods_type`='$c_goods_type' $ser "; 
	$sql = get_sql($sqler, $oer);  
}

/// ----------------------------------------------//  ����
elseif($action == 'ship'){
	$sqler			= ''; 
	$c_cat_id		= '0';
	$c_goods_type	= req('goods_type'); 

	$c_page_title = '����';

	$sqler .= "AND a.`goods_type`='$c_goods_type' "; 
	$sql = get_sql($sqler, $oer);  
}

/// ----------------------------------------------//  �������
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

/// ----------------------------------------------//  ɸѡģʽ
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

	// ����
	$filter_ship_line = req('ship_line');
	if($filter_ship_line!=''){ 
		$sqler .= " AND a.`ship_line` LIKE '%\"$filter_ship_line\"%' ";
	}

	$filter_ship_port = req('ship_port');
	if($filter_ship_port!=''){ 
		$sqler .= " AND a.`ship_port`='$filter_ship_port' ";
	}

	// ����
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

	/// ��ѯ�����ȫ������
	$this_parent_catalog = array();

	// ִ�б������и���
	list_goods_parent_catalog($c_cat_id);   
	
	$c_page_title = '��Ʒɸѡ';

	$sql = get_sql($sqler, $oer); 
}
 
$query_sql = $sql; 

///-----------------------------------------------/// ��ҳ�б�

$now_page		= 1; 
$total_number	= 0;
$total_page		= 0;

$page_limit		= $_COOKIE['catalog_limit'];//ÿҳ��ʾ��
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

// ȫ��ǩ֤����
function get_visa_zone_list(){
	global $db; 
 
	$sql = "SELECT * FROM `t_visa_zone` ORDER BY `zone_id` ASC ";  
	return $db->get_all($sql); 
}

// ȫ��ǩ֤����
function get_sku_list($goods_id, $limit){
	global $db, $g_siteid; 
 
	$sql = "SELECT * FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND goods_id='$goods_id' AND `departdate`>='".date('Y-m-d')."' ORDER BY `sku_id` ASC LIMIT 0, $limit ";  
	return $db->get_all($sql); 
}


// ��ǰ������ϸ��Ϣ
$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ";  
$c_catalog = $db->get_one($sql); 


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
	global $g_sitename, $g_start_city, $c_page_title, $c_catalog_key;
?>
<title><?if($c_page_title!=''){echo $c_page_title;} else {echo '���β�Ʒ';}?>_<?=$g_sitename?></title> 
<?if($c_catalog_key!=''){?>
<meta name="description" content="<?=$g_sitename?>Ϊ���ṩ��ѵ�<?=$c_page_title?>��100%Ʒ�ʱ�֤�������ײ�����ѡ��ȫ����ͼۣ���ǿ�ƹ������<?=$c_page_title?>��Ʒ����<?=$g_sitename?>��" /> 
<?}?>
<?}?>