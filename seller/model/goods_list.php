<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

set_return(); //设置

$now_page = 1; 
$total_number = 0;
$total_page = 0;
$pape_size = 10;

if(req('p')!=""){ 
	$now_page = intval(str_replace("/","",req('p')));
} 
if($now_page<1){ 
	$now_page=1;
} 

if(req('cat_id')!=''){ 
	$sql_cat_id = req('cat_id');

	$son_cat_list = son_cat(req('cat_id'));
	if(notnull($son_cat_list)){
		foreach ($son_cat_list as $val){   
			$sql_cat_id .= ','.$val['cat_id'];  
		}
	}
	$qer .= " AND a.`cat_id` IN( $sql_cat_id )";
}
if(req('sale_type')!=''){
	$qer .= " AND a.`sale_type`='".req('sale_type')."' ";
}
if(req('goods_type')!=''){
	$qer .= " AND a.`goods_type`='".req('goods_type')."' ";
}
if(req('kw')!=''){
	$qer .= " AND (a.`goods_name` LIKE '%".req('kw')."%' OR a.`goods_doc` LIKE '%".req('kw')."%' OR a.`goods_code` LIKE '%".req('kw')."%' OR a.`goods_id` = '".req('kw')."' )";
}
if(req('is_sale')!=''){
	$qer .= " AND a.`is_sale`='".req('is_sale')."' ";
} 
if(req('is_hot')!=''){
	$qer .= " AND a.`is_hot`='".req('is_hot')."' AND a.`is_sale`='1' ";
}   

$sql = "SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$g_shopid' $qer ORDER BY a.`goods_id` DESC ";   
 
/// 查询总数
$pre_sql_select = substr($sql, 0, strpos($sql,'FROM')+4);
$sql_total_number = str_replace($pre_sql_select, 'SELECT COUNT(*) FROM', $sql);
$total_number = $db->get_value($sql_total_number); 


$sql .= " LIMIT ".(($now_page-1)*$pape_size).", $pape_size";

$query_rows = $db->get_all($sql); 
 
if($total_number % $pape_size == 0){
	  $total_page = intval($total_number / $pape_size);
} else{
	  $total_page = intval($total_number / $pape_size) + 1;
}
if($now_page>$total_page){ 
	$now_page = $total_page;
}

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
 

function son_cat($parent_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' ORDER BY `cat_name` ASC ";
	return $db->get_all($sql);
}
function get_blank($level){
	for($i=0; $i<$level; $i++){
		echo ' &nbsp; &nbsp; ';
	}
}
function get_cat_select($val, $level){
	global $this_cat;
?>
	<option value="<?=$val['cat_id']?>" <?if(req('cat_id')==$val['cat_id']){echo 'selected';}?> ><?get_blank($level);?><?if($level>0){?>┠<?}?><?=strtoupper(substr(pinyin($val['cat_name']),0,1))?> <?=$val['cat_name']?></option>
<?
} 

function get_goods_cnt($col, $val){
	global $db, $g_siteid, $g_shopid;

	if($col=='is_hot') $qer = " AND is_sale=1";
 
	$sql = "SELECT COUNT(*) FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `$col`='$val' $qer";   
	return $db->get_value($sql);
} 

function get_goods_stat($goods_id){
	global $db, $g_siteid;
 
	$sql = "SELECT COUNT(*) FROM `t_goods_stat` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' ";   
	return $db->get_value($sql);
} 
?>  

