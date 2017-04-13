<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT max(order_id)+1 FROM t_article_catalog WHERE site_id='$g_siteid'";  
$max_order_id = $db->get_value($sql); 

function get_cat($parent_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM t_article_catalog WHERE site_id='$g_siteid' AND parent_id='$parent_id' ORDER BY order_id ASC ";  
	return $db->get_all($sql); 
}

function get_article_number($cat_id){
	global $db, $g_siteid;
	$sql = "SELECT COUNT(*) FROM t_article_thread WHERE site_id='$g_siteid' AND cat_id='$cat_id' ";  
	return $db->get_value($sql); 
}

$list01 = get_cat('0');
?>

