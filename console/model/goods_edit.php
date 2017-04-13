<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 
$goods_id = req('goods_id');

$sql = "SELECT * FROM t_goods_thread WHERE site_id='$g_siteid' AND goods_id='$goods_id' ";  
$goods = $db->get_one($sql); 

$c_goods_type = $goods['goods_type'];
 
$sql = "SELECT * FROM t_shop WHERE site_id='$g_siteid' ORDER BY order_id ASC";  
$shop_list = $db->get_all($sql);  

// 查询全部子类列表
function son_cat($parent_id){
	global $db, $g_siteid;
  
	$sql = "SELECT `cat_id`,`cat_name`,`parent_id`  FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' ORDER BY `order_id` ASC ";
	return $db->get_all($sql);
} 

// 是否存在下级分类
function has_son_cat($parent_id){
	global $db, $g_siteid;
  
	$sql = "SELECT `cat_id` FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' LIMIT 0,1";
	$rs = $db->get_value($sql);

	if($rs!='') return true;
	else return false;
} 

/////////////////////////////////// 产品类型 //////////////////////////////

// 签证国家列表
$sql = "SELECT * FROM `t_visa_zone`  ORDER BY `zone_letter` ASC";  
$visa_zone_list = $db->get_all($sql); 

$visa = unserialize($goods['visa_profile']); 
?>

