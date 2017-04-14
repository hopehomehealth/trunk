<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$help_id = req('help_id');

$sql = "SELECT * FROM t_help_thread WHERE site_id='$g_siteid' AND help_id='".$help_id."' ";  
$news = $db->get_one($sql);  

function get_cat(){
	global $db, $g_siteid;
	$sql = "SELECT * FROM t_help_catalog WHERE site_id='$g_siteid' ORDER BY order_id ASC ";  
	return $db->get_all($sql); 
}
?> 