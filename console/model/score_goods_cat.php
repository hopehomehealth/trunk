<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_score_goods_catalog` WHERE site_id='$g_siteid' $qer ORDER BY `order_id` ASC ";
$cat_list = $db->get_all($sql);
  
$sql = "SELECT max(order_id)+1 FROM t_score_goods_catalog WHERE site_id='$g_siteid'";  
$max_order_id = $db->get_value($sql); 
  
?>