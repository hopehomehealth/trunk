<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 
$sql = "SELECT * FROM t_goods_floor_topic WHERE site_id='$g_siteid' AND floor_id='".req('floor_id')."' ORDER BY order_id ASC ";   
 
$query_rows = $db->get_all($sql); 
 
 
?>    

