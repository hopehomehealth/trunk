<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$page_id = req('page_id');

$sql = "SELECT * FROM `t_page` WHERE site_id='$g_siteid' AND page_id='".$page_id."' ";  
$detail = $db->get_one($sql);  
 
?>
