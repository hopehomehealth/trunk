<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$order_code = req('order_code');


$sql = "SELECT a.*,b.*,c.goods_name  FROM t_user_order a, t_refund_fee_apply b, t_user_order_item c WHERE c.order_code = '$order_code' AND a.`site_id`='$g_siteid' AND a.`order_code`='$order_code' AND b.`order_code`='$order_code'";
$details = $db->get_one($sql);


$sql = "SELECT c.lv_scenic_id FROM t_user_order a, t_goods_thread c WHERE a.lv_product_id=c.lv_product_id AND a.`site_id`='$g_siteid' AND a.`order_code`='$order_code' ";
$detail = $db->get_one($sql);

?>