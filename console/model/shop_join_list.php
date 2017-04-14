<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  

$sql = "SELECT * FROM `t_shop_join` WHERE `site_id`='$g_siteid' ORDER BY `join_id` DESC";  
$rows = $db->get_all($sql); 
?>

