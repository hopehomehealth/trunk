<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 
$sql = "SELECT * FROM t_user_traffic WHERE user_id='$g_userid' ORDER BY traffic_id DESC";  
$address_list = $db->get_all($sql); 
?>
