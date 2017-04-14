<?  
$c_shopid = req('id');

$sql = "SELECT * FROM `t_shop` WHERE `shop_id`='$c_shopid' AND `site_id`='$g_siteid'";  
$c_shop = $db->get_one($sql);  

// 非法调用
if($c_shop['shop_id']==''){
	header('Location:/404.php');
	exit;
}

// 查询店铺热门的产品列表
function get_shop_cat_list($parent_id, $limit='6' ){
	global $db, $g_siteid, $c_shopid; 
	 
	$sql = "SELECT * FROM `t_shop_goods_catalog` WHERE `site_id`='$g_siteid' AND `shop_id`='$c_shopid' AND `parent_id`='$parent_id' $qer ORDER BY `order_id` ASC, `cat_id` DESC LIMIT 0,$limit"; 
	return $db->get_all($sql); 
}

// PPT列表
function shop_ppt($limit=0){
	global $db, $g_siteid, $c_shopid;

	if($limit>0) $ler = "LIMIT 0, $limit";
  
	$sql = "SELECT * FROM `t_shop_ppt` WHERE `site_id`='$g_siteid' AND `shop_id`='$c_shopid' AND `ppt_type`='1' ORDER BY order_id ASC $ler ";  
	return $db->get_all($sql);       
}
 
//// 主查询语句 ////
if(req('cid')!=''){
	$sqler = " AND shop_cat_id='".req('cid')."' ";
} 
$sql = " SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$c_shopid' AND a.`is_sale`=1 $sqler ORDER BY goods_id DESC ";  
$query_rows = $db->get_all($sql);  
  
function seo(){
	global $g_sitename, $c_shop;
?>
<title><?if($c_shop['shop_name']!=''){?><?=$c_shop['shop_name']?>_<?}?><?=$g_sitename?></title>
<?}?>