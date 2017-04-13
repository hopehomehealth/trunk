<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$c_goods_type = req('goods_type');

$sql = "SELECT max(order_id)+1 FROM t_goods_floor WHERE site_id='$g_siteid' ";  
$max_order_id = $db->get_value($sql); 

function get_cat($pid){ 
	global $db, $g_siteid;
	$sql = "SELECT * FROM t_goods_catalog WHERE site_id='$g_siteid' AND parent_id='$pid' ORDER BY order_id ASC";  
	return $db->get_all($sql);  
}

$sql = "SELECT * FROM t_goods_floor WHERE site_id='$g_siteid' AND parent_id='0' AND goods_type='$c_goods_type' ORDER BY order_id ASC";  
$floor_top = $db->get_all($sql); 

$sql = "SELECT * FROM t_goods_floor WHERE site_id='$g_siteid' AND goods_type='$c_goods_type'  ORDER BY parent_id ASC, order_id ASC";  
$rows = $db->get_all($sql); 
?>

