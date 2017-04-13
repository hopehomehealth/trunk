<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 
$goods_id = req('goods_id');

$sql = "SELECT * FROM t_score_goods_thread WHERE site_id='$g_siteid' AND goods_id='$goods_id' ";  
$goods = $db->get_one($sql);  

$sql = "SELECT * FROM t_score_goods_catalog WHERE site_id='$g_siteid' ORDER BY `order_id` ASC ";  
$cat_list = $db->get_all($sql);  
?>

