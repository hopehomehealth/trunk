<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT max(order_id)+1 FROM t_goods_mode WHERE site_id='$g_siteid' ";  
$max_order_id = $db->get_value($sql); 

$sql = "SELECT * FROM t_goods_mode WHERE site_id='$g_siteid' ORDER BY mode_id ASC";  
$mode_rows = $db->get_all($sql);  
 
?>   
