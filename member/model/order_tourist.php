<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$order_code = req('order_code');
 
$sql = "SELECT a.* FROM t_user_order a, t_shop b WHERE a.shop_id=b.shop_id AND a.`site_id`='$g_siteid' AND a.`order_code`='$order_code' "; 
$detail = $db->get_one($sql); 
 
$sql = "SELECT a.*, b.goods_id, b.goods_name FROM `t_user_order_tourist` a, t_user_order b WHERE a.order_code=b.order_code AND a.`site_id`='$g_siteid' AND a.`order_code`='$order_code' ORDER BY a.`tourist_id` DESC";
$tourist = $db->get_all($sql); 
 
 
?> 

