<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 
 
$mode_id = req('mode_id');

$sql = "SELECT  b.*, a.* FROM t_goods_join a, t_goods_thread b WHERE a.`site_id`='$g_siteid' AND a.goods_id=b.goods_id AND a.mode_id='$mode_id' ORDER BY a.order_id ASC ";   
$query_rows = $db->get_all($sql);  
 
?>